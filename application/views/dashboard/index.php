<div class="bgndcolor">
	<div class="wrapperFrame">
	
	
	
	<!--
		<div class="scrolling-wrapper-flexbox">
	<?php if(!empty($responseData)) { foreach ($responseData as $coinData) { ?>
			<div class="signal">				
				<div class="<?php echo $coinData['signalDivClass']; ?>">
					<h3><a href="http://tradingview.com/chart?symbol=BINANCE:<?php echo $coinData['symbol'] ?>BTC" target="_blank"><?php echo $coinData['symbol'].'</a>'.$coinData['thisCoinMktCapPlace_format']; ?></h3>
					<p><?php echo  $coinData['jsonString']; ?></p>
					<p><strong>Signal: <?php echo  $coinData['sort_value']; ?></strong></p>
					<p><strong><?php echo  $coinData['subhead']; ?></strong></p>
					<p>
					<form method="POST" action="<?php echo base_url() ?>dashboard/selectCoin">
						<input type="hidden" name="user" value="admin">
						<input type="hidden" name="pass" value="beachball">
						<input type="hidden" name="trade_coin_symbol" value="<?php echo $coinData['symbol']; ?>">
						<input type="hidden" name="main_action" value="prepare_trade">
						<p><button type="submit" width="500" class="execute">Select</button></p>
					</form>
					</p>
				</div>
			</div>
	<?php } } ?>
		</div>
-->

	<div class="scrolling-wrapper-flexbox">
	<?php if(!empty($responseData)) { foreach ($responseData as $coinData) { 
	## CHECK IS NOT ALREADY TRADED
	$signalSymbol = $coinData['symbol'];

	foreach ($activeTradesArray as $tradeRec) {
		$thisActiveTradeRecord = $tradeRec['thisActiveTradeRecord'];
		$tradedSymbol = $tradeRec['symbol'];
		if ($signalSymbol == $tradedSymbol){
			$isTraded = 1;
			break; 
		}else{
			$isTraded = 0;
		}
	}	

	if ($isTraded == 0){
	?>
			<div class="signal">	
						
				<div class="<?php echo $coinData['signalDivClass']; ?>_SMALL">
					<h3><a href="http://tradingview.com/chart?symbol=BINANCE:<?php echo $signalSymbol ?>BTC" target="_blank"><?php echo $signalSymbol; ?></a></h3>
					<p>
					<form method="POST" action="<?php echo base_url() ?>dashboard/selectCoin/<?php echo $signalSymbol; ?>">
						<input type="hidden" name="user" value="admin">
						<input type="hidden" name="pass" value="beachball">
						<input type="hidden" name="trade_coin_symbol" value="<?php echo $signalSymbol; ?>">
						<input type="hidden" name="main_action" value="prepare_trade">
						<p><button type="submit" width="500" class="execute">TRADE</button></p>
					</form>
					</p>
				</div>
			</div>
	<?php } } } ?>
		</div>


		<div class="rounded_frame_full">
			<!-- <h3>Account: <?php echo $account; ?></h3> -->
			<p>Balance: <strong><?php echo $balanceTotal; ?></strong> BTC | Bitcoin: <strong><?php echo $balanceBitcoinTotal; ?></strong> BTC | Altcoin: <strong><?php echo $balanceAltcoinTotal; ?></strong> BTC | Cash:    <strong><?php echo $balanceCashTotal; ?></strong> BTC</p>
		</div>
	
	
<?php 
		$selectedCoinTradeStatusResult = getCoinOwnedTradedStatus($account,$trade_coin_symbol);
		$stablecoinPricesFullArray = aggregateStablecoinData($account);
		$coinTraded = $selectedCoinTradeStatusResult['isTraded'];
		$isOwned = $selectedCoinTradeStatusResult['isOwned'];
		$tradeStatus = $selectedCoinTradeStatusResult['tradeStatus'];
		
//		print_r($selectedCoinTradeStatusResult['test']);
?>
	</div>
		<div class="rounded_frame_full">
		<h3>Stablecoins</h3>
<?php 
	foreach ($stablecoinPricesFullArray as $stablecoinRec) {

// 			echo '<hr />';
// 	print_r($stablecoinRec);
// 		echo '<br />';
// 
		$stablecoinSymbol = $stablecoinRec['symbol'];
		$stablecoinName = $stablecoinRec['name'];
		$stablecoinBalance = $stablecoinRec['balance'];
		$stablecoinPriceArray = $stablecoinRec['price_list'];
		$stablecoinLogoArray = $stablecoinRec['icon_list'];
		$stablecoinBalanceFormat = number_format(round($stablecoinBalance,2),2);		
		$stablecoinHeld = $stablecoinBalance > 10;

?>
	<div style="width:195px; float:left; clear:none;" class="rounded_frame_col2">
	<table width="100%">

	<tr><td width="50%"><strong><?php echo $stablecoinSymbol; ?></strong></td><td align="right" width="50%"><?php echo $stablecoinBalanceFormat; ?></td>
	</tr>
<!--
	<tr><td width="50%"><strong><?php echo $stablecoinSymbol; ?></strong></td><td align="right" width="50%"><?php echo $stablecoinName; ?></td>
	</tr><tr>
	<td width="50%">Balance:</td><td align="right" width="50%"><?php echo $stablecoinBalanceFormat; ?></td>
-->
	</tr></table>
<?php 
	
	
		foreach ($stablecoinPriceArray as $stablecoinPriceRec) {
			$stablecoinPair = $stablecoinPriceRec['pair'];
			$stablecoinPrice = $stablecoinPriceRec['price'];
			$stablecoinSignal = $stablecoinPriceRec['signal'];
			$stablecoinPriceFormat = number_format(round($stablecoinPrice,4),4);		
						if ($stablecoinSignal == -1){
							$bgndcolor = 'red';
						}elseif ($stablecoinSignal == 1){
							$bgndcolor = 'green';
						}else{
							$bgndcolor = '#444444';
						}					
			?>
				<table width="100%"><tr>
				<td width="10px" style="background-color: <?php echo $bgndcolor; ?>;">&nbsp;</td>
				<td width="50%">
				<strong><a href="http://tradingview.com/chart?symbol=BINANCE:<?php echo $stablecoinPair ?>" target="_blank"><?php echo $stablecoinPair; ?></a></strong></td><td align="right"><?php echo $stablecoinPriceFormat; ?></td></tr></table>
				</td></tr></table></p>
			<?php 


		}
	echo '</div>';

	}
?>
</div>
<!--
<?php  if($selected_coin){?>

	<div class="rounded_frame_col2">
	<h3>Trading: <?php echo $selected_coin; ?></h3><p>Price:<?php echo $pairPrice; ?></p>
	<form action="<?= base_url();?>dashboard/binance_execute_trade" method="post" name="main_trade_<?php echo $account;?>" id="main_trade_<?php echo $account;?>">	
		<input type="hidden" placeholder="" id="loginInput" name="user" value="admin">
		<input type="hidden" placeholder="" id="pwInput" name="pass" value="beachball">

		<input type="hidden" id="account" name="account" value="<?php echo $account; ?>">
		<input type="hidden" id="trade_coin_symbol" name="trade_coin_symbol" value="<?php echo $selected_coin; ?>">
		<input type="hidden" id="main_action" name="main_action" value="<?= $formButtonText;?>">
		<div align="center">
			<button type="submit" width="500" class="execute"><?= $formButtonText;?></button>
		</div>
	 </form>
	</div>
<?php }?>
-->

<?php  if($trade_coin_symbol && $pairPrice) {
	
	//if(!$selected_coin){
	 ?>

	<div class="rounded_frame_col2">
		<h3>Trading: <?php echo $trade_coin_symbol; ?></h3><p>Price:<?php echo $pairPrice; ?></p>
		<form action="<?= base_url();?>dashboard/binance_execute_trade" method="post" name="main_trade_<?php echo $account;?>" id="main_trade_<?php echo $account;?>">	
			<input type="hidden" placeholder="" id="loginInput" name="user" value="admin">
			<input type="hidden" placeholder="" id="pwInput" name="pass" value="beachball">

			<input type="hidden" id="account" name="account" value="<?php echo $account; ?>">
			<input type="hidden" id="trade_coin_symbol" name="trade_coin_symbol" value="<?php echo $trade_coin_symbol; ?>">
			<input type="hidden" id="main_action" name="main_action" value="<?= $formButtonText;?>">
			<!-- 
			$jsParam is the line of links that enterv the trade amount
			LIKE THIS:
			0.25% | 1% 1.5% 2% 2.5% 3% 4% 5% 7.5% 10% 12% 
			-->
			<p><?php echo $jsParam; ?></p>
			<p>Trade amount: <input type="text" id="<?php echo $btcAmountInputId; ?>" size="12" name="<?php echo($btcAmountInputId);?>">BTC or <input type="text" id="<?php echo $coinAmountInputId; ?>" size="12" name="<?php echo($coinAmountInputId);?>"> (<span id="<?php echo($coinAmountDivId);?>">...</span>) <?php echo $trade_coin_symbol ?> <a href="javascript:clearTradeAmount('main_trade_<?=$account;?>'</a>,'btc_trade_<?= $account;?>','0.56964399','coindiv_<?= $account;?>','351','coin_trade_<?= $account;?>')">Clear Trade</a></p>
			<div align="center">
				<button type="submit" width="500" class="execute"><?= $formButtonText;?></button>
			</div>
		</form>
	</div>
  <?php// }?>
  
  <!--
  
	<div class="rounded_frame_col2">
		<h3>Signals for: <?php echo $trade_coin_symbol; ?></h3>
		<form method="POST" action="<?php echo base_url() ?>dashboard/updateSignal">
			<p>Notes: <input class="u-full-width" type="text" placeholder="" id="loginInput" name="signal_notes"></p>
			<p>Target: <input class="u-full-width" type="text" placeholder="" id="loginInput" name="signal_Target"></p>
			<p>Signal: <input type="radio" name="signal_int" value="1"> BUY | <input type="radio" name="signal_int" value="0"> HODL | <input type="radio" name="signal_int" value="-1"> SELL</p>
			<input type="hidden" name="user" value="">
			<input type="hidden" name="pass" value="">
			<input type="hidden" name="trade_coin_symbol" value="<?php echo $trade_coin_symbol; ?>">
			<input type="hidden" name="main_action" value="add_signal">
			<p>
				<button type="submit" width="500" class="execute">Update</button>
			</p>
		</form>
	</div>
	
	-->

<?php } ?>
<div class="bgndcolor">
	<div class="rounded_frame_full">


<!--

		<table width="100%">
			<tbody>
				<tr>
					<th>Symbol+</th>
					<th>Qty</th>
					<th>BTC</th>
					<th>Chg</th>
					<th>&nbsp;</th>
				</tr>
				<?php 
					$ignoreSymbolArray = $sellBotParams['ignoreSymbolArray'];
				//echo "<pre>"; print_r($balances);
					foreach ($balances as $symbol => $balanceTableRec) {
						
					 $availableBalance = $balanceTableRec['available'];
						
						$ignoreSymbol =  in_array($symbol, $ignoreSymbolArray);
						if ($availableBalance > 0 && !$ignoreSymbol){
						//	echo $availableBalance;
							
							$price = isset($prices[$symbol.$sellCoinSymbol]) ? $prices[$symbol.$sellCoinSymbol] : 0;
							// print_r($price);
							$btcValue = $availableBalance * $price;
						
							if ($btcValue > 0 && $btcValue > $dust){
								$coinFileName = $symbol.'.json';
								$result_ = getBotStatusForCoin($account,$coinFileName,$bookPriceArray,$sellCoinSymbol);
								 $botStatus = isset($result_[0]['changePct'])?$result_[0]['changePct']:'';
								echo '<tr><td>'.$symbol.'</td>';
								echo '<td>'.number_format(round($availableBalance,4),4).'</td>';
								echo '<td>'.number_format(round($btcValue,8),8).'</td>'; 
								echo '<td>'. $botStatus.'</td>'; 
								?>
								<td>
								<a href="<?= base_url()?>dashboard/selectCoin/<?=$symbol?>">Select</a>
								</td>
								
								<?php
								echo '</tr>'; 
							}				
						}
					}
				?>
			</tbody>
		</table>
		-->
				<?php
					
					
// Array ( [symbol] => ARK [totalCost] => 0.000270180937159 [totalReturn] => 3.97 [totalTrades] => 1 [totalReturn_losses] => 0 [totalReturn_gains] => 3.97 
//[countTrades_losses] => 0 [countTrades_gains] => 1 
//[tradesArray] => Array ( [0] => Array ( [sellType] => gain [tradeTime] => 72598 
//		[buyRec] => Array ( [price] => 0.0001113 [qty] => 61 [commission] => 5.211500283E-6 [cost] => 0.0067893 ) 
//		[sellRec] => Array ( [price] => 0.0001159 [qty] => 61 [commission] => 5.207562558E-6 [cost] => 0.0070699 )
//		[commission] => 1.0419062841E-5 [netCost] => 0.000270180937159 [netReturn] => 3.97 ) )
//[averageTradeReturn_gain] => 3.97 [averageTradeReturn_losses] => 0 
//[thisActiveTradeRecord] => Array ( [tradeTime] => 83798 [buyRec] => Array ( [price] => 0.00011581949180328 [qty] => 61 [commission] => 5.20864762E-6 [cost] => 0.007064989 ) ) )
				

				?>


		<table width="100%">
			<tbody>

				<?php
				
//print_r($selectedCoinTradeStatusResult);
// echo $isSelectedCoinOwned.'<br />';
// echo $selectedCoinTradeStatus.'<br />';
				
				//print_r($activeTradesArray);
				//echo('COIN TRADE: <br />');
				
				
				foreach ($activeTradesArray as $tradeRec) {
					$thisActiveTradeRecord = $tradeRec['thisActiveTradeRecord'];
					$symbol = $tradeRec['symbol'];
					$status = $tradeRec['status'];
					$isArmed = $tradeRec['isArmed'];
					$tradesCompleted = $tradeRec['totalTrades'];
					$totalReturn = $tradeRec['totalReturn'];
					$totalReturn_losses = $tradeRec['totalReturn_losses'];
					$totalReturn_gains = $tradeRec['totalReturn_gains'];
					$countTrades_losses = $tradeRec['countTrades_losses'];
					$countTrades_gains = $tradeRec['countTrades_gains'];
					$tradesArray = $tradeRec['tradesArray'];
					$averageTradeReturn_gain = $tradeRec['averageTradeReturn_gain'];
					$averageTradeReturn_losses = $tradeRec['averageTradeReturn_losses'];
					$activeTrade_tradeTime = $thisActiveTradeRecord['tradeTime'];
					$activeTrade_buyRec = $thisActiveTradeRecord['buyRec'];
					$activeTradeBuy_price = $activeTrade_buyRec['price'];
					$current_price = $tradeRec['price'];
					$qty = $tradeRec['qty'];
					$complete_time_in_seconds = $tradeRec['complete_time_in_seconds'];

					$sort_value = $tradeRec['sort_value'];
						
					$averageTradeReturn_gain_format = number_format(round($averageTradeReturn_gain,1),1).'%';	
					$averageTradeReturn_losses_format = number_format(round($averageTradeReturn_losses,1),1).'%';	

					if ($totalReturn < 0){
						$tdClassTotalRet = 'down';
						$chgTotalRetStr = number_format(round($totalReturn,2),2).'%';	
					}elseif ($totalReturn > 0){
						$tdClassTotalRet = 'up';
						$chgTotalRetStr = '+'.number_format(round($totalReturn,2),2).'%';	
					}else{
						$tdClassTotalRet = 'unchanged';
						$chgTotalRetStr = '';	
					}					
					
					if ($status == 'watched'){
						$chgStr = 'WATCH';	
						$tdClass = 'watch';
					}elseif ($status == 'standby'){
						$chgStr = 'STDBY';	
						$tdClass = 'standby'; 
						$standby_change = $tradeRec['standby_change'];
						if ($pctChg_thisTrade > 0){
							$chgStbyStr = '+'.number_format(round($standby_change,2),2).'%';	
						}else{
							$chgStbyStr = number_format(round($standby_change,2),2).'%';	
						}
					}else{
						if($activeTradeBuy_price){
						$pctChg_thisTrade = ((($current_price - $activeTradeBuy_price) / $activeTradeBuy_price) * 100); 
					   }
					   $pctChg_thisTrade= isset($pctChg_thisTrade)?$pctChg_thisTrade:'';
						if ($pctChg_thisTrade < 0){
							$tdClass = 'down';
							$chgStr = number_format(round($pctChg_thisTrade,2),2).'%';	
						}else{
							$tdClass = 'up';
							$chgStr = '+'.number_format(round($pctChg_thisTrade,2),2).'%';	
						}					
					
					} 
				?>

				<tr>
					<td width="80px">
						<div class="<?php echo $tdClass; ?>">	
							<p class="white"><span class="table_header_cell">					
							<a href="<?= base_url()?>dashboard/selectCoin/<?=$symbol?>">
							<?php echo $symbol; ?></a></p>
							<p class="white"><span class="table_header_cell"><?php echo $chgStr; ?> </span></p>
						</div>
					</td>
					<td width="80px">
						<div class="<?php echo $tdClassTotalRet; ?>">	
							<p class="white"><span class="table_header_cell"><?php echo $chgTotalRetStr; ?></span></p>
						</div>
					</td>
					<td>
						<!--  DATA IN THREE ROWZZZ  -->
						<?php
						if ($status == 'standby'){
							echo '<P>'.$current_price.' | qty: '.$qty.' | '.formatTradeTime($complete_time_in_seconds).'</P>';
							echo '<P>Chg from start: '.$chgStbyStr.'</P>';
						}else{
							$armStr = ($isArmed)?'A|':'';
							echo '<P>'.$armStr.$current_price.' | qty: '.$qty.' | buy: '.number_format(round($activeTradeBuy_price,8),8).' | '.formatTradeTime($activeTrade_tradeTime).'</P>';
						}
						if ($tradesCompleted > 0){
							echo '<P>Return: '.$totalReturn.'% | G/L: '.$countTrades_gains.'/'.$countTrades_losses;
							if ($countTrades_gains > 0){
								echo ' | Avg Gain: '.$averageTradeReturn_gain_format;
							}
							if ($countTrades_losses > 0){
								echo ' | Avg Loss: '.$averageTradeReturn_losses_format;
							}
							echo '</P>';
							echo '<P>';
					 		// usort($tradesArray, 'sortByTradeTime');
							foreach($tradesArray as $tradeRec){
								$sellTimeFormat = date("m/d h:i",$tradeRec['sellTime']);
								echo $tradeRec['netReturn'].' ('.$sellTimeFormat.') | ';
							}
							echo '</P>';
						}
						?>
					</td>
					<td>
						
	<form action="<?= base_url();?>dashboard/binance_execute_trade" method="post" name="main_trade_ubc" id="main_trade_ubc">	
		<input type="hidden" placeholder="" id="loginInput" name="user" value="admin">
		<input type="hidden" placeholder="" id="pwInput" name="pass" value="beachball">

		<input type="hidden" id="account" name="account" value="<?php echo $account; ?>">
		<input type="hidden" id="trade_coin_symbol" name="trade_coin_symbol" value="<?php echo $symbol; ?>">
		<input type="hidden" id="main_action" name="main_action" value="terminate_trade">
		<div align="center">
			<button type="submit" width="300" class="execute">Exit <?php echo $symbol; ?> trade</button>
		</div>
	 </form>
						
						
					</td>
					<td>
						<p><a href="http://tradingview.com/chart?symbol=BINANCE:<?php echo $symbol ?>BTC" target="_blank">CHART</a></p>
					</td>
				</tr>
				<?php if($selected_coin == $symbol){?>
				<tr>
					<td colspan="2">
					<?php
							foreach($tradesArray as $tradeRec){
							
							echo '<P>';
								print_r($tradeRec);
							echo '</P>';
							}
					 ?>
					</td>
				</tr>
				<?php } ?>

				<?php 
				}
				?>
			</tbody>
		</table>
		
		
		
			
		
	</div>
<!--
	<div class="chart_right">
		<?php
/*
		$chartwidth = '900';
		$chartheight = '680';

		// $trade_coin_symbol = '';
		if ($trade_coin_symbol == ''){
			$chartPair = 'COINBASE:BTCUSD';
		}else{
			$chartPair = 'BINANCE:'.$trade_coin_symbol.'BTC';
		}

		echo('<!-- TradingView Widget BEGIN -->');
		echo('<div class="tradingview-widget-container">');
		echo('  <div id="tradingview_1d_'.$chartPair.'"></div>');
		echo('  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>');
		echo('  <script type="text/javascript">');
		echo('  new TradingView.widget(');
		echo('  {');
		echo('  "autosize": false,');
		echo('  "width": '.$chartwidth.',');
		echo('  "height": '.$chartheight.',');
		echo('  "symbol": "'.$chartPair.'",');
		echo('  "interval": "30",');
		echo('  "timezone": "America/New_York",'); 
		echo('  "theme": "Dark",');
		echo('  "style": "1",');
		echo('  "locale": "en",');
		echo('  "toolbar_bg": "#031C02",'); 
		echo('  "enable_publishing": false,');
		echo('  "hide_top_toolbar": false,');
		echo('  "save_image": false,');
		echo('  "container_id": "tradingview_1d_'.$chartPair.'"');
		echo('}');
		echo('  );');
		echo('  </script>');
		echo('</div>');
		echo('<!-- TradingView Widget END -->');
		echo('</div>');
*/
		?>
	</div>
	--> 
</div>

<script type="text/javascript">
	function enterTradeAmount(formName,inputIdBtc,val,priceDivId,coinVal,inputIdCoin) {
		document.getElementById(formName).elements[inputIdBtc].value = val;
		document.getElementById(formName).elements[inputIdCoin].value = coinVal;
		document.getElementById(priceDivId).innerHTML = coinVal;
	}
	function clearTradeAmount(formName,inputIdBtc,val,priceDivId,coinVal,inputIdCoin) {
		document.getElementById(formName).elements[inputIdBtc].value = '';
		document.getElementById(formName).elements[inputIdCoin].value = '';
		document.getElementById(priceDivId).innerHTML = '...';
	} 
	function hide(balanceDivId,spanId) {
		var x = document.getElementById(balanceDivId);
		if (x.style.display === "none") {
			x.style.display = "block";
			document.getElementById(spanId).innerHTML = '(hide)';
		} else {
			x.style.display = "none";
			document.getElementById(spanId).innerHTML = '(show)';
		}
	}
</script>


