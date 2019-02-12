<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Class.
 * 
 * @extends CI_Controller
 */
class Dashboard extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('url'));
		$this->load->model('user_model');
		$this->load->library('s3');
	   // $google_verified = $this->session->userdata('verified');
		
        if((!$this->session->userdata('username') && !$this->session->userdata('logged_in'))) {
			redirect('/');
		}
		 
     
		require_once APPPATH . "third_party/php-binance-api.php";
		//$this->binApi = new Twilio\Rest\Client($sid, $token);
		
		//$account   = 'ubc';
		$this->api = createBinanceApiObject($account = 'hanaan');
		$selected = $this->uri->segment(3);
		$this->selected_coin = isset($selected)?$selected:'' ;
		$this->balances = getAccountBalances();
		$this->prices   = getCoinPrices();
		$this->sellCoinSymbol = 'BTC';
		$this->dust = 0.002;

	}

	/**
	 * index function.
	 * 
	 * @access public
	 * @return void
	 */

	public function index( $data = array()) {
		//echo "Here it comes Dashoard page";

		$coinTiers = getCoinTiersArray();
		$coinOrderArray = $coinTiers['all_coins'];
		$jsonFileName = 'ema_bot_recent_results.json';
		$fileResult = $this->s3->read($jsonFileName);
		
		$arr = '';
		$coinSortArray = objToArray(json_decode($fileResult) , $arr);

		$jsonString = '';
		$subhead    = '';
		$account = 'hanaan';
		$api = createBinanceApiObject($account);
    
		//echo "<pre>";print_r($coinSortArray);
		
		

		$resultArray = getBalanceArray($accountFromForm = '', $this->balances, $this->prices);

		$balanceArray = $resultArray[0];
		$balanceChartValue = $resultArray[1];
		$balanceChartLabels = $resultArray[2];
		$balanceTotal = $resultArray[3];
		$balanceBitcoinTotal = $resultArray[4];
		$balanceAltcoinTotal = $resultArray[5];
		$balanceCashTotal  = $resultArray[6];
        $responseData=array(); 
        
		usort($coinSortArray, 'sortByOrder');

			foreach($coinSortArray as $coinEmaSpecs) {
				//echo '<div class="signal">';

				$sort_value = $coinEmaSpecs['sort_value'];

				if ($sort_value > 0){
					$thisCoinPair = $coinEmaSpecs['coin_pair'];
					$symbol = substr($thisCoinPair,0,count($thisCoinPair) - 4);
					$signalsFileName = getTraderSignalsFolderName().'/'.$thisCoinPair.'.json';
					$signalsJsonFileRec = $this->s3->read($signalsFileName);

					$signal_int = null;
					
					$jsonArray = '';
					if ($signalsJsonFileRec){
						$signalsJsonFileRec = objToArray(json_decode($signalsJsonFileRec) , $arr);
						$jsonArray = $signalsJsonFileRec;

						$thisSignalRecord = $jsonArray['last_signal'];
						$signal_int = $thisSignalRecord['signal_up_down_int'];

					}


					$balanceTableRec = $this->balances[$symbol];
					$availableBalance = $balanceTableRec['available'];


					$coinInstanceArray = $coinEmaSpecs['ema_instances'];
					$crossCount = count($coinInstanceArray);
					//$accountOwnerArray = $this->getCoinOwnedAccountList($symbol);
					$thisCoinTier = $this->getCoinTier($coinTiers,$symbol);


					if ($signal_int == '1'){
						$signalDivClass = 'coin_up';
					}elseif ($signal_int == '-1'){
						$signalDivClass = 'coin_down';
					}else{
						$signalDivClass = 'coin_t'.$thisCoinTier;
					}

					if(isset($coinOrderArray[$symbol])) {
						$thisCoinMktCapPlace = $coinOrderArray[$symbol];
					} else {
						$thisCoinMktCapPlace = '';
					}
					
					if ($thisCoinMktCapPlace == ''){
						$thisCoinMktCapPlace_format = '';
					}else{
						$thisCoinMktCapPlace_format = ' #'.$thisCoinMktCapPlace;
					}

					$responseData[] = array(
											 'signalDivClass' => $signalDivClass,
											 'jsonString'     => $jsonString,
											 'sort_value'     => $sort_value,
											 'subhead'        => $subhead,
											 'user'           => 'admin',
											 'pass'		      => 'beachball',
											 'thisCoinMktCapPlace_format' => $thisCoinMktCapPlace_format,
											 'symbol'         => $symbol
										   );
				}
				
				
				
			}


					//$balanceTableRec = $this->balances[$symbol];
					//$availableBalance = $balanceTableRec['available'];

			//print_r($selectedCoinTradeStatusResult); 
			// Array($isTraded=> $coinTraded, $isOwned=> $isOwned, $tradeStatus=> $tradeStatus);

			$data['account'] = $account;
			$data['balanceTotal'] = number_format(round($balanceTotal,8),8);
			$data['balanceBitcoinTotal'] = number_format(round($balanceBitcoinTotal,8),8);
			$data['balanceAltcoinTotal'] = number_format(round($balanceAltcoinTotal,8),8);
			$data['balanceCashTotal'] = number_format(round($balanceCashTotal,8),8);
			$data['responseData'] = $responseData;
			$data['trade_coin_symbol'] = '';
			$data['pairPrice'] = '';


			$data['activeTradesArray'] = getActiveTradesList($account);//array('NYC','BOS');
			
			//$data['selectedCoinTradeStatusResult'] = $selectedCoinTradeStatusResult;

// 			$data['isSelectedCoinTraded'] = $selectedCoinTradeStatusResult['isTraded'];
// 			$data['isSelectedCoinOwned'] = $selectedCoinTradeStatusResult['isOwned'];
// 			$data['selectedCoinTradeStatus'] = $selectedCoinTradeStatusResult['tradeStatus'];
			
			//$data['sellBotParams'] = getSellBotParameters();
			
		//$test_item = array('NYC','BOS');
		//$this[test_item] = $test_item;

			$sessionData = $data;
			
			$data['balances'] = $this->balances;
			$data['sellCoinSymbol'] = $this->sellCoinSymbol;
			$data['prices'] = $this->prices;
			$data['dust'] = $this->dust;
			$data['bookPriceArray'] = $this->api->bookPrices();
			$data['selected_coin'] = $this->selected_coin;



			$this->session->set_userdata($sessionData);
			
			
			// print_r($data);

			$this->load->view('header');
			$this->load->view('dashboard/index' , $data);		
			$this->load->view('footer');
		//echo '</div>';
	}

	/**
	 * getCoinTier function.
	 * 
	 * @access public
	 * @return void
	 */

 ##### ADDED BY HANAAN
 

	public function getCoinTier($coinTiers,$symbol){
		$t1 = ($coinTiers['tier_I']);
		$t2 = ($coinTiers['tier_II']);
		$t3 = ($coinTiers['tier_III']);

		if (in_array($symbol,$t1)){
			return 1;
		}elseif (in_array($symbol,$t2)){
			return 2;
		}elseif (in_array($symbol,$t3)){
			return 3;
		}else{
			return 4;
		}
		return $thisCoinTier;
	}

	/**
	 * getCoinOwnedAccountList function.
	 * 
	 * @access public
	 * @return void
	 */


	public function getCoinOwnedAccountList($symbol)
	{
		//die('getCoinOwnedAccountList');
		$accountsArray = getApiKeyAccounts();
		//print_r($accountsArray);
		$sellCoinSymbol = 'BTC';
		$accountOwnerArray = Array();

		//$homePath = getHomePath();
		foreach ($accountsArray as $account){
			$arr = '';
		
			$coinFilePath = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json'; 
			$coinJsonFileStatusArray = $this->s3->read($coinFilePath);
			$coinJsonFileStatusArray = objToArray(json_decode($coinJsonFileStatusArray) , $arr);
				
			//$coinJsonFileThere = $coinJsonFileStatusArray[0];

			// echo "<pre>";
			// 	print_r($coinJsonFileStatusArray);

			$coinJsonFileContentArray = $coinJsonFileStatusArray;
			$status = $coinJsonFileContentArray['status'];

			if ($status != 'inactive' && $status != ''){
				array_push($accountOwnerArray,$account);
			}
		}
		return $accountOwnerArray;
	}

	/**
	 * selectCoin function.
	 * 
	 * @access public
	 * @return void
	 */

	public function selectCoin () {

		$data = array();
		$data = $this->session->userdata();
		//print_r($data);exit;
		$account = $data['account'];
		$post = $this->input->post();

		$sellCoinSymbol = 'BTC';
		$dust = 0.002;
		$minBtcTrade = 0.005;
         
        $selected_coin = $this->uri->segment(3);
        if($selected_coin)
        {
			 $trade_coin_symbol = isset($selected_coin)?$selected_coin:'';
		}else{
			 $trade_coin_symbol = isset($post['trade_coin_symbol'])?$post['trade_coin_symbol']:'';
		}

		 $tradePair = $trade_coin_symbol.$sellCoinSymbol;

		$prices   = getCoinPrices();
		

		$balances = getAccountBalances();
       
		$bookPriceArray = $this->api->bookPrices();
	
		 $pairPrice = $prices[$tradePair];
		
 

		$formId = 'main_trade_'.$account;
		$coinAmountDivId = 'coindiv_'.$account; 
		$btcAmountInputId = 'btc_trade_'.$account; 
		$coinAmountInputId = 'coin_trade_'.$account; 

		$accountsBalanceArray = array();
		
		$thisAccountArray = Array($account=>Array('account'=> $data['account'] , 'balances'=>$balances, 'balace_total'=>$data['balanceTotal'],'balace_total_bitcoin'=>$data['balanceBitcoinTotal'],'balace_total_altcoin'=>$data['balanceAltcoinTotal'],'balace_total_cash'=>$data['balanceCashTotal']));

		$accountsBalanceArray = $accountsBalanceArray + $thisAccountArray;
 

		$thisAccountArray = $accountsBalanceArray[$account];
		$balances = $thisAccountArray['balances'];
		$btcBalance = $thisAccountArray['balace_total'];
		$btcAvailable = $thisAccountArray['balace_total_bitcoin'];

		$coinBalance = getBinanceCoinBalance($balances,$trade_coin_symbol);	

		$coinBtcValue = $pairPrice * $coinBalance;

		if ($coinBtcValue > $dust){
			$formButtonText = 'Sell all '.$trade_coin_symbol.' now';
		} else {
			$formButtonText = 'Execute Buy Tradeeee';
		}

		$onePctOfBtc = $btcBalance / 100;
		$onePctCoin  = $onePctOfBtc * $pairPrice;

		$res = $this->traderPctOptions($onePctOfBtc , $onePctCoin , $trade_coin_symbol , $sellCoinSymbol , $data['account'] , $pairPrice , $formId , $coinAmountDivId , $btcAmountInputId , $coinAmountInputId , $btcAvailable , $minBtcTrade  );
		

		//$data = $sesionData;
		$data['trade_coin_symbol'] = $trade_coin_symbol;
		$data['pairPrice'] = $pairPrice;
		$data['formButtonText'] = $formButtonText;
		$data['coinAmountDivId'] = $coinAmountDivId;
		$data['btcAmountInputId'] = $btcAmountInputId;
		$data['coinAmountInputId'] = $coinAmountInputId;
		$data['jsParam'] = $res;

		$data['bookPriceArray'] = $bookPriceArray;
		$data['sellCoinSymbol'] = $sellCoinSymbol;

		$data['balances'] = $balances;
		$data['prices'] = $prices;
		$data['dust'] = $dust;
		$data['selected_coin']= $selected_coin;
		
      // echo "<pre>";  print_r($balances);die;
		$this->load->view('header');
		$this->load->view('dashboard/index' , $data);		
		$this->load->view('footer');

	}

	/**
	 * traderPctOptions function.
	 * 
	 * @access public
	 * @return void
	 */	

	public function traderPctOptions ($onePctOfBtc , $onePctCoin , $trade_coin_symbol, $sellCoinSymbol , $account , $pairPrice , $formId , $coinAmountDivId , $btcAmountInputId , $coinAmountInputId , $btcAvailable , $minBtcTrade) {

		$api = createBinanceApiObject($account);

		$tradePctOptions = Array(0.25,1,1.5,2,2.5,3,4,5,7.5,10,12);

		$html = '';
		foreach($tradePctOptions as $thisPctOption){

			$thisPctOfBtc = $onePctOfBtc * $thisPctOption;						

			$thisPctOfBtc_format = number_format(round($thisPctOfBtc,8),8);

			$thisAmountOfCoinForTrade = $thisPctOfBtc / $pairPrice;

			$thisAmountOfCoinForTrade = normalizeBinanceTradeAmount($trade_coin_symbol,$sellCoinSymbol,$thisAmountOfCoinForTrade,$api);


			if ($thisAmountOfCoinForTrade < 5){
				$dec = 2;
			}else{
				$dec = 0;
			}

			$thisAmountOfCoinForTrade_format = round($thisAmountOfCoinForTrade,$dec);

			$jsParam =  '\''.$formId.'\',\''.$btcAmountInputId.'\',\''.$thisPctOfBtc_format.'\',\''.$coinAmountDivId.'\',\''.$thisAmountOfCoinForTrade_format.'\',\''.$coinAmountInputId.'\'';
			

			if($thisPctOfBtc > $btcAvailable || $thisPctOfBtc < $minBtcTrade){
				$html .=  ('<span class="disabletext">'.$thisPctOption.'%</span> | ');
			}else{
				$html .= '<a href="javascript:enterTradeAmount('.$jsParam.')"><span class="btn">'.$thisPctOption.'%</span></a>&nbsp;';
			}
		}
		return $html;
	}

	/**
	 * updateSignal function.
	 * 
	 * @access public
	 * @return void
	 */	

	public function updateSignal() {
		$post = $this->input->post();
		$trade_coin_symbol = $post['trade_coin_symbol'];

		$signal_notes_form = $post['signal_notes'];
		$signal_int_form   = $post['signal_int'];
		$signal_target     = $post['signal_Target'];
		$sellCoinSymbol = 'BTC';
		$signalAdded = true;
		$jsonFileName = $trade_coin_symbol.$sellCoinSymbol.'.json';
		$fileName = getTraderSignalsFolderName().'/'.$jsonFileName;

		// echo $jsonFileName;
		// exit;

		$signalsJsonFileRec = $this->s3->read($fileName);

		//$signalsJsonThere = $signalsJsonFileRec[0];
		if ($signalsJsonFileRec){
			$jsonArray = $signalsJsonFileRec;
			$arr = '';
			$jsonArray = objToArray(json_decode($jsonArray) , $arr);
			$historicalSignalsArray = $jsonArray['historical_signals'];
		}else{
			$historicalSignalsArray = Array();
		}
				
		$ts = date("Y-m-d G:i:s",time());

		$thisSignalRecord = Array('timesstamp'=>$ts,'signal_up_down_int'=>$signal_int_form,'signal_target'=>$signal_target,'signal_notes'=>$signal_notes_form);
		array_push($historicalSignalsArray, $thisSignalRecord);
		$fileArray = Array('last_signal'=>$thisSignalRecord,'historical_signals'=>$historicalSignalsArray);
		
		$writeRes = $this->s3->write($fileName,json_encode($fileArray));
		if($writeRes['ObjectURL']) {
			redirect('dashboard');
		}
		$main_action = 'prepare_trade';
	}
	
	
		/* Binance Execute Trade */
	
	public function binance_execute_trade()
	{
		$post = $this->input->post();
		$api=$this->api;
		$sellCoinSymbol=$this->sellCoinSymbol;
		$account= $post['account'];
		$main_action= $post['main_action'];
		$balances = $api->balances(true);
		$coinBalance = getBinanceCoinBalance($balances,$post['trade_coin_symbol']);
		$btc_trade_ubc=isset($_POST['btc_trade_ubc'])?$post['btc_trade_ubc']:'';
		$coin_trade_name= isset($_POST['coin_trade_ubc'])?$post['coin_trade_ubc']:'';
        $accountCoinTradeAmount = normalizeBinanceTradeAmount($post['trade_coin_symbol'],$sellCoinSymbol,$coin_trade_name,$api);
        $bookPriceArray = $this->api->bookPrices();
        $notifHtml = '';
        $logText = '';
        $thisPriceIncreaseFormat='';
        $trade_result_msg='';
        $getFile= '';
        $getFileLog= '';
        $getSellFile= '';
        $ts_filename = date("Y-m-d h-i-s",time());
        $ts = date("Y-m-d G:i:s",time());
        
  echo '<h2>main action: '.$main_action.'</h2>';//terminate_trade
       
       if ($main_action == 'Execute Buy Tradeeee'){
		   
		   if ($account == 'WAS-hanaan'){

  
				$isTest = 1;

				$thisTimezone = date_default_timezone_get();
				date_default_timezone_set('UTC');
				$nowInt = time();
				$nowInt = $nowInt * 1000;
				date_default_timezone_set($thisTimezone);
		
				$bookPriceRec = $bookPriceArray[$_POST['trade_coin_symbol'].$sellCoinSymbol];
				$currentAskPrice = $bookPriceRec['ask'];
				$tradeResultJson = '{"symbol":"'.$_POST['trade_coin_symbol'].$sellCoinSymbol.'","orderId":99999999,"clientOrderId":"a9a9a9a9a9a9a9a9a9a9a9a9",
				"transactTime":'.$nowInt.',"price":'.$currentAskPrice.',"origQty":'.$accountCoinTradeAmount.',"executedQty":'.$accountCoinTradeAmount.',
				"cummulativeQuoteQty":"0.01102870","status":"FILLED","timeInForce":"GTC","type":"MARKET","side":"BUY",
				"fills":[{"price":'.$currentAskPrice.',"qty":'.$accountCoinTradeAmount.',
				"commission":"0.005","commissionAsset":"BNB","tradeId":88888888}]}';
		
				$cummulativeQuoteQty = $currentAskPrice * $accountCoinTradeAmount;
		
				$fillsArray = Array(Array('price'=>$currentAskPrice,'qty'=>$accountCoinTradeAmount,'commission'=>0.005,'commissionAsset'=>'BNB','tradeId'=>88888888));
		
				$tradeResult = json_decode($tradeResultJson);
				$tradeResult = Array('symbol'=>$_POST['trade_coin_symbol'].'BTC','orderId'=>99999999, 'clientOrderId' => 'a9a9a9a9a9a9a9a9a9a9a9a9','transactTime'=>$nowInt,'price'=>$currentAskPrice,'origQty'=>$accountCoinTradeAmount,'executedQty'=>$accountCoinTradeAmount,'cummulativeQuoteQty'=>$cummulativeQuoteQty,'status'=>'FILLED','timeInForce'=>'GTC','type'=>'MARKET','side'=>'BUY','fills'=>$fillsArray);
		
				echo '<h1>TEST Trade added</h1>';
			}else{
				$isTest = 0;
				$tradeResult = buyTradeResult($_POST['trade_coin_symbol'] , $accountCoinTradeAmount);

			if (array_key_exists('statusCode',$tradeResult)){
				$err = $tradeResult['body'];
				$trade_result_msg= '<h1>Trade error - TELL HANAAN: '.$err.'<h1>';
			}else{
				$trade_result_msg='<h1>Trade Successful</h1>';
			}
		}
	
	  // Check Status code 
		$isTradeError = array_key_exists('statusCode',$tradeResult);
		if ($isTradeError){
		$tradeErrorCode = $tradeResult['statusCode'];
		$tradeErrorMsg = $tradeResult['body'];
		$notificationSubject = 'BUY ERROR FOR '.$_POST['trade_coin_symbol'];
		$notifHtml = $notifHtml.'<p>Rebuy BUY ERROR '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
		$logText = $logText.' - Buy order ERROR: '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
		//$thisPriceIncreaseFormat= isset($thisPriceIncreaseFormat)?$thisPriceIncreaseFormat: ' ';
	}else{
		$notificationSubject = 'Rebuy watched '.$_POST['trade_coin_symbol'].' at: '.$thisPriceIncreaseFormat;
		

		$tradeResultFills = $tradeResult['fills'];
		
	
		if ($isTest == 1){
			$buyPrice = $currentAskPrice;
		}else{
			$buyPrice = $tradeResultFills[0]['price'];
		}
		$actionsArray = Array();
		$tradeNumber = 1;
		$tradeElementKey = 'TRADE-'.$tradeNumber;

		$buyTime = date("Y/m/d h-i-s",time());
		
		$tradesArray = Array($tradeElementKey=>Array('bot_buy'=>0,'bot_sell'=>null,'sell_type'=>null,'buy_time'=>$buyTime,'buy_trade'=>$tradeResult,'sell_trade'=>null));
		$coinInfoArray = Array('id'=>uniqid(),'action'=>'Initialize','account'=>$account,'symbol'=>$_POST['trade_coin_symbol'],'status'=>'owned','is_rebuy'=>0,'is_armed'=>0, 'is_test'=>$isTest,'qty'=>$accountCoinTradeAmount,'first_buy_price' => $buyPrice,'this_buy_price' => $buyPrice,'trades'=>$tradesArray,'actions'=>$actionsArray);
		
		
		 $sellBotCoinFile = getBotCoinsFolderName().'/'.$account.'/'.$_POST['trade_coin_symbol'].'.json';
		 $sellBotCoinFile_log = 'json-log/'.$account.'_'.$_POST['trade_coin_symbol'].'_'.$ts_filename.'.json';
		 $coinInfoArray['timestamp'] = $ts;
	     $jsonData = json_encode($coinInfoArray);
	     
	      // Coin file
		  $getFile=$this->s3->write($sellBotCoinFile,$jsonData);
		 
		 // Coin File Log
		 
		 if($main_action =='Execute Buy Tradeeee'){
		      $getFileLog=$this->s3->write($sellBotCoinFile_log,$jsonData);
	      }
		
		
		$notificationSubject = 'TRADER BUY: '.$accountCoinTradeAmount.' of '.$_POST['trade_coin_symbol'];
		
		
	}

		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: bot_notifs@algo.systems";
		mail('hanaan@me.com','SelBot: '.$account.'|'.$notificationSubject,$notifHtml,$headers);   
		   
	   }else{
            
			$explodedQuantity = explode('.', $coinBalance);
			if($explodedQuantity) {
				$coinBalance = $explodedQuantity[0];
			} else {
				$coinBalance = $coinBalance;
			}

			$ch = curl_init();
### HANAAN DEBUG:
			curl_setopt($ch, CURLOPT_URL, LAMBDA_API."/dev/sell");
//			curl_setopt($ch, CURLOPT_URL, LAMBDA_API."dev/sell");
### HANAAN DEBUG:



			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "symbol=".$_POST['trade_coin_symbol']."&quantity=".$coinBalance);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
			curl_setopt($ch, CURLOPT_POST, 1);

				$headers = array();
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

				$result = curl_exec($ch);
				if (curl_errno($ch)) {
					echo 'Error:' . curl_error($ch);
				}
	               curl_close ($ch);

				$sellTradeResult = (array) json_decode($result);
				
                
                $isTradeError = array_key_exists('statusCode',$sellTradeResult);
                echo '<hr />TRADE RECORD:<br />';
                print_r($sellTradeResult);
                echo '<hr />';
                
                if ($isTradeError){
					$err = $sellTradeResult['body'];
					$trade_result_msg= '<h1>Trade error - TELL HANAAN: '.$err.'<h1>';
				   
				}else{
				
					$filePath = 'bot_sell_orders/'.$_POST['trade_coin_symbol'].'-'.$sellTradeResult['orderId'].'.json';					
					$getSellFile=$this->s3->write($filePath,$result);
					
					
					
					### HANAAN DEBUG
					### ADD FINALIZE TRADE FILE
					$symbol = $_POST['trade_coin_symbol'];
					$coinFilePath = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json'; 
					$coinJsonFileStatusArray = $this->s3->read($coinFilePath);
					$coinJsonFileStatusArray = objToArray(json_decode($coinJsonFileStatusArray) , $arr);


//ADD LATEST TRADE TO FILE v v v
					$tradesArray =  $coinJsonFileStatusArray['trades'];
					$tradeArrayLength = count( $tradesArray );
					$lastTradeRec = end($tradesArray);
					$lastTradeRec_key = key($tradesArray);
				
					## Get last trade from trades array
					$lastTradeRec['bot_sell'] = 0;
					$lastTradeRec['sell_type'] = 'manual-from-dashboard';
					$lastTradeRec['sell_trade'] = $sellTradeResult;
					## Add updated last trade back to trades array
					$tradesArray[$lastTradeRec_key] = $lastTradeRec;
					## Add updated trades array to coin record
					$coinJsonFileStatusArray['trades'] = $tradesArray;

					$thisActionNotes = '';
					$thisAction = 'sell for profit';
					$coinJsonFileStatusArray = addActionToActionsArray($coinJsonFileStatusArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);

//ADD LATEST TRADE TO FILE ^ ^ ^

					createFinalTradeJsonFile($account,$symbol,$coinJsonFileStatusArray);
					
					
					// INITIALIZE TRADE JSON AS *INACTIVE*

					$actionsArray = Array();
					$tradesArray = Array();
					$coinInfoArray = Array('id'=>uniqid(),'action'=>'Initialize','account'=>$account,'symbol'=>$symbol,'status'=>'inactive','is_rebuy'=>0,'is_armed'=>0, 'is_test'=>0,'trades'=>$tradesArray,'actions'=>$actionsArray);


					$sellBotCoinFile = getBotCoinsFolderName().'/'.$account.'/'.$symbol.'.json';
					$sellBotCoinFile_log = 'json-log/'.$account.'_'.$symbol.'_'.$ts_filename.'.json';
					$coinInfoArray['timestamp'] = $ts;
					$jsonData = json_encode($coinInfoArray);

					// Coin file
					$getFile=$this->s3->write($sellBotCoinFile,$jsonData);
					
					### HANAAN DEBUG
					 
			       
				 }

		}
  
	    $data['account']=$account;
		$data['trade_coin_symbol']=$_POST['trade_coin_symbol'];
		$data['main_action']=$main_action;
		$data['btc_trade_ubc']=$btc_trade_ubc;
		$data['coin_trade_ubc']=$coin_trade_name;
		$data['sellCoinSymbol']=$sellCoinSymbol;
		$data['trade_result_msg']=$trade_result_msg;
		
		
			 if($main_action =='Execute Buy Tradeeee'){
			   
				   $data['getFile']=$getFile;
				   $data['getFileLog']=$getFileLog;
			 }else{
				   
				   $data['getSellFile']=$getSellFile['ObjectURL'];
				 
				 }
	     
		$this->load->view('header');
		$this->load->view('dashboard/binance_execute_trade' ,$data);		
		$this->load->view('footer');
 }
 

}
