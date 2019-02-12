<div class="bgndcolor">
	<div class="wrapperFrame">
		<div class="scrolling-wrapper-flexbox">
	<?php if(!empty($responseData)) { foreach ($responseData as $coinData) { ?>
			<div class="signal">				
				<div class="<?php echo $coinData['signalDivClass']; ?>">
					<h3><?php echo $coinData['symbol'].$coinData['thisCoinMktCapPlace_format']; ?></h3>				
					<p><?php echo  $coinData['jsonString']; ?></p>
					<p><strong>Signal: <?php echo  $coinData['sort_value']; ?></strong></p>
					<p><strong><?php echo  $coinData['subhead']; ?></strong></p>
					<p></p>
					<form method="POST" action="<?php echo base_url() ?>dashboard/selectCoin">
						<input type="hidden" name="user" value="admin">
						<input type="hidden" name="pass" value="beachball">
						<input type="hidden" name="trade_coin_symbol" value="<?php echo $coinData['symbol']; ?>">
						<input type="hidden" name="main_action" value="prepare_trade">
						<p><button type="submit" width="500" class="execute">Select</button></p>
					</form>
					<p></p>
				</div>
			</div>
	<?php } } ?>
		</div>

		<div class="rounded_frame">
			<h3>Account: <?php echo $account; ?></h3>
			<p>Balance: <strong><?php echo $balanceTotal; ?></strong> BTC</p>
			<p>Bitcoin: <strong><?php echo $balanceBitcoinTotal; ?></strong> BTC</p>
			<p>Altcoin: <strong><?php echo $balanceAltcoinTotal; ?></strong> BTC</p>
			<p>Cash:    <strong><?php echo $balanceCashTotal; ?></strong> BTC</p>
		</div>
	</div>
<?php if($selected_coin){?>

	<div class="rounded_frame_col2">
	<h3>Trading: <?php echo $selected_coin; ?></h3><p>Price:<?php echo $pairPrice; ?></p>
	<form action="<?= base_url();?>dashboard/binance_execute_trade" method="post" name="main_trade_ubc" id="main_trade_ubc">	
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

<?php  if($trade_coin_symbol && $pairPrice) {
	
	if(!$selected_coin){
	 ?>

	<div class="rounded_frame_col2">
		<h3>Trading: <?php echo $trade_coin_symbol; ?></h3><p>Price:<?php echo $pairPrice; ?></p>
		<form action="<?= base_url();?>dashboard/binance_execute_trade" method="post" name="main_trade_ubc" id="main_trade_ubc">	
			<input type="hidden" placeholder="" id="loginInput" name="user" value="admin">
			<input type="hidden" placeholder="" id="pwInput" name="pass" value="beachball">

			<input type="hidden" id="account" name="account" value="<?php echo $account; ?>">
			<input type="hidden" id="trade_coin_symbol" name="trade_coin_symbol" value="<?php echo $trade_coin_symbol; ?>">
			<input type="hidden" id="main_action" name="main_action" value="<?= $formButtonText;?>">
			<p><?php echo $jsParam; ?></p>
			<p>Trade amount: <input type="text" id="<?php echo $btcAmountInputId; ?>" size="12" name="<?php echo($btcAmountInputId);?>">BTC or <input type="text" id="<?php echo $coinAmountInputId; ?>" size="12" name="<?php echo($coinAmountInputId);?>"> (<span id="<?php echo($coinAmountDivId);?>">...</span>) <?php echo $trade_coin_symbol ?> <a href="javascript:clearTradeAmount('main_trade_ubc','btc_trade_ubc','0.56964399','coindiv_ubc','351','coin_trade_ubc')">Clear Trade</a></p>
			<div align="center">
				<button type="submit" width="500" class="execute"><?= $formButtonText;?></button>
			</div>
		</form>
	</div>
  <?php }?>
  
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

					echo '<h3>Trades...!</h3>';
					
					
// Array ( [symbol] => ARK [totalCost] => 0.000270180937159 [totalReturn] => 3.97 [totalTrades] => 1 [totalReturn_losses] => 0 [totalReturn_gains] => 3.97 
//[countTrades_losses] => 0 [countTrades_gains] => 1 
//[tradesArray] => Array ( [0] => Array ( [sellType] => gain [tradeTime] => 72598 
//		[buyRec] => Array ( [price] => 0.0001113 [qty] => 61 [commission] => 5.211500283E-6 [cost] => 0.0067893 ) 
//		[sellRec] => Array ( [price] => 0.0001159 [qty] => 61 [commission] => 5.207562558E-6 [cost] => 0.0070699 )
//		[commission] => 1.0419062841E-5 [netCost] => 0.000270180937159 [netReturn] => 3.97 ) )
//[averageTradeReturn_gain] => 3.97 [averageTradeReturn_losses] => 0 
//[thisActiveTradeRecord] => Array ( [tradeTime] => 83798 [buyRec] => Array ( [price] => 0.00011581949180328 [qty] => 61 [commission] => 5.20864762E-6 [cost] => 0.007064989 ) ) )
					
				?>
	<div class="rounded_frame_full">
		<table width="100%">
			<tbody>

				<?php
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
					
					
					if ($status == 'watched'){
						$chgStr = 'WATCH';	
						$tdClass = 'watch';
					}else{
						$pctChg_thisTrade = round(((($current_price - $activeTradeBuy_price) / $activeTradeBuy_price) * 100) , 2); 
						$chgStr = $pctChg_thisTrade.'%';	
						if ($pctChg_thisTrade < 0){
							$tdClass = 'down';
						}else{
							$tdClass = 'up';
						}					
					
					}
				?>

				<tr>
					<td width="60px" class="<?php echo $tdClass; ?>">						
						<?php
						echo '<p><span class="table_header_cell">'.$symbol.'</p>';
						echo '<p><span class="table_header_cell">'.$chgStr.'</p>';
						?>
					</td>
					<td>
						<!--  DATA IN THREE ROWZZZ  -->
						<?php
						$armStr = ($isArmed)?'A|':'';
						echo '<P>'.$armStr.$current_price.' | qty: '.$qty.' | buy: '.number_format(round($activeTradeBuy_price,8),8).' | '.formatTradeTime($activeTrade_tradeTime).'</P>';
						if ($tradesCompleted > 0){
							echo '<P>Return: '.$totalReturn.' | G/L: '.$countTrades_gains.'/'.$countTrades_losses.'</P>';
							echo '<P>';
							foreach($tradesArray as $tradeRec){
								echo $tradeRec['netReturn'].' | ';
							}
							echo '</P>';
						}
						?>
					</td>
				</tr>

				<?php 
				}
				?>
			</tbody>
		</table>
		
		
		
			
		
	</div>
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








