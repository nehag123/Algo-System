<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 Cron Job
 **/
class Sell_bot_cron extends CI_Controller {

  public function __construct() {
		parent::__construct();
		
		$this->load->helper(array('url'));
		$this->load->library('s3');
		$this->load->database();
		
		require_once APPPATH . "third_party/php-binance-api.php";
	}
	
	
  public function index()
  {
  	  //$file = APPPATH.'third_party/cron.txt';
	  // $text =  date('Y-m-d h:i:s A')."\r\n";
	  // file_put_contents($file, $text, FILE_APPEND);

	  $sellCoinSymbol = 'BTC';
	  //$btcUsdChangeArray = btsusdChangeResponder();

	  //$changeInBTC = display_btsusdChange($btcUsdChangeArray);

	  $changePctFormatBid = '';

	  $thisPriceIncrease = '';


	
	  
	  // $id = gen_uuid();
	//~ $_1m = number_format(isset($btcUsdChangeArray['1min'])?$btcUsdChangeArray['1min']:'',2);
	//~ $_2m = number_format(isset($btcUsdChangeArray['2min'])?$btcUsdChangeArray['2min']:'',2);
	//~ $_5m = number_format(isset($btcUsdChangeArray['5min'])?$btcUsdChangeArray['5min']:'',2);
	//~ $_10m = number_format(isset($btcUsdChangeArray['10min'])?$btcUsdChangeArray['10min']:'',2);
	
	/*
	$_1m = isset($btcUsdChangeArray['1min'])?$btcUsdChangeArray['1min']:'';
	$_2m = isset($btcUsdChangeArray['2min'])?$btcUsdChangeArray['2min']:'';
	$_5m = isset($btcUsdChangeArray['5min'])?$btcUsdChangeArray['5min']:'';
	$_10m = isset($btcUsdChangeArray['10min'])?$btcUsdChangeArray['10min']:'';
	$_15m = isset($btcUsdChangeArray['15min'])?$btcUsdChangeArray['15min']:'';
	$result=array('b_id'=>$id,'chg_1_min'=>$_1m,'chg_2_min'=>$_2m,'chg_5_min'=>$_5m,'chg_10_min'=>$_10m,'chg_15_min'=>$_15m);
	
	$this->db->insert('btc_change',$result);
	$insert_id = $this->db->insert_id();
	if($insert_id)
	{
		echo '<br />New record created successfully for BTC';
	}
	
	*/
	  
    $testMode = false;
    if ($testMode){
		$ArmPct = 3;//4; // Percent price rise from bought price
		$rebuyRisePct = 0.5;//4; // Percent price rise from bought price
		$trailPct = 10;// How much of the profit are we willing to lose
		$trailHardPercentMax = 2; // The trail% is the higher amount of $trailPct and $trailHardPercentMax
		$abendonDropBelowPreviousBuyPct = -5; // The trail% is the higher amount of $trailPct and $trailHardPercentMax
		$stoplossPct = -30;// Percent drop before sale for loss.
		$rebuyStoplossPct = -5;// Percent drop before sale for loss.
		$rebuyShortLeashRatio = 0.75; // arm% and trail% get reduced Rebuy
		$btcBalanceThreshold = 0.003; // ignore balances below that
    }else{
		$ArmPct = 3.5;//4; // Percent price rise from bought price
		$rebuyRisePct = 1.5;//4; // Percent price rise from bought price
		$trailPct = 16;// How much of the profit are we willing to lose
		$trailHardPercentMax = 3; // The trail% is the higher amount of $trailPct and $trailHardPercentMax
		$abendonDropBelowPreviousBuyPct = -2; // The trail% is the higher amount of $trailPct and $trailHardPercentMax
		$stoplossPct = -25;// Percent drop before sale for loss.
		$rebuyStoplossPct = -5;// Percent drop before sale for loss.
		$rebuyShortLeashRatio = 0.75; // arm% and trail% get reduced Rebuy
		$btcBalanceThreshold = 0.005; // ignore balances below that
    }
    
  $ignoreSymbolArray = Array('BTC', 'BNB', 'TUSD', 'USDT', 'PAX', null);
  
  $accountsArray = getApiKeyAccounts();  
  
  echo 'ACCOUNTS:<br />';
  print_r($accountsArray);
  
  
  //$createSellBot = createSellBotFolder($accountsArray);

  $jsonFiles     = initializeJsonFiles($accountsArray,$sellCoinSymbol,$btcBalanceThreshold, $ignoreSymbolArray); 
  
   
   foreach ($accountsArray as $account){
		echo '<h1>Process account: '.$account.'</h1>';

		$api = createBinanceApiObject($account);
		$bookPriceArray = $api->bookPrices();
		$exchangeInfoRaw = $api->exchangeInfo();
		
		$coinJsonFileArray = listAccountCoinJsonFiles($account);
		$logText = '';
		$notifText = '';
		$notifHtml = 'Account: '.$account.'<br />';
		
		
		
		foreach ($coinJsonFileArray as $coinFileName){
		   
			if ($coinFileName != '.json'){
	       
	         $arr = '';
		
			 $coinFilePath = 'sell_bot_active_coins/'.$account.'/'.$coinFileName; 
			 $coinJsonFileStatusArray = $this->s3->read($coinFilePath); 
			 $coinJsonFileContentArray = objToArray(json_decode($coinJsonFileStatusArray) , $arr);

//print_r($coinJsonFileContentArray);
//echo '<br />';

			//$coinJsonFileStatusArray = readJsonFile($coinFilePath);
			
			$status = isset($coinJsonFileContentArray['status'])?$coinJsonFileContentArray['status']:'';

		    $symbol = isset($coinJsonFileContentArray['symbol'])?$coinJsonFileContentArray['symbol']:'';
			
			$l = strlen($coinFileName);
			$symbolFromFileName = substr($coinFileName, 0, $l - 5);

			if ($symbol == ''){
				$symbol = $symbolFromFileName; 
			}
			
			$symbolAndFileNameMatch = true;
			if ($symbol != $symbolFromFileName){
				$symbolAndFileNameMatch = false;
			}
			
						
			$coinDisabled = in_array($symbol, $ignoreSymbolArray);
			if ($status != '' && $status != 'inactive' && $status != 'delisted' && !$coinDisabled && $symbolAndFileNameMatch){

				if ($status == 'standby'){
					$low_watched_price = $coinJsonFileContentArray['low_watched_price'];
					$bookPriceRec = $bookPriceArray[$symbol.$sellCoinSymbol];
					$currentAskPrice = $bookPriceRec['ask'];

					$standbyTradePriceRiseFromLowPct = 0.75; // NEEDS TO BE WITH OTHER PARAMETERS


					if ($currentAskPrice < $low_watched_price){
						$low_watched_price = $currentAskPrice;
						$lowestExecuteBuyPrice = $low_watched_price * (1 + ($standbyTradePriceRiseFromLowPct / 100));
						echo '<p>NEW LOW STANDBY PRICE: '.$currentAskPrice.'<br />WILL BUY COIN AT: '.$lowestExecuteBuyPrice.'</p>';

						$coinJsonFileContentArray['low_watched_price'] = $currentAskPrice;
						$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
						$jsonData = json_encode($coinJsonFileContentArray);

						$thisAction = 'New low watched standby price';
					
						$thisActionNotes = 'New low sb: '.$currentAskPrice;
						$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);

						$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
					}else{
					
						$lowestExecuteBuyPrice = $low_watched_price * (1 + ($standbyTradePriceRiseFromLowPct / 100));
						echo '<h3>'.$symbol.': '.$status.'</h3>';
						echo '<pPRICE: '.$currentAskPrice.'<br />LOW STANDBY PRICE: '.$low_watched_price.'<br />WILL BUY COIN AT: '.$lowestExecuteBuyPrice.'</p>';

						if ($currentAskPrice > $lowestExecuteBuyPrice){

								$tradeQuantity = $coinJsonFileContentArray['qty'];

								// EXECUTE TRADE - BUY


								$tradeResult =   buyCoin($symbol,$sellCoinSymbol,$tradeQuantity,$api,$account);
							
								// EXECUTE TRADE
							
								$isTradeError = array_key_exists('code',$tradeResult);
								if ($isTradeError){
									$tradeErrorCode = $tradeResult['code'];
									$tradeErrorMsg = $tradeResult['msg'];
									$notificationSubject = 'INITIAL BUY ERROR FOR '.$symbol;
									$notifHtml = $notifHtml.'<p>INITIAL BUY ERROR '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
									$logText = $logText.' - Buy order ERROR: '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
									$logText = $logText.'*901*';
								}else{
									$logText = $logText.'*903*';
									$notificationSubject = 'STANDBY';

									$tradeResultFills = $tradeResult['fills'];
									$tradeResultFills = $tradeResultFills[0];
									$buyPrice = $tradeResultFills['price'];
							
									echo 'INITIAL BUY PRICE ##: '.$buyPrice;
							
									$logText = $logText.'*909*';
							
									//ADD TRADE TO JSON
							
									//$tradesArray =  $coinJsonFileContentArray['trades'];
									// $tradeArrayLength = count( $tradesArray );
									$nextTradeKeyNumber = 1;//$tradeArrayLength + 1;

									$newTradeKey = 'TRADE-'.$nextTradeKeyNumber;
								
									$buyTime = date("Y/m/d h-i-s",time());
									$newTradeArray = Array('bot_buy'=>1,'bot_sell'=>null,'sell_type'=>null,'buy_time'=>$buyTime ,'buy_trade'=>$tradeResult,'sell_trade'=>null);
									$tradesArray[$newTradeKey] = $newTradeArray;
									// $tradesArray = Array($newTradeArray);
								
									$coinJsonFileContentArray['trades'] = $tradesArray;
							
									// ADD TRADE TO JSON
								
									$logText = $logText.'*912*';
									$coinJsonFileContentArray['status'] = 'owned';
									$coinJsonFileContentArray['this_buy_price'] = $buyPrice;
									$thisAction = 'Execute initial buy after standby';
								
									$thisActionNotes = '';
									$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);
							
									// $coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
							
								  	$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
									$jsonData = json_encode($coinJsonFileContentArray);
									$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
								
				 					$logText = $logText.'*922*';								
							
									$logText = $logText.' - Buy order status: '.$tradeResult['status'].' - Buy orderId: '.$tradeResult['orderId'].' - Buy qty: '.$tradeResult['executedQty'].' - Buy price: '.$buyPrice;
									$notifHtml = $notifHtml.'<p>STANDBY EXECUTE BUY! QTY: '.$tradeQuantity.'<br />Trade results:</p>';
									$notifHtml = $notifHtml.'<p>Buy trade order:<br />Status: '.$tradeResult['status'].'<br />Buy orderId: '.$tradeResult['orderId'].'<br />Buy qty: '.$tradeResult['executedQty'].'<br />Buy price: '.$buyPrice;
								}
								$isMainEvent = true;
								$isNotifyEvent = true;
								$logText = $logText.'*929*';
								
								
														}else{						
						}
						
					
					
					}	
				
				
				
				
				}else{
					$isArmed = isset($coinJsonFileContentArray['is_armed'])?$coinJsonFileContentArray['is_armed']:'';
					$isRebuy = isset($coinJsonFileContentArray['is_rebuy'])?$coinJsonFileContentArray['is_rebuy']:'';

					$tradeQuantity = isset($coinJsonFileContentArray['qty'])?$coinJsonFileContentArray['qty']:'';

					$first_buy_price = isset($coinJsonFileContentArray['first_buy_price'])?$coinJsonFileContentArray['first_buy_price']:'';
					$this_buy_price = isset($coinJsonFileContentArray['this_buy_price'])?$coinJsonFileContentArray['this_buy_price']:''; 

					if ($this_buy_price == null){
					
						if (array_key_exists('trades',$coinJsonFileContentArray)){
						
							$tradesArray =  $coinJsonFileContentArray['trades'];
							$tradeArrayLength = count( $tradesArray );
							$lastTradeRec = end($tradesArray);
							$this_buy_price = $lastTradeRec['buy_trade']['fills'][0]['price'];
							$coinJsonFileContentArray['this_buy_price'] = $this_buy_price;
							//$coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
							$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
							$jsonData = json_encode($coinJsonFileContentArray);
							$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);

						}else{
					
						}
					}
				
					$high_price = isset($coinJsonFileContentArray['high_price'])?$coinJsonFileContentArray['high_price']:'';
					$low_price = isset($coinJsonFileContentArray['low_price'])?$coinJsonFileContentArray['low_price']:'';
					$sold_price = isset($coinJsonFileContentArray['this_sold_price'])?$coinJsonFileContentArray['this_sold_price']:'';
					if ($symbol == 'TEST'){
						$currentBidPrice = getTestPrice();
					}else{
						$notExists=array('BCX','CTR','ONG','SBTC');
						if(!in_array($symbol,$notExists))
						{
							$bookPriceRec = $bookPriceArray[$symbol.$sellCoinSymbol];
							$currentBidPrice = $bookPriceRec['bid'];
						}else{
							$currentBidPrice = 0;
	//					print_r();
						}
					}

					if ($this_buy_price > 0 && $currentBidPrice > 0){
						if ($status == 'owned'){						
							$changePct = pct_Chg_Log($this_buy_price,$currentBidPrice,6);
							$changePctFormat = number_format($changePct,2).'%';

							$changePct_hi = pct_Chg_Log($this_buy_price,$high_price,7);
							$changePctFormat_hi = number_format($changePct_hi,2).'%';
						}elseif ($status == 'watched'){
							if($sold_price > 0){
								$changePct = pct_Chg_Log($sold_price,$currentBidPrice,8);
								$changePctFormat = number_format($changePct,2).'%';

								$changePct_hi = pct_Chg_Log($sold_price,$high_price,9);
								$changePctFormat_hi = number_format($changePct_hi,2).'%';
							}else{
								$changePct = 0;
								$changePct_hi = 0;
								$changePctFormat = '';
								$changePctFormat_hi = '';
							}				
					}								
					}else{
						$changePct = 0;
						$changePct_hi = 0;
						$changePctFormat = '';
						$changePctFormat_hi = '';
					}				
			
					$isMainEvent = false;
					$isNotifyEvent = false;
					$notificationSubject = '';
				
					echo '<h3>'.$symbol.': '.$status.' - QTY: '.$tradeQuantity.'</h3>';
					echo '<p>';
					echo 'Armed:'.$isArmed.' - Rebuy:'.$isRebuy;
				
						if (array_key_exists('trades',$coinJsonFileContentArray)){
							$tradesArray_TEST =  $coinJsonFileContentArray['trades'];
							$tradeArrayLength_TEST = count( $tradesArray_TEST);
							$nextTradeKeyNumber_TEST = $tradeArrayLength_TEST + 1;

							// echo '<p>L: '.$tradeArrayLength_TEST.' - L+1: '.$nextTradeKeyNumber_TEST.'</p>';
						}				
								
					echo '<br />Price start:'.$first_buy_price.'<br />Latest buy:'.$this_buy_price;
					echo '<br />Now:'.$currentBidPrice.'<br />Chg:'.$changePctFormat;
					echo '<br />Chg from hi: '.$changePctFormat_hi.'<br />';
					echo 'Buy: '.$this_buy_price.' - Hi: '.$high_price;
					
					if($isArmed){$armedStr='armed-';}else{$armedStr='';}
					if($isRebuy){$rebuyStr='rebuy-';}else{$rebuyStr='';}
					$logText = $status.'-'.$armedStr.$rebuyStr.'start:'.$first_buy_price.'=latest:'.$this_buy_price.'-Now:'.$currentBidPrice.'-Chg:'.$changePctFormat.' - ';
				
					$hardPctRetracement = $changePct_hi - $changePct;
		
					if ($currentBidPrice != null && ($currentBidPrice < $low_price || $low_price = null || $low_price == '')){ 
						$coinJsonFileContentArray['low_price'] = $currentBidPrice;
						$thisAction = 'Record new low price';
						$thisActionNotes = '';

						$thisActionNotes = 'Prev low: '.$low_price;
						$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);
				
						$low_price = $currentBidPrice;
						//$coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
						 $sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
							 $jsonData = json_encode($coinJsonFileContentArray);
							$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
					
						$logText = $logText.'*01*';
					}elseif ($currentBidPrice != null && $currentBidPrice > $high_price){
						$coinJsonFileContentArray['high_price'] = $currentBidPrice;
						$thisAction = 'Record new high price';

						$thisActionNotes = 'Prev high: '.$high_price;
						$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);
										
						$high_price = $currentBidPrice;
						//$coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
						$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
							 $jsonData = json_encode($coinJsonFileContentArray);
							$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
						$logText = $logText.'*02*';
					}
					$hiPriceFormat = number_format(round($high_price,8),8);
					if ($high_price > 0){
						$hiPriceChg = pct_Chg_Log($currentBidPrice,$high_price,10);
						$hiPriceChgFormat = number_format(round($hiPriceChg,1),1).'%';
						$logText = $logText.'*03*';
					}else{
						$hiPriceChg = 0;
						$hiPriceChgFormat = 'NA';				
						$logText = $logText.'*04*';
					}

					$lowPriceFormat = number_format(round($low_price,8),8);
					if ($low_price > 0){
						$lowPriceChg = pct_Chg_Log($currentBidPrice,$low_price,11);
						$lowPriceChgFormat = number_format(round($lowPriceChg,1),1).'%';
						$logText = $logText.'*05*';
					}else{
						$lowPriceChg = 0;
						$lowPriceChgFormat = 'NA';
						$logText = $logText.'*06*';
					}

					$notifHtml = '<p>Status: '.$status.'|'.$armedStr.'|'.$rebuyStr.'<br />'.'start buy price: '.$first_buy_price.'<br />'.'Latest buy price: '.$this_buy_price;
					$notifHtml = $notifHtml.'<br />'.'Current bid price: '.$currentBidPrice.' - Chg: '.$changePctFormat.'</p>';
					$notifHtml = $notifHtml.'<br />'.'High price: '.$hiPriceFormat.' - Chg:'.$hiPriceChgFormat.'</p>';
					$notifHtml = $notifHtml.'<br />'.'Low price: '.$lowPriceFormat.' - Chg:'.$lowPriceChgFormat.'</p>';

				
					$notificationSubject = 'This is a TEST - Coin '.$symbol.'. Chg: '.$changePctFormat.'%';
					$notifHtml = $notifHtml.'<p>TEST TEST TEST</p>';
				
				
					if ($status == 'owned'){
						if ($isArmed == 1){
							if ($currentBidPrice > $high_price){
								// Enter new_high
								$thisActionNotes = 'Prev high: '.$high_price;
								$high_price = $currentBidPrice;
							
								$coinJsonFileContentArray['high_price'] = $currentBidPrice;
								$thisAction = 'Record new high price owned armed';

								$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);							

							//	$coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
							   $sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
							   $jsonData = json_encode($coinJsonFileContentArray);
								$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);

								echo '<br />Higher price found - Bid:'.$currentBidPrice;
							
							
								$hiPriceChg = pct_Chg_Log($currentBidPrice,$high_price,12);
								$hiPriceChgFormat = number_format(round($hiPriceChg,1),1).'%';
								$logText = $logText.'Higher price found - Bid:'.$currentBidPrice.' Hi:'.$high_price.' Chg:'.$hiPriceChgFormat;
								$logText = $logText.'*07*';
							
								$isMainEvent = true;

							
							}else{

								// Price dropping

								if ($low_price == 0 || $low_price == ''){
									$low_price = $currentBidPrice;
								}
								$lowPriceChg = pct_Chg_Log($currentBidPrice,$low_price,13);
								$lowPriceChgFormat = number_format(round($lowPriceChg,1),1).'%';
								echo '<br />LOW:'.number_format(round($low_price,8),8).'<br />LOW CHG:'.$lowPriceChgFormat;
						
								$topPriceIncrease = $high_price - $this_buy_price;
								$thisPriceIncrease = $currentBidPrice - $this_buy_price;
								echo '<br />CHG:'.number_format(round($thisPriceIncrease,8),8).'<br />TOPCHG:'.number_format(round($topPriceIncrease,8),8);
							
								if ($thisPriceIncrease == 0 || $topPriceIncrease == 0){
									$pctOfProfitGivenBack = 0;
								}else{
									$pctOfProfitGivenBack = pct_Chg_Log($thisPriceIncrease,$topPriceIncrease,14);
								}
							
								$pctOfProfitGivenBackFormat = number_format(round($pctOfProfitGivenBack,1),1).'%';
								echo '<br />GIVEN BACK:'.$pctOfProfitGivenBackFormat;


								if ($currentBidPrice < $low_price){
									$coinJsonFileContentArray['low_price'] = $currentBidPrice;
									$thisAction = 'Record new low price owned armed';
									$thisActionNotes = 'Prev low: '.$low_price;
									$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);

								//	$coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
									$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
								 $jsonData = json_encode($coinJsonFileContentArray);
								$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
								
								
									echo '<br />TEST 1 •••';
									$logText = $logText.'*08*';
								}


								if ($isRebuy){
									$trailPct_actual = $trailPct * $rebuyShortLeashRatio;
									$trailHardPercentMax_actual = $trailHardPercentMax * $rebuyShortLeashRatio;
									echo '<br />TEST 2 •••';
						$logText = $logText.'*09*';
								}else{
									$trailPct_actual = $trailPct;
									$trailHardPercentMax_actual = $trailHardPercentMax;
									echo '<br />TEST 2 •••';
						$logText = $logText.'*10*';
								}
								$logText = $logText.' | pctOfProfitGivenBack: '.$pctOfProfitGivenBack.', trailPct_actual: '.$trailPct_actual.', hardPctRetracement: '.$hardPctRetracement.', trailHardPercentMax_actual: '.$trailHardPercentMax_actual;
								if ($pctOfProfitGivenBack > $trailPct_actual || $hardPctRetracement > $trailHardPercentMax_actual){
									echo '<br />TEST 4 •••';
									echo '|opt-o!a2';
								
									// SELL FOR PROFITS!!!!!
									$logText = $logText.' - Sell for profit:'.$currentBidPrice.' Hi:'.$high_price.'-retrace:'.$pctOfProfitGivenBackFormat;
								
							
									$tradeResult = dumpCoin($symbol,$sellCoinSymbol,$api,$account,$tradeQuantity);
								
									##### EXECUTE TRADE

									$isTradeError = array_key_exists('code',$tradeResult);
									if ($isTradeError){
										$tradeErrorCode = $tradeResult['code'];
										$tradeErrorMsg = $tradeResult['msg'];
										$notificationSubject = 'Sell for profit ERROR FOR '.$symbol;
										$notifHtml = $notifHtml.'<p>Rebuy SELL ERROR '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
										$logText = $logText.' - Sell [1] order ERROR: '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
						$logText = $logText.'*11*';
									}else{
										$logText = $logText.' - Sell [1] order SUCCESS';
								
										$tradeResultFills = $tradeResult['fills'];
										$tradeResultFills = $tradeResultFills[0];
										$soldPrice = $tradeResultFills['price'];

										$logText = $logText.' - Sale: origQty:'.$tradeResult['origQty'].', executedQty:'.$tradeResult['executedQty'].', status:'.$tradeResult['status'].', price:'.$soldPrice;
										$isMainEvent = true;
										$isNotifyEvent = true;
										$thisPriceIncreaseFormat = number_format(round($thisPriceIncrease,2),2).'%';
										$notificationSubject = 'Sold '.$symbol.' for profit: '.$changePctFormat; 
										$notifHtml = $notifHtml.'<p>Sell for profit!<br />High price reached:'.$high_price.'<br />retraced since high: '.$hardPctRetracement.' (Gave up '.$pctOfProfitGivenBackFormat.'% of the profit from high)</p>';
										$logText = $logText.'*12*';

										echo '<br />TEST 4a •••<br />';
										print_r($coinJsonFileContentArray);
										echo '<br />TEST 4b •••<br />';
								
										$coinJsonFileContentArray['this_sold_price'] = $soldPrice;
										$coinJsonFileContentArray['status'] = 'watched';
										$coinJsonFileContentArray['is_armed'] = 0;
									
										$logText = $logText.'*13*';
																		
										$tradesArray =  $coinJsonFileContentArray['trades'];
										$tradeArrayLength = count( $tradesArray );
										$lastTradeRec = end($tradesArray);
										$lastTradeRec_key = key($tradesArray);
								
										## Get last trade from trades array
										$lastTradeRec['bot_sell'] = 1;
										$lastTradeRec['sell_type'] = 'gain';
										$lastTradeRec['sell_time'] = date("Y/m/d h-i-s",time());
										$lastTradeRec['sell_trade'] = $tradeResult;
										## Add updated last trade back to trades array
										$tradesArray[$lastTradeRec_key] = $lastTradeRec;
										## Add updated trades array to coin record
										$coinJsonFileContentArray['trades'] = $tradesArray;

										## Low Watched Price must be updated to the new sell price.
										$newWatchedLow = $currentBidPrice * (1 + ($rebuyStoplossPct / 100));
										$coinJsonFileContentArray['low_watched_price'] = $newWatchedLow;
										$logText = $logText.'*14*';

										$thisActionNotes = '';
										$thisAction = 'sell for profit';
										$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);

										//$coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
								  

										$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
										   $jsonData = json_encode($coinJsonFileContentArray);
										   $coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);

																		}
								
								}elseif ($currentBidPrice < $this_buy_price){
									echo '|opt-oa - Price lower... - Bid:'.$currentBidPrice.' Hi:'.$high_price;
									$logText = $logText.'Price lower - Bid:'.$currentBidPrice; 
									echo '<br />TEST 5 •••';
						$logText = $logText.'*15*';
								}else{
									echo '|opt-oa - Price not high - Bid:'.$currentBidPrice.' Hi:'.$high_price;
									$logText = $logText.'Price higher - Bid:'.$currentBidPrice.' Hi:'.$high_price;
									echo '<br />TEST 6 •••';
						$logText = $logText.'*16*';
															
								}
							}
					
					
						}else{ // not armed yet...
							echo '|chg:'.$changePctFormat;
							if ($isRebuy){
								$ArmPct_actual = $ArmPct * $rebuyShortLeashRatio;
							}else{
								$ArmPct_actual = $ArmPct;
							}


							if ($changePct > $ArmPct_actual){
								$logText = $logText.'*17*';
								echo '|opt-Arming coin now';
								$coinJsonFileContentArray['is_armed'] = 1;
								$thisAction = 'arming';
								$thisActionNotes = '';
								$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);


							//	$coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
							  $sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
							   $jsonData = json_encode($coinJsonFileContentArray);
							  $coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
						
								$logText = $logText.'Arming coin now - Bid:'.$currentBidPrice.' Hi:'.$high_price;
							
								$isMainEvent = true;
								$isNotifyEvent = true;
								$notificationSubject = 'Arming '.$symbol.' at: '.$changePctFormat;
								$notifHtml = $notifHtml.'<p>Arming coin now<br />High price reached:'.$high_price;
							}elseif ($isRebuy == 0 && $changePct < $stoplossPct){
								$logText = $logText.'*18*';
								echo '|opt-!o2';
								//SELL NOW!!
								$logText = $logText.'SELLING AT STOPLOSS - Bid:'.$currentBidPrice.' Stoploss:'.$stoplossPct;
							
								##### EXECUTE TRADE - SELL
								### STOPLOSS
								$tradeResult = dumpCoin($symbol,$sellCoinSymbol,$api,$account,$tradeQuantity);
								##### EXECUTE TRADE

								$isTradeError = array_key_exists('code',$tradeResult);
								if ($isTradeError){
									$tradeErrorCode = $tradeResult['code'];
									$tradeErrorMsg = $tradeResult['msg'];
									$notificationSubject = 'Sell for profit ERROR FOR '.$symbol;
									$notifHtml = $notifHtml.'<p>SELLING AT STOPLOSS ERROR '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
									$logText = $logText.' - Sell [2] order ERROR: '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
									$logText = $logText.'*19*';
								}else{
									$logText = $logText.'*20*';
									$logText = $logText.' - Sell [2] order SUCCESS';
							
									$tradeResultFills = $tradeResult['fills'];
									$tradeResultFills = $tradeResultFills[0];
									$soldPrice = $tradeResultFills['price'];

									$coinJsonFileContentArray['this_sold_price'] = $soldPrice;
									$thisAction = 'Stoploss sell';

									$thisActionNotes = '';
									$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);
						
									$tradeArrayLength = count( $tradesArray );
									$lastTradeRec = end($tradesArray);
									$lastTradeRec_key = key($tradesArray);
								
									## Get last trade from trades array
									$lastTradeRec['bot_sell'] = 1;
									$lastTradeRec['sell_type'] = 'stoploss';
									$lastTradeRec['sell_time'] = date("Y/m/d h-i-s",time());
									$lastTradeRec['sell_trade'] = $tradeResult;
								
								
									## Add updated last trade back to trades array
									$tradesArray[$lastTradeRec_key] = $lastTradeRec;
							
									## Add updated trades array to coin record
									$coinJsonFileContentArray['trades'] = $tradesArray;

									## Update trades record arrray

									$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
									$jsonData = json_encode($coinJsonFileContentArray);
									$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
								
									## FINAL TRADE DATA ADDED TO TRADE FILE

									createFinalTradeJsonFile($account,$symbol,$coinJsonFileContentArray);
								

									## LIVE TRADE FILE HAS TO BE DELETED:
								
									## REMOVE, DELETE FILE INSTEAD v v v

									//$coinInfoArray = Array('id'=>uniqid(),'account'=>$account,'symbol'=>$symbol,'status'=>'inactive','is_rebuy'=>0,'is_armed'=>0);
									$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
									//$jsonData = json_encode($coinJsonFileContentArray);
									//$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);

									$this->s3->del($sellBotCoinFile);

									## REMOVE, DELETE FILE INSTEAD ^ ^ ^


									$logText = $logText.'Sale: origQty:'.$tradeResult['origQty'].', executedQty:'.$tradeResult['executedQty'].', status:'.$tradeResult['status'].', price:'.$soldPrice;

									$isMainEvent = true;
									$isNotifyEvent = true;
									$thisPriceIncreaseFormat = number_format(round($thisPriceIncrease,2),2).'%';
									$notificationSubject = 'Stop loss '.$symbol.' at: '.$thisPriceIncreaseFormat;
									$notifHtml = $notifHtml.'<p>SELLING AT STOPLOSS SUCCESS (set to: '.$stoplossPct.')</p>';
									$notifHtml = $notifHtml.'<p>Sale details:<br />original Qty:'.$tradeResult['origQty'].'<br />executed Qty:'.$tradeResult['executedQty'].'<br />Trade status:'.$tradeResult['status'].'<br />price:'.$soldPrice;
								}
							}elseif ($isRebuy == 1){// && $currentBidPrice < $this_buy_price){
								$low_watched_price = $coinJsonFileContentArray['low_watched_price'];
								
								
								echo '<br />low_watched_price: '.$low_watched_price;
								echo '<br />currentBidPrice: '.$currentBidPrice;
								
								if ($currentBidPrice < $low_watched_price){
									echo '<br />($currentBidPrice < $low_watched_price)';
								}else{
									echo '<br />$currentBidPrice > $low_watched_price)';
								
								}
							
								$logText = $logText.'*2401*';
								if ($currentBidPrice < $low_watched_price){
									$logText = $logText.'*2402*';
									echo '|opt-!o3';
									//SELL NOW!!
									$logText = $logText.'SELLING REBUY AT DROP - Bid:'.$currentBidPrice.' Bought at:'.$this_buy_price;
									$isMainEvent = true;
									$isNotifyEvent = true;
								

									$tradeResult = dumpCoin($symbol,$sellCoinSymbol,$api,$account,$tradeQuantity);
							
									##### EXECUTE TRADE
								
									$isTradeError = array_key_exists('code',$tradeResult);
								
									if ($isTradeError){
										$logText = $logText.'*25*';
										$tradeErrorCode = $tradeResult['code'];
										$tradeErrorMsg = $tradeResult['msg'];
										$notificationSubject = 'Dump rebuy ERROR FOR '.$symbol;
										$notifHtml = $notifHtml.'<p>Rebuy SELL ERROR '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
										$logText = $logText.' - Sell [3] order ERROR: '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
									}else{
										$logText = $logText.'*26*';
										$logText = $logText.' - Sell [3] order SUCCESS - ';
			
						
										$tradeResultFills = $tradeResult['fills'];
										$tradeResultFills = $tradeResultFills[0];
										$soldPrice = $tradeResultFills['price'];
							
										$coinJsonFileContentArray['this_sold_price'] = $soldPrice;
										$coinJsonFileContentArray['low_watched_price'] = $soldPrice;							
										$coinJsonFileContentArray['status'] = 'watched';							
										$thisAction = 'dump rebuy at loss';
									
										$thisActionNotes = '';
										$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);

										## Update trades record arrray
										$tradesArray =  $coinJsonFileContentArray['trades'];
								
								
										$tradeArrayLength = count( $tradesArray );
										$lastTradeRec = end($tradesArray);
										$lastTradeRec_key = key($tradesArray);
									
										## Get last trade from trades array
										$lastTradeRec['bot_sell'] = 1;
										$lastTradeRec['sell_type'] = 'dump-rebuy';
										$lastTradeRec['sell_time'] = date("Y/m/d h-i-s",time());
										$lastTradeRec['sell_trade'] = $tradeResult;
										## Add updated last trade back to trades array
										$tradesArray[$lastTradeRec_key] = $lastTradeRec;
										## Add updated trades array to coin record
										$coinJsonFileContentArray['trades'] = $tradesArray;

										$logText = $logText.'*27*';

								   
										$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
										$jsonData = json_encode($coinJsonFileContentArray);
										$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
									
									
										## FINAL TRADE DATA ADDED TO TRADE FILE

										createFinalTradeJsonFile($account,$symbol,$coinJsonFileContentArray);
								

										## LIVE TRADE FILE HAS TO BE DELETED:
								
										## REMOVE, DELETE FILE INSTEAD v v v

	// 									$coinInfoArray = Array('id'=>uniqid(),'account'=>$account,'symbol'=>$symbol,'status'=>'inactive','is_rebuy'=>0,'is_armed'=>0);
	// 									$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
	// 									$jsonData = json_encode($coinJsonFileContentArray);
	// 									$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);

										$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
										$this->s3->del($sellBotCoinFile);
										## REMOVE, DELETE FILE INSTEAD ^ ^ ^
									
								   
							
										$logText = $logText.'Sale: origQty:'.$tradeResult['origQty'].', executedQty:'.$tradeResult['executedQty'].', status:'.$tradeResult['status'].', price:'.$soldPrice.' - ';
									
										$thisPriceIncreaseFormat = number_format(round($thisPriceIncrease,2),2).'%';
										$notificationSubject = 'Dump rebuy '.$symbol.' at: '.$thisPriceIncreaseFormat.'%';
										$notifHtml = $notifHtml.'<p>Dumping rebuy. $this_buy_price: '.$this_buy_price.'</p>';
										$notifHtml = $notifHtml.'<p>Sale details:<br />original Qty:'.$tradeResult['origQty'].'<br />executed Qty:'.$tradeResult['executedQty'].'<br />Trade status:'.$tradeResult['status'].'<br />price:'.$tradeResultFills['price'];
										$logText = $logText.'*28*';
									}
									$logText = $logText.'*29*';
								}
						
							}elseif ($isRebuy == 1 && $currentBidPrice > $high_price){
								$logText = $logText.'*30*';
								echo '|opt-!o4';
						
								$coinJsonFileContentArray['high_price'] = $currentBidPrice;
								$thisAction = 'Record new high price rebuy';
								$thisActionNotes = '';
								$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);


					
								//$coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
									 $sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
										 $jsonData = json_encode($coinJsonFileContentArray);
										$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
								$logText = $logText.'Record new high - Bid:'.$currentBidPrice;
							
								$isMainEvent = true;
	
							}
						} 
				
					}elseif ($status == 'watched'){
						echo ' | opt-watched'.' - Chg:'.$changePctFormatBid.' - Hi:'.$high_price;
						$logText = $logText.'*31*';
					
						$soldPrice = $coinJsonFileContentArray['this_sold_price'];
					
					
						$hasLowWatchedPrice = array_key_exists('low_watched_price',$coinJsonFileContentArray);					
					
						if ($hasLowWatchedPrice){
							$lowWatchedPrice = $coinJsonFileContentArray['low_watched_price'];// - used to arm a rebuy
						}	
						
						
						if (!$hasLowWatchedPrice || $lowWatchedPrice == null || $lowWatchedPrice == '' || $lowWatchedPrice == 0){
							$lowWatchedPrice = number_format(round($currentBidPrice,8),8);						
							$coinJsonFileContentArray['low_watched_price'] = $lowWatchedPrice;
						
							$thisAction = 'Record first low watched price';
							$thisActionNotes = 'New low watched: '.$lowWatchedPrice;
							$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);

							$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
							$jsonData = json_encode($coinJsonFileContentArray);
							$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);

							$logText = $logText.'*32*';
						}
					
						//$changePct = pct_Chg_Log($soldPrice,$currentBidPrice,15);
					
						//$changePctFormat = number_format(round($changePct,2),2).'%';

						$logText = $logText.'WATCHED - Bid:'.$currentBidPrice.' - Sold at:'.$soldPrice.' - Hi:'.$high_price;
						$notifHtml = $notifHtml.'<p>Watching coin:<br />'.'Bid:'.$currentBidPrice.'<br />Sold at:'.$soldPrice.'<br />High:'.$high_price;
					

						echo '**1**';
						$changePctSincePreviousBuy = pct_Chg_Log($this_buy_price,$currentBidPrice,16);

						$changePctFromWatchedLow = pct_Chg_Log($lowWatchedPrice,$currentBidPrice,17);
						echo '<p> Watched low: '.$lowWatchedPrice.' - Current Bid Price: '.$currentBidPrice;
						echo '</p>';
						echo '<p> Change from prev watched low: '.$changePctFromWatchedLow;
						echo '</p>';

						$ArmPct_actual = $ArmPct * $rebuyShortLeashRatio;
					
						if ($changePctSincePreviousBuy < $abendonDropBelowPreviousBuyPct){
							echo '**2**';
							$logText = $logText.'*33*';
							// Abendon
						
							$changePctFormat2 = number_format(round($changePctSincePreviousBuy,2),2).'%';
							$thisActionNotes = 'Buy: '.$this_buy_price.' - Bid: '.$currentBidPrice.' Chg: '.$changePctFormat2;
							$thisAction  = 'abendon';
							$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);
							createFinalTradeJsonFile($account,$symbol,$coinJsonFileContentArray);
						
							$coinInfoArray = 
							Array('id'=>uniqid(),'account'=>$account,'symbol'=>$symbol,'status'=>'inactive','is_rebuy'=>0,'is_armed'=>0,'action'=>'Abendon','actions'=>Array());
							//$coinFileJson = createCoinJsonFile($account,$symbol,$coinInfoArray);
							$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';

							$this->s3->del($sellBotCoinFile);

						
							## HANAAN DEBUG 2019-01-17
							## INCORRECT DATA ADDED TO FIJSON SO TRADE FILE NEVER endswitch
							$jsonData = json_encode($coinInfoArray);
							//$jsonData = json_encode($coinJsonFileContentArray);
							## HANAAN DEBUG 2019-01-17
							//$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
						
							$logText = $logText.' - Dropped below previous buy price: '.$changePctSincePreviousBuy.' - ABENDON';
							$notifHtml = $notifHtml.'<p>Dropped below previous buy price: '.$changePctSincePreviousBuy.' - ABENDON</p>';
							$isMainEvent = true;
							$isNotifyEvent = true;
							$notificationSubject = 'Abendon '.$symbol.' Since sale: '.$changePctFormat;
						
						}else{
	echo '**3**';
					
							if ($currentBidPrice < $lowWatchedPrice){
	echo '**4**';
								$thisActionNotes = 'Low watched: '.$lowWatchedPrice;
								$logText = $logText.'*34*';
							
								$coinJsonFileContentArray['low_watched_price'] = $currentBidPrice;
								$lowWatchedPrice = $currentBidPrice;
								$thisAction = 'Record new low watched price';
							
								$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);
							
								$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
								$jsonData = json_encode($coinJsonFileContentArray);
								$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
								$logText = $logText.' - (JSON START)'.$coinFileJson.'(JSON END)';
							
					
							}elseif($changePctFromWatchedLow > $rebuyRisePct){
								$logText = $logText.'*35*';
								echo '**5**'; 
								// Rebuy!
								echo 'REBUY!!: '.$symbol .$sellCoinSymbol.' - changePctFromWatchedLow: '.$changePctFromWatchedLow.' - $tradeQuantity: '.$tradeQuantity.'<br />'; 

								$thisPriceIncreaseFormat = number_format(round($thisPriceIncrease,2),2).'%';
							
								// EXECUTE TRADE - BUY
								$tradeResult = buyCoin($symbol,$sellCoinSymbol,$tradeQuantity,$api,$account);
							
								// EXECUTE TRADE
							
								$isTradeError = array_key_exists('code',$tradeResult);
								if ($isTradeError){
									$tradeErrorCode = $tradeResult['code'];
									$tradeErrorMsg = $tradeResult['msg'];
									$notificationSubject = 'Rebuy ERROR FOR '.$symbol;
									$notifHtml = $notifHtml.'<p>Rebuy BUY ERROR '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
									$logText = $logText.' - Buy order ERROR: '.$tradeErrorMsg.' (CODE: '.$tradeErrorCode.')';
									$logText = $logText.'*36*';
								}else{
									$logText = $logText.'*37*';
									$notificationSubject = 'Rebuy watched '.$symbol.' at: '.$thisPriceIncreaseFormat;

									$tradeResultFills = $tradeResult['fills'];
									$tradeResultFills = $tradeResultFills[0];
									$rebuyPrice = $tradeResultFills['price'];
							
									echo 'REBUY PROICE ##: '.$rebuyPrice;
							
							
									$logText = $logText.'*38*';
							
									//ADD TRADE TO JSON
							
									$tradesArray =  $coinJsonFileContentArray['trades'];
									$tradeArrayLength = count( $tradesArray );
									$nextTradeKeyNumber = $tradeArrayLength + 1;

									$newTradeKey = 'TRADE-'.$nextTradeKeyNumber;
								
									$buyTime = date("Y/m/d h-i-s",time());
									$newTradeArray = Array('bot_buy'=>1,'bot_sell'=>null,'sell_type'=>null,'buy_time'=>$buyTime ,'buy_trade'=>$tradeResult,'sell_trade'=>null);
									$tradesArray[$newTradeKey] = $newTradeArray;
								
									$coinJsonFileContentArray['trades'] = $tradesArray;
							
									// ADD TRADE TO JSON
								
									$logText = $logText.'*39*';
									$coinJsonFileContentArray['status'] = 'rebuy';
									$coinJsonFileContentArray['this_buy_price'] = $rebuyPrice;
									$thisAction = 'Mark for rebuy';
								
									$thisActionNotes = '';
									$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);
							
									// $coinFileJson = createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
							
								  	$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json';
									$jsonData = json_encode($coinJsonFileContentArray);
									$coinFileJson = $this->s3->write($sellBotCoinFile,$jsonData);
								
									$logText = $logText.'*40*';								
							
									$logText = $logText.' - Buy order status: '.$tradeResult['status'].' - Buy orderId: '.$tradeResult['orderId'].' - Buy qty: '.$tradeResult['executedQty'].' - Buy price: '.$rebuyPrice;
									$notifHtml = $notifHtml.'<p>Rebuy now! QTY: '.$tradeQuantity.'<br />Trade results:</p>';
									$notifHtml = $notifHtml.'<p>Chg from watched low:'.$changePctFromWatchedLow.'</p>';
									$notifHtml = $notifHtml.'<p>Buy trade order:<br />Status: '.$tradeResult['status'].'<br />Buy orderId: '.$tradeResult['orderId'].'<br />Buy qty: '.$tradeResult['executedQty'].'<br />Buy price: '.$rebuyPrice;
								}
								$isMainEvent = true;
								$isNotifyEvent = true;
								$logText = $logText.'*41*';
							}
						}				
					}
					echo '</p>';
					echo '<p>(LOG:'.$logText.')</p>';
					if ($isMainEvent){
						addToLog($account,$symbol,$logText);				
					}
					if ($isNotifyEvent){
						$notifHtml = '<html>
						<head>
						<title>'.$notificationSubject.'</title>
						</head>
						<body>
						'.$notifHtml.'
						</table>
						</body>
						</html>';
						$headers = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= "From: bot_notifs@profitsitter.com'.'\r\n";
						//x$headers .= "CC: tawinden@gmail.com'.'\r\n";
						mail('hanaan@me.com','SelBot: '.$account.'|'.$notificationSubject,$notifHtml,$headers);
					}
					}
				} // NOT STANDBY
			}			
		}
	}
  
  }	

}

?>
