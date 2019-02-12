<?php

echo "Account is ".$account."<br/>";
echo "trade_coin_symbol is ".$trade_coin_symbol."<br/>";
echo "Main Action is ". $main_action."<br/>";
echo "btc_trade_ubc is ".$btc_trade_ubc."<br/>";
echo "coin_trade_ubc is ".$coin_trade_ubc."<br/>";

echo "btc_trade_ubc2 is ".$btc_trade_ubc2."<br/>";
echo "coin_trade_ubc2 is ".$coin_trade_ubc2."<br/>";
//echo "btc_trade_hanaan is ".$btc_trade_hanaan."<br/>";
//echo "coin_trade_hanaan is ".$coin_trade_hanaan."<br/>";

if($main_action == 'Execute Buy Tradeeee')
{
		echo '<br/><br/>$accountCoinTradeAmount: '.$coin_trade_ubc.' of '.$trade_coin_symbol.$sellCoinSymbol.'<br />';
		
		if($trade_result_msg){ echo $trade_result_msg; }
		
		// Coin File Name
	
		if($getFile){ echo $getFile['ObjectURL'].'<br/>';}
			
	   //  Coin File Log
	
	    if($getFileLog){ echo $getFileLog['ObjectURL']; }	
		
		
	}elseif($main_action == 'terminate_trade'){
		    
		     echo '<h3>TERMINATE TRADE!</h3>'; 
		     
		     //if($trade_result_msg){ echo $trade_result_msg; }
		     
		     //if($getSellFile){ echo $getSellFile; }
	}else{
		    
		     echo '<h3>EXECUTE SELL TRADE!</h3>'; 
		     
		     if($trade_result_msg){ echo $trade_result_msg; }
		     
		     if($getSellFile){ echo $getSellFile; }
		     
		}
			
	echo "<span style='font-size:20px;float:left;width:100%;margin-top:20px;margin-left: 18px;'><a style='color:black' href='".base_url()."dashboard'>Back</a></span>"	;		
	
//$accountFromForm=

?>
