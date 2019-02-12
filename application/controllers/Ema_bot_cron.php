<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 Ema Bot Cron Job
 **/
class Ema_bot_cron extends CI_Controller {

  	public function __construct() {
		parent::__construct();
		
		$this->load->helper(array('url'));
		$this->load->library('s3');
		$this->load->database();
		
		require_once APPPATH . "third_party/php-binance-api.php";
		$this->load->model('bot_cron_model');
	}


	public function index() {
		$lowPriceThreshold = 0.00000250;
		$prices   = getCoinPrices();
		$daysCutoff = 4;
		$coin_pairs = $this->bot_cron_model->getCoinPairs($daysCutoff);
		if($coin_pairs){
			$coinSortArray = Array();

			foreach($coin_pairs as $coins) {
				$cross_coinPair = $coins->coin_pair;

				$pairPrice = $prices[$cross_coinPair];

				$thisCoinEmaCrossInstanceArray = Array();
				$thisCoinSortValue = 0;

				if ($pairPrice > $lowPriceThreshold)
				{
					$sql2 = "SELECT last_modified_date, crossed_up, candle_period, fast_ema, slow_ema 
					FROM ema_cross WHERE coin_pair='".$cross_coinPair."' 
					AND last_modified_date >= DATE(NOW()) - INTERVAL $daysCutoff DAY ORDER BY last_modified_date DESC";

					$result2 = $this->db->query($sql2);
					$result2 = $result2->result_array();
					if($result2){

						foreach($result2 as $emaRec) {
								$date = $emaRec['last_modified_date'];
								$emaCrossUp = $emaRec['crossed_up'];
								$periodEma = $emaRec['candle_period'];
								$fastEma = $emaRec['fast_ema'];
								$slowEma = $emaRec['slow_ema'];


								if($emaCrossUp == 1){ 
									$thisCrossSortValue = $this->getCrossSortValue($periodEma,$slowEma,$fastEma,$date);

									$thisCoinSortValue = $thisCoinSortValue + $thisCrossSortValue;

									$time = strtotime($date);
									$timeLapseMinutes = round((time()-$time) / 60);

									$thisInstanceRecord = Array('coin'=>$cross_coinPair,'period'=>$periodEma,'slow'=>$slowEma,'fast'=>$fastEma,'date'=>$date,'age_in_minutes'=>$timeLapseMinutes,'isUp'=>$emaCrossUp);
									$thisCoinEmaCrossInstanceArray[] = $thisInstanceRecord;
								}else{
									break;
								} 						
						}
						if ($thisCoinSortValue > 0){
							$thisCoinActivityRecord = array('coin_pair'=> $cross_coinPair,'sort_value'=>$thisCoinSortValue,'ema_instances'=>$thisCoinEmaCrossInstanceArray);
							$coinSortArray[] = $thisCoinActivityRecord;
						} 
					}
				}
			}
			usort($coinSortArray, 'sortByOrder');
			foreach($coinSortArray as $coinRec) {
				echo $coinRec['coin_pair'].' - '. $coinRec['sort_value'];
				echo '<br>';
			}

			$coinArrayJson = json_encode($coinSortArray);
			$jsonFileName = 'ema_bot_recent_results_v2.json';
			$this->s3->write($jsonFileName,$coinArrayJson);
		}
	}

	

	

	public function getCrossSortValue($cross_emaPeriod,$cross_emaSlow,$cross_emaFast,$date)
	{
		$time = strtotime($date);
		$timeLapseMinutes = (time()-$time) / 60;

		$emaSortVal = 0;
		$periodSortVal = 0;
		$ageSortVal = 0;

		$crossNumbersStr = $cross_emaFast.'/'.$cross_emaSlow;
		switch($crossNumbersStr){
			case '4/9':
			$emaSortVal = 2;
			break;
			case '4/18':
			$emaSortVal = 3;
			break;
			case '9/18':
			$emaSortVal = 4;
			break;
		}

		if ($timeLapseMinutes < (4 * 60)){
			$ageSortVal = 10;
		}elseif ($timeLapseMinutes < (24 * 60)){
			$ageSortVal = 6;
		}elseif ($timeLapseMinutes < (48 * 60)){
			$ageSortVal = 3;
		}elseif ($timeLapseMinutes >= (48 * 60)){
			$ageSortVal = 1;
		}

		switch($cross_emaPeriod){
			case '1d':
			$periodSortVal = 20;
			break;
			case '4h':
			$periodSortVal = 3;
			break;
			case '1h':
			$periodSortVal = 2;
			break;
		}
		$sortVal = $emaSortVal + $ageSortVal + $periodSortVal;
		return $sortVal;
	}
}