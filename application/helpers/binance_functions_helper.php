<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

  date_default_timezone_set('America/New_York');


  /**
	 * getCoinTiersArray function.
	 * 
	 * @access helper function
	 * @return result array
	 */

  function getCoinTiersArray()
  {
    $tier_I_max = 5;
    $tier_II_max = 20;
    $tier_III_max = 50;

    $coins_array_raw_json = '{ "status": { "timestamp": "2018-10-24T00:57:54.036Z", "error_code": 0, "error_message": null, "elapsed": 13, "credit_count": 1 }, "data": [ { "id": 1, "name": "Bitcoin", "symbol": "BTC", "slug": "bitcoin", "circulating_supply": 17338537, "total_supply": 17338537, "max_supply": 21000000, "date_added": "2013-04-28T00:00:00.000Z", "num_market_pairs": 6400, "cmc_rank": 1, "last_updated": "2018-10-24T00:56:39.000Z", "quote": { "USD": { "price": 6487.09293488, "volume_24h": 3660934695.6844, "percent_change_1h": 0.220041, "percent_change_24h": 0.0325863, "percent_change_7d": -1.5087, "market_cap": 112476700873.85547, "last_updated": "2018-10-24T00:56:39.000Z" } } }, { "id": 1027, "name": "Ethereum", "symbol": "ETH", "slug": "ethereum", "circulating_supply": 102758617.0616, "total_supply": 102758617.0616, "max_supply": null, "date_added": "2015-08-07T00:00:00.000Z", "num_market_pairs": 4565, "cmc_rank": 2, "last_updated": "2018-10-24T00:56:26.000Z", "quote": { "USD": { "price": 204.354469847, "volume_24h": 1238287015.58527, "percent_change_1h": 0.0798939, "percent_change_24h": -0.028185, "percent_change_7d": -2.57998, "market_cap": 20999182711.834156, "last_updated": "2018-10-24T00:56:26.000Z" } } }, { "id": 52, "name": "XRP", "symbol": "XRP", "slug": "ripple", "circulating_supply": 39997634397, "total_supply": 99991817275, "max_supply": 100000000000, "date_added": "2013-08-04T00:00:00.000Z", "num_market_pairs": 251, "cmc_rank": 3, "last_updated": "2018-10-24T00:57:03.000Z", "quote": { "USD": { "price": 0.461879186484, "volume_24h": 453970380.865593, "percent_change_1h": 0.132646, "percent_change_24h": 1.67994, "percent_change_7d": -1.14651, "market_cap": 18474074836.570816, "last_updated": "2018-10-24T00:57:03.000Z" } } }, { "id": 1831, "name": "Bitcoin Cash", "symbol": "BCH", "slug": "bitcoin-cash", "circulating_supply": 17418800, "total_supply": 17418800, "max_supply": 21000000, "date_added": "2017-07-23T00:00:00.000Z", "num_market_pairs": 358, "cmc_rank": 4, "last_updated": "2018-10-24T00:56:25.000Z", "quote": { "USD": { "price": 442.222967091, "volume_24h": 264045752.774142, "percent_change_1h": 0.0388644, "percent_change_24h": -1.32969, "percent_change_7d": -3.23081, "market_cap": 7702993419.164711, "last_updated": "2018-10-24T00:56:25.000Z" } } }, { "id": 1765, "name": "EOS", "symbol": "EOS", "slug": "eos", "circulating_supply": 906245117.6, "total_supply": 1006245119.9339, "max_supply": null, "date_added": "2017-07-01T00:00:00.000Z", "num_market_pairs": 180, "cmc_rank": 5, "last_updated": "2018-10-24T00:56:27.000Z", "quote": { "USD": { "price": 5.42138751715, "volume_24h": 331455089.763113, "percent_change_1h": 0.147428, "percent_change_24h": 0.281386, "percent_change_7d": -0.454003, "market_cap": 4913105968.034774, "last_updated": "2018-10-24T00:56:27.000Z" } } }, { "id": 512, "name": "Stellar", "symbol": "XLM", "slug": "stellar", "circulating_supply": 18894758343.4233, "total_supply": 104403430211.747, "max_supply": null, "date_added": "2014-08-05T00:00:00.000Z", "num_market_pairs": 136, "cmc_rank": 6, "last_updated": "2018-10-24T00:56:10.000Z", "quote": { "USD": { "price": 0.242255547472, "volume_24h": 38916824.7946921, "percent_change_1h": 0.0234164, "percent_change_24h": -0.443153, "percent_change_7d": 6.00634, "market_cap": 4577360026.837152, "last_updated": "2018-10-24T00:56:10.000Z" } } }, { "id": 2, "name": "Litecoin", "symbol": "LTC", "slug": "litecoin", "circulating_supply": 58855176.7972995, "total_supply": 58855176.7972995, "max_supply": 84000000, "date_added": "2013-04-28T00:00:00.000Z", "num_market_pairs": 670, "cmc_rank": 7, "last_updated": "2018-10-24T00:57:03.000Z", "quote": { "USD": { "price": 52.543600609, "volume_24h": 287501999.653804, "percent_change_1h": 0.0308739, "percent_change_24h": 0.353493, "percent_change_7d": -2.69445, "market_cap": 3092462903.4093885, "last_updated": "2018-10-24T00:57:03.000Z" } } }, { "id": 825, "name": "Tether", "symbol": "USDT", "slug": "tether", "circulating_supply": 2026421735.6243, "total_supply": 3080109502.1043, "max_supply": null, "date_added": "2015-02-25T00:00:00.000Z", "num_market_pairs": 1408, "cmc_rank": 8, "last_updated": "2018-10-24T00:56:18.000Z", "quote": { "USD": { "price": 0.984849047084, "volume_24h": 2121519080.29169, "percent_change_1h": -0.22765, "percent_change_24h": -0.0613798, "percent_change_7d": 0.863705, "market_cap": 1995719515.3198972, "last_updated": "2018-10-24T00:56:18.000Z" } } }, { "id": 2010, "name": "Cardano", "symbol": "ADA", "slug": "cardano", "circulating_supply": 25927070538, "total_supply": 31112483745, "max_supply": 45000000000, "date_added": "2017-10-01T00:00:00.000Z", "num_market_pairs": 58, "cmc_rank": 9, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.0746328453556, "volume_24h": 20853846.4240175, "percent_change_1h": -0.0111707, "percent_change_24h": -1.69653, "percent_change_7d": -2.10561, "market_cap": 1935011045.9862869, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 328, "name": "Monero", "symbol": "XMR", "slug": "monero", "circulating_supply": 16512538.2003083, "total_supply": 16512538.2003083, "max_supply": null, "date_added": "2014-05-21T00:00:00.000Z", "num_market_pairs": 99, "cmc_rank": 10, "last_updated": "2018-10-24T00:57:07.000Z", "quote": { "USD": { "price": 108.447334111, "volume_24h": 20208984.5278777, "percent_change_1h": 0.0601275, "percent_change_24h": 2.55153, "percent_change_7d": 1.58758, "market_cap": 1790740747.229485, "last_updated": "2018-10-24T00:57:07.000Z" } } }, { "id": 1958, "name": "TRON", "symbol": "TRX", "slug": "tron", "circulating_supply": 65748111645.1, "total_supply": 99000000000, "max_supply": null, "date_added": "2017-09-13T00:00:00.000Z", "num_market_pairs": 142, "cmc_rank": 11, "last_updated": "2018-10-24T00:56:33.000Z", "quote": { "USD": { "price": 0.0234440963142, "volume_24h": 79996791.5472659, "percent_change_1h": -0.0015797, "percent_change_24h": -1.53519, "percent_change_7d": -3.81438, "market_cap": 1541405061.884499, "last_updated": "2018-10-24T00:56:33.000Z" } } }, { "id": 1720, "name": "IOTA", "symbol": "MIOTA", "slug": "iota", "circulating_supply": 2779530283, "total_supply": 2779530283, "max_supply": 2779530283, "date_added": "2017-06-13T00:00:00.000Z", "num_market_pairs": 31, "cmc_rank": 12, "last_updated": "2018-10-24T00:56:22.000Z", "quote": { "USD": { "price": 0.491084113339, "volume_24h": 9374602.2441303, "percent_change_1h": -0.315894, "percent_change_24h": -0.322329, "percent_change_7d": -2.14803, "market_cap": 1364983164.5259547, "last_updated": "2018-10-24T00:56:22.000Z" } } }, { "id": 131, "name": "Dash", "symbol": "DASH", "slug": "dash", "circulating_supply": 8398143.67599161, "total_supply": 8398143.67599161, "max_supply": 18900000, "date_added": "2014-02-14T00:00:00.000Z", "num_market_pairs": 184, "cmc_rank": 13, "last_updated": "2018-10-24T00:57:09.000Z", "quote": { "USD": { "price": 154.323476352, "volume_24h": 124896591.981524, "percent_change_1h": 0.400528, "percent_change_24h": 1.22959, "percent_change_7d": -5.33654, "market_cap": 1296030726.9825895, "last_updated": "2018-10-24T00:57:09.000Z" } } }, { "id": 1839, "name": "Binance Coin", "symbol": "BNB", "slug": "binance-coin", "circulating_supply": 130799315.0005, "total_supply": 190799315, "max_supply": null, "date_added": "2017-07-25T00:00:00.000Z", "num_market_pairs": 100, "cmc_rank": 14, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 9.77646170458, "volume_24h": 30453606.7765781, "percent_change_1h": -0.143472, "percent_change_24h": 0.398588, "percent_change_7d": -1.99059, "market_cap": 1278754494.0876846, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 1376, "name": "NEO", "symbol": "NEO", "slug": "neo", "circulating_supply": 65000000, "total_supply": 100000000, "max_supply": 100000000, "date_added": "2016-09-08T00:00:00.000Z", "num_market_pairs": 131, "cmc_rank": 15, "last_updated": "2018-10-24T00:56:25.000Z", "quote": { "USD": { "price": 16.6385525108, "volume_24h": 167916466.451188, "percent_change_1h": 0.176925, "percent_change_24h": -0.685056, "percent_change_7d": 0.921958, "market_cap": 1081505913.202, "last_updated": "2018-10-24T00:56:25.000Z" } } }, { "id": 1321, "name": "Ethereum Classic", "symbol": "ETC", "slug": "ethereum-classic", "circulating_supply": 105499182, "total_supply": 105499182, "max_supply": null, "date_added": "2016-07-24T00:00:00.000Z", "num_market_pairs": 150, "cmc_rank": 16, "last_updated": "2018-10-24T00:56:29.000Z", "quote": { "USD": { "price": 9.81889581242, "volume_24h": 146779015.410914, "percent_change_1h": 0.300655, "percent_change_24h": -2.42857, "percent_change_7d": 1.05672, "market_cap": 1035885476.3535354, "last_updated": "2018-10-24T00:56:29.000Z" } } }, { "id": 873, "name": "NEM", "symbol": "XEM", "slug": "nem", "circulating_supply": 8999999999, "total_supply": 8999999999, "max_supply": null, "date_added": "2015-04-01T00:00:00.000Z", "num_market_pairs": 61, "cmc_rank": 17, "last_updated": "2018-10-24T00:56:12.000Z", "quote": { "USD": { "price": 0.0990065901262, "volume_24h": 6208054.31298194, "percent_change_1h": -0.112603, "percent_change_24h": -1.78746, "percent_change_7d": 3.03936, "market_cap": 891059311.0367935, "last_updated": "2018-10-24T00:56:12.000Z" } } }, { "id": 2011, "name": "Tezos", "symbol": "XTZ", "slug": "tezos", "circulating_supply": 607489040.89, "total_supply": 763306929.69, "max_supply": null, "date_added": "2017-10-02T00:00:00.000Z", "num_market_pairs": 24, "cmc_rank": 18, "last_updated": "2018-10-24T00:56:29.000Z", "quote": { "USD": { "price": 1.37428827713, "volume_24h": 2468496.08676538, "percent_change_1h": -0.505217, "percent_change_24h": -3.01513, "percent_change_7d": -4.57036, "market_cap": 834865067.3800743, "last_updated": "2018-10-24T00:56:29.000Z" } } }, { "id": 3077, "name": "VeChain", "symbol": "VET", "slug": "vechain", "circulating_supply": 55454734800, "total_supply": 86712634466, "max_supply": null, "date_added": "2017-08-22T00:00:00.000Z", "num_market_pairs": 23, "cmc_rank": 19, "last_updated": "2018-10-24T00:56:40.000Z", "quote": { "USD": { "price": 0.0116207865143, "volume_24h": 23220793.8404314, "percent_change_1h": -0.664303, "percent_change_24h": 4.52977, "percent_change_7d": -1.90544, "market_cap": 644427634.3179228, "last_updated": "2018-10-24T00:56:40.000Z" } } }, { "id": 1437, "name": "Zcash", "symbol": "ZEC", "slug": "zcash", "circulating_supply": 5078731.25, "total_supply": 5078731.25, "max_supply": null, "date_added": "2016-10-29T00:00:00.000Z", "num_market_pairs": 133, "cmc_rank": 20, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 121.636984681, "volume_24h": 75874195.6307684, "percent_change_1h": 0.317094, "percent_change_24h": -0.755902, "percent_change_7d": 5.48776, "market_cap": 617761555.2551659, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 74, "name": "Dogecoin", "symbol": "DOGE", "slug": "dogecoin", "circulating_supply": 116682011445.747, "total_supply": 116682011445.747, "max_supply": null, "date_added": "2013-12-15T00:00:00.000Z", "num_market_pairs": 414, "cmc_rank": 21, "last_updated": "2018-10-24T00:57:08.000Z", "quote": { "USD": { "price": 0.00415337313049, "volume_24h": 12874615.1677682, "percent_change_1h": -0.316732, "percent_change_24h": -5.30588, "percent_change_7d": -16.5929, "market_cap": 484623931.1502922, "last_updated": "2018-10-24T00:57:08.000Z" } } }, { "id": 1518, "name": "Maker", "symbol": "MKR", "slug": "maker", "circulating_supply": 728227.770105802, "total_supply": 1000000, "max_supply": null, "date_added": "2017-01-29T00:00:00.000Z", "num_market_pairs": 26, "cmc_rank": 22, "last_updated": "2018-10-24T00:56:26.000Z", "quote": { "USD": { "price": 661.235752844, "volume_24h": 197185.344298858, "percent_change_1h": -0.403928, "percent_change_24h": -2.08824, "percent_change_7d": -4.83736, "market_cap": 481530237.80781734, "last_updated": "2018-10-24T00:56:26.000Z" } } }, { "id": 1896, "name": "0x", "symbol": "ZRX", "slug": "0x", "circulating_supply": 543409464.39482, "total_supply": 1000000000, "max_supply": null, "date_added": "2017-08-16T00:00:00.000Z", "num_market_pairs": 97, "cmc_rank": 23, "last_updated": "2018-10-24T00:56:49.000Z", "quote": { "USD": { "price": 0.879172667326, "volume_24h": 12956969.7997042, "percent_change_1h": 0.0113188, "percent_change_24h": -3.25598, "percent_change_7d": -1.63226, "market_cap": 477750748.2621869, "last_updated": "2018-10-24T00:56:49.000Z" } } }, { "id": 1808, "name": "OmiseGO", "symbol": "OMG", "slug": "omisego", "circulating_supply": 140245398.245133, "total_supply": 140245398.245133, "max_supply": null, "date_added": "2017-07-14T00:00:00.000Z", "num_market_pairs": 132, "cmc_rank": 24, "last_updated": "2018-10-24T00:56:50.000Z", "quote": { "USD": { "price": 3.36524270161, "volume_24h": 21640114.1485828, "percent_change_1h": 0.350412, "percent_change_24h": -2.12067, "percent_change_7d": 6.60931, "market_cap": 471959802.8788218, "last_updated": "2018-10-24T00:56:50.000Z" } } }, { "id": 2083, "name": "Bitcoin Gold", "symbol": "BTG", "slug": "bitcoin-gold", "circulating_supply": 17303948.588994, "total_supply": 17403948.588994, "max_supply": 21000000, "date_added": "2017-10-23T00:00:00.000Z", "num_market_pairs": 71, "cmc_rank": 25, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 26.7554056283, "volume_24h": 2861600.04503139, "percent_change_1h": 0.0804433, "percent_change_24h": 2.34542, "percent_change_7d": 0.478027, "market_cap": 462974163.4697839, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 1168, "name": "Decred", "symbol": "DCR", "slug": "decred", "circulating_supply": 8692059.77183757, "total_supply": 8692059.77183757, "max_supply": 21000000, "date_added": "2016-02-10T00:00:00.000Z", "num_market_pairs": 29, "cmc_rank": 26, "last_updated": "2018-10-24T00:56:27.000Z", "quote": { "USD": { "price": 49.1247251961, "volume_24h": 23445911.7676001, "percent_change_1h": -4.05124, "percent_change_24h": 26.7589, "percent_change_7d": 23.2837, "market_cap": 426995047.6795963, "last_updated": "2018-10-24T00:56:27.000Z" } } }, { "id": 1684, "name": "Qtum", "symbol": "QTUM", "slug": "qtum", "circulating_supply": 88983308, "total_supply": 100983308, "max_supply": null, "date_added": "2017-05-24T00:00:00.000Z", "num_market_pairs": 141, "cmc_rank": 27, "last_updated": "2018-10-24T00:56:20.000Z", "quote": { "USD": { "price": 4.16611555263, "volume_24h": 110153710.559079, "percent_change_1h": 0.0390737, "percent_change_24h": -3.64059, "percent_change_7d": 13.682, "market_cap": 370714743.3832655, "last_updated": "2018-10-24T00:56:20.000Z" } } }, { "id": 2566, "name": "Ontology", "symbol": "ONT", "slug": "ontology", "circulating_supply": 207016949, "total_supply": 1000000000, "max_supply": null, "date_added": "2018-03-08T00:00:00.000Z", "num_market_pairs": 35, "cmc_rank": 28, "last_updated": "2018-10-24T00:56:27.000Z", "quote": { "USD": { "price": 1.78864730654, "volume_24h": 22681512.2828125, "percent_change_1h": 0.44132, "percent_change_24h": -1.02064, "percent_change_7d": -2.51808, "market_cap": 370280308.23697853, "last_updated": "2018-10-24T00:56:27.000Z" } } }, { "id": 1214, "name": "Lisk", "symbol": "LSK", "slug": "lisk", "circulating_supply": 111477696.784029, "total_supply": 126714888, "max_supply": null, "date_added": "2016-04-06T00:00:00.000Z", "num_market_pairs": 54, "cmc_rank": 29, "last_updated": "2018-10-24T00:56:20.000Z", "quote": { "USD": { "price": 2.99145656486, "volume_24h": 6622613.67256355, "percent_change_1h": -0.405788, "percent_change_24h": -0.26489, "percent_change_7d": -1.02618, "market_cap": 333480687.8800561, "last_updated": "2018-10-24T00:56:20.000Z" } } }, { "id": 2222, "name": "Bitcoin Diamond", "symbol": "BCD", "slug": "bitcoin-diamond", "circulating_supply": 153756875, "total_supply": 156756875, "max_supply": 210000000, "date_added": "2017-11-24T00:00:00.000Z", "num_market_pairs": 21, "cmc_rank": 30, "last_updated": "2018-10-24T00:56:36.000Z", "quote": { "USD": { "price": 2.14387669445, "volume_24h": 20890150.8932559, "percent_change_1h": 2.40226, "percent_change_24h": 19.3055, "percent_change_7d": 21.8799, "market_cap": 329635780.9239618, "last_updated": "2018-10-24T00:56:36.000Z" } } }, { "id": 1700, "name": "Aeternity", "symbol": "AE", "slug": "aeternity", "circulating_supply": 233020472.114, "total_supply": 273685830.164, "max_supply": null, "date_added": "2017-06-01T00:00:00.000Z", "num_market_pairs": 43, "cmc_rank": 31, "last_updated": "2018-10-24T00:56:22.000Z", "quote": { "USD": { "price": 1.29210840244, "volume_24h": 9419174.80874686, "percent_change_1h": -0.441242, "percent_change_24h": -1.82625, "percent_change_7d": 7.55781, "market_cap": 301087709.9590351, "last_updated": "2018-10-24T00:56:22.000Z" } } }, { "id": 1042, "name": "Siacoin", "symbol": "SC", "slug": "siacoin", "circulating_supply": 37545639747, "total_supply": 37545639747, "max_supply": null, "date_added": "2015-08-26T00:00:00.000Z", "num_market_pairs": 20, "cmc_rank": 32, "last_updated": "2018-10-24T00:57:14.000Z", "quote": { "USD": { "price": 0.00725843686941, "volume_24h": 9574690.55646454, "percent_change_1h": 0.089036, "percent_change_24h": 5.26002, "percent_change_7d": 8.90967, "market_cap": 272522655.82521033, "last_updated": "2018-10-24T00:57:14.000Z" } } }, { "id": 2469, "name": "Zilliqa", "symbol": "ZIL", "slug": "zilliqa", "circulating_supply": 7781012515.76941, "total_supply": 12600000000, "max_supply": null, "date_added": "2018-01-25T00:00:00.000Z", "num_market_pairs": 63, "cmc_rank": 33, "last_updated": "2018-10-24T00:56:24.000Z", "quote": { "USD": { "price": 0.0343573694374, "volume_24h": 4449172.64037757, "percent_change_1h": -0.149276, "percent_change_24h": -0.659143, "percent_change_7d": -0.66319, "market_cap": 267335121.6013228, "last_updated": "2018-10-24T00:56:24.000Z" } } }, { "id": 1567, "name": "Nano", "symbol": "NANO", "slug": "nano", "circulating_supply": 133248289.1965, "total_supply": 133248289.1965, "max_supply": 133248290, "date_added": "2017-03-06T00:00:00.000Z", "num_market_pairs": 39, "cmc_rank": 34, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 1.99847170469, "volume_24h": 4247155.13856416, "percent_change_1h": -0.19053, "percent_change_24h": -1.15431, "percent_change_7d": 2.42851, "market_cap": 266292935.65755546, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 463, "name": "BitShares", "symbol": "BTS", "slug": "bitshares", "circulating_supply": 2667420000, "total_supply": 2667420000, "max_supply": 3600570502, "date_added": "2014-07-21T00:00:00.000Z", "num_market_pairs": 72, "cmc_rank": 35, "last_updated": "2018-10-24T00:57:11.000Z", "quote": { "USD": { "price": 0.0987626368012, "volume_24h": 3014208.09379224, "percent_change_1h": 0.0569907, "percent_change_24h": -1.27689, "percent_change_7d": -3.61644, "market_cap": 263441432.65625688, "last_updated": "2018-10-24T00:57:11.000Z" } } }, { "id": 2099, "name": "ICON", "symbol": "ICX", "slug": "icon", "circulating_supply": 387431339.957, "total_supply": 800460000, "max_supply": null, "date_added": "2017-10-27T00:00:00.000Z", "num_market_pairs": 37, "cmc_rank": 36, "last_updated": "2018-10-24T00:56:22.000Z", "quote": { "USD": { "price": 0.664887415818, "volume_24h": 13239773.8193236, "percent_change_1h": -0.190159, "percent_change_24h": -3.14372, "percent_change_7d": -3.65211, "market_cap": 257598222.4309148, "last_updated": "2018-10-24T00:56:22.000Z" } } }, { "id": 1697, "name": "Basic Attention Token", "symbol": "BAT", "slug": "basic-attention-token", "circulating_supply": 1000000000, "total_supply": 1500000000, "max_supply": null, "date_added": "2017-06-01T00:00:00.000Z", "num_market_pairs": 52, "cmc_rank": 37, "last_updated": "2018-10-24T00:56:22.000Z", "quote": { "USD": { "price": 0.250295648942, "volume_24h": 20580211.6295301, "percent_change_1h": -0.818149, "percent_change_24h": -6.28816, "percent_change_7d": 30.904, "market_cap": 250295648.942, "last_updated": "2018-10-24T00:56:22.000Z" } } }, { "id": 109, "name": "DigiByte", "symbol": "DGB", "slug": "digibyte", "circulating_supply": 10961644235.9513, "total_supply": 10961644235.9513, "max_supply": 21000000000, "date_added": "2014-02-06T00:00:00.000Z", "num_market_pairs": 51, "cmc_rank": 38, "last_updated": "2018-10-24T00:57:10.000Z", "quote": { "USD": { "price": 0.0222896030968, "volume_24h": 2031534.81672345, "percent_change_1h": 0.932833, "percent_change_24h": -2.13889, "percent_change_7d": -5.65562, "market_cap": 244330699.30767995, "last_updated": "2018-10-24T00:57:10.000Z" } } }, { "id": 372, "name": "Bytecoin", "symbol": "BCN", "slug": "bytecoin-bcn", "circulating_supply": 184066828814.059, "total_supply": 184066828814.059, "max_supply": 184470000000, "date_added": "2014-06-17T00:00:00.000Z", "num_market_pairs": 13, "cmc_rank": 39, "last_updated": "2018-10-24T00:57:06.000Z", "quote": { "USD": { "price": 0.00131219570242, "volume_24h": 891467.487939619, "percent_change_1h": -0.491475, "percent_change_24h": -3.53953, "percent_change_7d": -12.5551, "market_cap": 241531701.72788602, "last_updated": "2018-10-24T00:57:06.000Z" } } }, { "id": 1230, "name": "Steem", "symbol": "STEEM", "slug": "steem", "circulating_supply": 280886751.321, "total_supply": 297860845.321, "max_supply": null, "date_added": "2016-04-18T00:00:00.000Z", "num_market_pairs": 21, "cmc_rank": 40, "last_updated": "2018-10-24T00:56:21.000Z", "quote": { "USD": { "price": 0.810252188577, "volume_24h": 893158.166131903, "percent_change_1h": 0.121945, "percent_change_24h": -0.977681, "percent_change_7d": -2.95518, "market_cap": 227589105.00012377, "last_updated": "2018-10-24T00:56:21.000Z" } } }, { "id": 1866, "name": "Bytom", "symbol": "BTM", "slug": "bytom", "circulating_supply": 1002499275, "total_supply": 1407000000, "max_supply": null, "date_added": "2017-08-08T00:00:00.000Z", "num_market_pairs": 37, "cmc_rank": 41, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.224876234826, "volume_24h": 54821534.0751605, "percent_change_1h": 1.87603, "percent_change_24h": 0.834955, "percent_change_7d": 25.7954, "market_cap": 225438262.37779474, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 693, "name": "Verge", "symbol": "XVG", "slug": "verge", "circulating_supply": 15172086051.1052, "total_supply": 15172086051.1052, "max_supply": 16555000000, "date_added": "2014-10-25T00:00:00.000Z", "num_market_pairs": 57, "cmc_rank": 42, "last_updated": "2018-10-24T00:57:11.000Z", "quote": { "USD": { "price": 0.0143103622452, "volume_24h": 4100199.81856185, "percent_change_1h": -1.00449, "percent_change_24h": 0.742889, "percent_change_7d": 0.284423, "market_cap": 217118047.4066614, "last_updated": "2018-10-24T00:57:11.000Z" } } }, { "id": 2603, "name": "Pundi X", "symbol": "NPXS", "slug": "pundi-x", "circulating_supply": 125679999412.644, "total_supply": 280255193861, "max_supply": null, "date_added": "2018-03-22T00:00:00.000Z", "num_market_pairs": 29, "cmc_rank": 43, "last_updated": "2018-10-24T00:56:39.000Z", "quote": { "USD": { "price": 0.0016209385353, "volume_24h": 14208620.0276864, "percent_change_1h": 0.492056, "percent_change_24h": -2.39284, "percent_change_7d": 3.66356, "market_cap": 203719554.164436, "last_updated": "2018-10-24T00:56:39.000Z" } } }, { "id": 1274, "name": "Waves", "symbol": "WAVES", "slug": "waves", "circulating_supply": 100000000, "total_supply": 100000000, "max_supply": null, "date_added": "2016-06-02T00:00:00.000Z", "num_market_pairs": 101, "cmc_rank": 44, "last_updated": "2018-10-24T00:56:29.000Z", "quote": { "USD": { "price": 1.99155564856, "volume_24h": 9365718.92612587, "percent_change_1h": 1.13475, "percent_change_24h": 2.3548, "percent_change_7d": -0.818956, "market_cap": 199155564.85599998, "last_updated": "2018-10-24T00:56:29.000Z" } } }, { "id": 2563, "name": "TrueUSD", "symbol": "TUSD", "slug": "trueusd", "circulating_supply": 175042430.49, "total_supply": 175042430.49, "max_supply": null, "date_added": "2018-03-06T00:00:00.000Z", "num_market_pairs": 63, "cmc_rank": 45, "last_updated": "2018-10-24T00:56:39.000Z", "quote": { "USD": { "price": 1.01072125612, "volume_24h": 18009338.3836175, "percent_change_1h": -0.0993757, "percent_change_24h": 0.0866612, "percent_change_7d": -1.3335, "market_cap": 176919105.2191506, "last_updated": "2018-10-24T00:56:39.000Z" } } }, { "id": 1104, "name": "Augur", "symbol": "REP", "slug": "augur", "circulating_supply": 11000000, "total_supply": 11000000, "max_supply": null, "date_added": "2015-10-27T00:00:00.000Z", "num_market_pairs": 55, "cmc_rank": 46, "last_updated": "2018-10-24T00:56:15.000Z", "quote": { "USD": { "price": 14.8261195813, "volume_24h": 6594642.91476434, "percent_change_1h": 9.17091, "percent_change_24h": 12.0716, "percent_change_7d": 17.4609, "market_cap": 163087315.3943, "last_updated": "2018-10-24T00:56:15.000Z" } } }, { "id": 1455, "name": "Golem", "symbol": "GNT", "slug": "golem-network-tokens", "circulating_supply": 959242000, "total_supply": 1000000000, "max_supply": null, "date_added": "2016-11-18T00:00:00.000Z", "num_market_pairs": 68, "cmc_rank": 47, "last_updated": "2018-10-24T00:56:33.000Z", "quote": { "USD": { "price": 0.168409868563, "volume_24h": 3739534.90952291, "percent_change_1h": -1.6218, "percent_change_24h": 3.23407, "percent_change_7d": 11.5224, "market_cap": 161545819.14010924, "last_updated": "2018-10-24T00:56:33.000Z" } } }, { "id": 1975, "name": "Chainlink", "symbol": "LINK", "slug": "chainlink", "circulating_supply": 350000000, "total_supply": 1000000000, "max_supply": null, "date_added": "2017-09-20T00:00:00.000Z", "num_market_pairs": 22, "cmc_rank": 48, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.433448763861, "volume_24h": 9489871.002333, "percent_change_1h": -0.855897, "percent_change_24h": 3.02102, "percent_change_7d": 21.4071, "market_cap": 151707067.35135, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 2682, "name": "Holo", "symbol": "HOT", "slug": "holo", "circulating_supply": 133214575156, "total_supply": 177619433541.141, "max_supply": null, "date_added": "2018-04-29T00:00:00.000Z", "num_market_pairs": 21, "cmc_rank": 49, "last_updated": "2018-10-24T00:56:40.000Z", "quote": { "USD": { "price": 0.00113068589217, "volume_24h": 4563779.53972555, "percent_change_1h": 0.336847, "percent_change_24h": 1.20797, "percent_change_7d": 1.47258, "market_cap": 150623840.76030937, "last_updated": "2018-10-24T00:56:40.000Z" } } }, { "id": 1343, "name": "Stratis", "symbol": "STRAT", "slug": "stratis", "circulating_supply": 99064734.1821562, "total_supply": 99064734.1821562, "max_supply": null, "date_added": "2016-08-12T00:00:00.000Z", "num_market_pairs": 22, "cmc_rank": 50, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 1.52040680397, "volume_24h": 1021003.14620709, "percent_change_1h": 0.270844, "percent_change_24h": 0.47191, "percent_change_7d": 6.83835, "market_cap": 150618695.88402975, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 1521, "name": "Komodo", "symbol": "KMD", "slug": "komodo", "circulating_supply": 110397308.53635, "total_supply": 110397308.53635, "max_supply": null, "date_added": "2017-02-05T00:00:00.000Z", "num_market_pairs": 16, "cmc_rank": 51, "last_updated": "2018-10-24T00:56:20.000Z", "quote": { "USD": { "price": 1.31172496846, "volume_24h": 1172459.05232313, "percent_change_1h": -0.361445, "percent_change_24h": 0.0226828, "percent_change_7d": 8.05662, "market_cap": 144810906.0579126, "last_updated": "2018-10-24T00:56:20.000Z" } } }, { "id": 1703, "name": "Metaverse ETP", "symbol": "ETP", "slug": "metaverse", "circulating_supply": 52906817.6527042, "total_supply": 56740950.9988042, "max_supply": 100000000, "date_added": "2017-06-05T00:00:00.000Z", "num_market_pairs": 22, "cmc_rank": 52, "last_updated": "2018-10-24T00:56:22.000Z", "quote": { "USD": { "price": 2.72115421106, "volume_24h": 6305367.7104609, "percent_change_1h": -0.891987, "percent_change_24h": -11.6451, "percent_change_7d": -13.6831, "market_cap": 143967609.64943957, "last_updated": "2018-10-24T00:56:22.000Z" } } }, { "id": 2137, "name": "Electroneum", "symbol": "ETN", "slug": "electroneum", "circulating_supply": 8180202990.76, "total_supply": 8180202990.76, "max_supply": 21000000000, "date_added": "2017-11-02T00:00:00.000Z", "num_market_pairs": 15, "cmc_rank": 53, "last_updated": "2018-10-24T00:56:36.000Z", "quote": { "USD": { "price": 0.0161474702013, "volume_24h": 1694928.48159333, "percent_change_1h": -1.11856, "percent_change_24h": -13.6733, "percent_change_7d": -26.2085, "market_cap": 132089584.03388226, "last_updated": "2018-10-24T00:56:36.000Z" } } }, { "id": 1789, "name": "Populous", "symbol": "PPT", "slug": "populous", "circulating_supply": 37004026.8943896, "total_supply": 53252246, "max_supply": 53252246, "date_added": "2017-07-10T00:00:00.000Z", "num_market_pairs": 19, "cmc_rank": 54, "last_updated": "2018-10-24T00:56:22.000Z", "quote": { "USD": { "price": 3.44703045262, "volume_24h": 597132.056087936, "percent_change_1h": -0.206982, "percent_change_24h": 0.345006, "percent_change_7d": 2.81139, "market_cap": 127554007.57453044, "last_updated": "2018-10-24T00:56:22.000Z" } } }, { "id": 1759, "name": "Status", "symbol": "SNT", "slug": "status", "circulating_supply": 3470483788, "total_supply": 6804870174, "max_supply": null, "date_added": "2017-06-28T00:00:00.000Z", "num_market_pairs": 72, "cmc_rank": 55, "last_updated": "2018-10-24T00:56:24.000Z", "quote": { "USD": { "price": 0.0364797599451, "volume_24h": 1730391.01704387, "percent_change_1h": -0.478125, "percent_change_24h": 1.035, "percent_change_7d": 0.384805, "market_cap": 126602415.47960131, "last_updated": "2018-10-24T00:56:24.000Z" } } }, { "id": 1925, "name": "Waltonchain", "symbol": "WTC", "slug": "waltonchain", "circulating_supply": 40144099.4106683, "total_supply": 70000000, "max_supply": 100000000, "date_added": "2017-08-27T00:00:00.000Z", "num_market_pairs": 26, "cmc_rank": 56, "last_updated": "2018-10-24T00:56:21.000Z", "quote": { "USD": { "price": 3.08337322498, "volume_24h": 17906016.0757613, "percent_change_1h": 0.03774, "percent_change_24h": 2.31473, "percent_change_7d": 6.52068, "market_cap": 123779241.26379003, "last_updated": "2018-10-24T00:56:21.000Z" } } }, { "id": 2027, "name": "Cryptonex", "symbol": "CNX", "slug": "cryptonex", "circulating_supply": 55518260.3841729, "total_supply": 106966985.344173, "max_supply": 210000000, "date_added": "2017-10-07T00:00:00.000Z", "num_market_pairs": 21, "cmc_rank": 57, "last_updated": "2018-10-24T00:56:22.000Z", "quote": { "USD": { "price": 2.12001584262, "volume_24h": 7555370.34154926, "percent_change_1h": 0.375181, "percent_change_24h": 0.20211, "percent_change_7d": -1.84069, "market_cap": 117699591.56914888, "last_updated": "2018-10-24T00:56:22.000Z" } } }, { "id": 2874, "name": "Aurora", "symbol": "AOA", "slug": "aurora", "circulating_supply": 4542215296.6353, "total_supply": 10000000000, "max_supply": null, "date_added": "2018-06-26T00:00:00.000Z", "num_market_pairs": 8, "cmc_rank": 58, "last_updated": "2018-10-24T00:56:39.000Z", "quote": { "USD": { "price": 0.0252531585296, "volume_24h": 1085663.7901424, "percent_change_1h": -0.16469, "percent_change_24h": -3.58038, "percent_change_7d": -2.81644, "market_cap": 114705282.96150531, "last_updated": "2018-10-24T00:56:39.000Z" } } }, { "id": 1320, "name": "Ardor", "symbol": "ARDR", "slug": "ardor", "circulating_supply": 998999495, "total_supply": 998999495, "max_supply": 998999495, "date_added": "2016-07-23T00:00:00.000Z", "num_market_pairs": 15, "cmc_rank": 59, "last_updated": "2018-10-24T00:56:24.000Z", "quote": { "USD": { "price": 0.113717663938, "volume_24h": 990499.431511963, "percent_change_1h": 0.389014, "percent_change_24h": 0.268067, "percent_change_7d": -1.65615, "market_cap": 113603888.8466417, "last_updated": "2018-10-24T00:56:24.000Z" } } }, { "id": 2405, "name": "IOST", "symbol": "IOST", "slug": "iostoken", "circulating_supply": 8400000000, "total_supply": 21000000000, "max_supply": null, "date_added": "2018-01-16T00:00:00.000Z", "num_market_pairs": 45, "cmc_rank": 60, "last_updated": "2018-10-24T00:56:33.000Z", "quote": { "USD": { "price": 0.0124131465728, "volume_24h": 9728058.81957365, "percent_change_1h": -0.259159, "percent_change_24h": 2.16114, "percent_change_7d": 2.51561, "market_cap": 104270431.21152, "last_updated": "2018-10-24T00:56:33.000Z" } } }, { "id": 2606, "name": "Wanchain", "symbol": "WAN", "slug": "wanchain", "circulating_supply": 106152492.636, "total_supply": 210000000, "max_supply": null, "date_added": "2018-03-23T00:00:00.000Z", "num_market_pairs": 13, "cmc_rank": 61, "last_updated": "2018-10-24T00:56:29.000Z", "quote": { "USD": { "price": 0.972030013547, "volume_24h": 2049716.8303211, "percent_change_1h": -0.256942, "percent_change_24h": -2.58697, "percent_change_7d": -2.70646, "market_cap": 103183408.85501891, "last_updated": "2018-10-24T00:56:29.000Z" } } }, { "id": 2062, "name": "Aion", "symbol": "AION", "slug": "aion", "circulating_supply": 242806286.735968, "total_supply": 465934586.66, "max_supply": null, "date_added": "2017-10-18T00:00:00.000Z", "num_market_pairs": 28, "cmc_rank": 62, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.415939822268, "volume_24h": 3176157.30637391, "percent_change_1h": -0.362956, "percent_change_24h": -1.00593, "percent_change_7d": -4.40309, "market_cap": 100992803.75051159, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 2608, "name": "Mithril", "symbol": "MITH", "slug": "mithril", "circulating_supply": 387392092.119309, "total_supply": 1000000000, "max_supply": null, "date_added": "2018-03-24T00:00:00.000Z", "num_market_pairs": 33, "cmc_rank": 63, "last_updated": "2018-10-24T00:56:42.000Z", "quote": { "USD": { "price": 0.26018556941, "volume_24h": 12069579.2514263, "percent_change_1h": -0.352321, "percent_change_24h": -0.796572, "percent_change_7d": 4.28114, "market_cap": 100793832.07299358, "last_updated": "2018-10-24T00:56:42.000Z" } } }, { "id": 2087, "name": "KuCoin Shares", "symbol": "KCS", "slug": "kucoin-shares", "circulating_supply": 90730576, "total_supply": 180730576, "max_supply": null, "date_added": "2017-10-24T00:00:00.000Z", "num_market_pairs": 11, "cmc_rank": 64, "last_updated": "2018-10-24T00:56:29.000Z", "quote": { "USD": { "price": 1.07614048403, "volume_24h": 111695.040835179, "percent_change_1h": -0.222632, "percent_change_24h": -1.37286, "percent_change_7d": -5.37855, "market_cap": 97638845.9729607, "last_updated": "2018-10-24T00:56:29.000Z" } } }, { "id": 2577, "name": "Ravencoin", "symbol": "RVN", "slug": "ravencoin", "circulating_supply": 2087265000, "total_supply": 2087265000, "max_supply": 21000000000, "date_added": "2018-03-10T00:00:00.000Z", "num_market_pairs": 23, "cmc_rank": 65, "last_updated": "2018-10-24T00:56:43.000Z", "quote": { "USD": { "price": 0.0457074555916, "volume_24h": 62825008.9697977, "percent_change_1h": -0.918062, "percent_change_24h": -20.3383, "percent_change_7d": 99.1604, "market_cap": 95403572.29540098, "last_updated": "2018-10-24T00:56:43.000Z" } } }, { "id": 291, "name": "MaidSafeCoin", "symbol": "MAID", "slug": "maidsafecoin", "circulating_supply": 452552412, "total_supply": 452552412, "max_supply": null, "date_added": "2014-04-28T00:00:00.000Z", "num_market_pairs": 7, "cmc_rank": 66, "last_updated": "2018-10-24T00:57:11.000Z", "quote": { "USD": { "price": 0.208637040189, "volume_24h": 760889.313989964, "percent_change_1h": -0.573907, "percent_change_24h": -0.0631686, "percent_change_7d": 6.87121, "market_cap": 94419195.77007289, "last_updated": "2018-10-24T00:57:11.000Z" } } }, { "id": 1934, "name": "Loopring", "symbol": "LRC", "slug": "loopring", "circulating_supply": 788984490.938568, "total_supply": 1374955751.72106, "max_supply": null, "date_added": "2017-08-30T00:00:00.000Z", "num_market_pairs": 32, "cmc_rank": 67, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.113610311197, "volume_24h": 929748.5097663, "percent_change_1h": 0.0917523, "percent_change_24h": 0.989387, "percent_change_7d": 1.00612, "market_cap": 89636773.54513735, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 2772, "name": "Digitex Futures", "symbol": "DGTX", "slug": "digitex-futures", "circulating_supply": 700000000, "total_supply": 1000000000, "max_supply": null, "date_added": "2018-05-23T00:00:00.000Z", "num_market_pairs": 3, "cmc_rank": 68, "last_updated": "2018-10-24T00:56:40.000Z", "quote": { "USD": { "price": 0.126082829903, "volume_24h": 722036.795640566, "percent_change_1h": -0.276961, "percent_change_24h": 3.19895, "percent_change_7d": 9.4498, "market_cap": 88257980.9321, "last_updated": "2018-10-24T00:56:40.000Z" } } }, { "id": 118, "name": "ReddCoin", "symbol": "RDD", "slug": "reddcoin", "circulating_supply": 28808713173.7887, "total_supply": 28808713173.7887, "max_supply": null, "date_added": "2014-02-10T00:00:00.000Z", "num_market_pairs": 24, "cmc_rank": 69, "last_updated": "2018-10-24T00:57:08.000Z", "quote": { "USD": { "price": 0.0030300305447, "volume_24h": 913638.935483426, "percent_change_1h": -0.729704, "percent_change_24h": -1.84969, "percent_change_7d": -7.42219, "market_cap": 87291280.87008104, "last_updated": "2018-10-24T00:57:08.000Z" } } }, { "id": 3134, "name": "ETERNAL TOKEN", "symbol": "XET", "slug": "eternal-token", "circulating_supply": 60440001, "total_supply": 200000000, "max_supply": null, "date_added": "2018-08-09T00:00:00.000Z", "num_market_pairs": 4, "cmc_rank": 70, "last_updated": "2018-10-24T00:56:40.000Z", "quote": { "USD": { "price": 1.44034984573, "volume_24h": 481799.641076003, "percent_change_1h": 0.70393, "percent_change_24h": -3.01377, "percent_change_7d": -15.3228, "market_cap": 87054746.11627103, "last_updated": "2018-10-24T00:56:40.000Z" } } }, { "id": 1750, "name": "GXChain", "symbol": "GXS", "slug": "gxchain", "circulating_supply": 60000000, "total_supply": 100000000, "max_supply": 100000000, "date_added": "2017-06-25T00:00:00.000Z", "num_market_pairs": 11, "cmc_rank": 71, "last_updated": "2018-10-24T00:56:33.000Z", "quote": { "USD": { "price": 1.40396441696, "volume_24h": 1498769.66449346, "percent_change_1h": -0.192576, "percent_change_24h": 2.00975, "percent_change_7d": -5.25706, "market_cap": 84237865.0176, "last_updated": "2018-10-24T00:56:33.000Z" } } }, { "id": 1229, "name": "DigixDAO", "symbol": "DGD", "slug": "digixdao", "circulating_supply": 2000000, "total_supply": 2000000, "max_supply": null, "date_added": "2016-04-18T00:00:00.000Z", "num_market_pairs": 24, "cmc_rank": 72, "last_updated": "2018-10-24T00:56:22.000Z", "quote": { "USD": { "price": 41.6691739227, "volume_24h": 1250320.39255323, "percent_change_1h": -0.104188, "percent_change_24h": -5.77031, "percent_change_7d": -7.01386, "market_cap": 83338347.84539999, "last_updated": "2018-10-24T00:56:22.000Z" } } }, { "id": 1903, "name": "HyperCash", "symbol": "HC", "slug": "hypercash", "circulating_supply": 43529780.865052, "total_supply": 43529780.865052, "max_supply": 84000000, "date_added": "2017-08-20T00:00:00.000Z", "num_market_pairs": 15, "cmc_rank": 73, "last_updated": "2018-10-24T00:56:21.000Z", "quote": { "USD": { "price": 1.90843196315, "volume_24h": 615547.541206576, "percent_change_1h": -0.447556, "percent_change_24h": -3.63643, "percent_change_7d": 2.25741, "market_cap": 83073625.15178049, "last_updated": "2018-10-24T00:56:21.000Z" } } }, { "id": 2299, "name": "aelf", "symbol": "ELF", "slug": "aelf", "circulating_supply": 250000000, "total_supply": 280000000, "max_supply": 1000000000, "date_added": "2017-12-21T00:00:00.000Z", "num_market_pairs": 42, "cmc_rank": 74, "last_updated": "2018-10-24T00:56:33.000Z", "quote": { "USD": { "price": 0.331583731483, "volume_24h": 4626015.88247231, "percent_change_1h": -0.507967, "percent_change_24h": 0.152123, "percent_change_7d": 0.193612, "market_cap": 82895932.87075001, "last_updated": "2018-10-24T00:56:33.000Z" } } }, { "id": 1586, "name": "Ark", "symbol": "ARK", "slug": "ark", "circulating_supply": 105903464, "total_supply": 137153464, "max_supply": null, "date_added": "2017-03-22T00:00:00.000Z", "num_market_pairs": 20, "cmc_rank": 75, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.768560826908, "volume_24h": 330523.315481386, "percent_change_1h": 0.359423, "percent_change_24h": 0.114909, "percent_change_7d": 2.0878, "market_cap": 81393253.86426161, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 2502, "name": "Huobi Token", "symbol": "HT", "slug": "huobi-token", "circulating_supply": 50000200, "total_supply": 500000000, "max_supply": null, "date_added": "2018-02-03T00:00:00.000Z", "num_market_pairs": 16, "cmc_rank": 76, "last_updated": "2018-10-24T00:56:24.000Z", "quote": { "USD": { "price": 1.6156040412, "volume_24h": 6510117.49152173, "percent_change_1h": 0.201405, "percent_change_24h": -0.00303372, "percent_change_7d": -1.06035, "market_cap": 80780525.18080823, "last_updated": "2018-10-24T00:56:24.000Z" } } }, { "id": 2246, "name": "CyberMiles", "symbol": "CMT", "slug": "cybermiles", "circulating_supply": 764598428.5674, "total_supply": 1000000000, "max_supply": null, "date_added": "2017-12-06T00:00:00.000Z", "num_market_pairs": 32, "cmc_rank": 77, "last_updated": "2018-10-24T00:56:37.000Z", "quote": { "USD": { "price": 0.104132127445, "volume_24h": 2530160.79220534, "percent_change_1h": -0.0368363, "percent_change_24h": -2.47931, "percent_change_7d": -16.2181, "market_cap": 79619261.00782722, "last_updated": "2018-10-24T00:56:37.000Z" } } }, { "id": 3330, "name": "Paxos Standard Token", "symbol": "PAX", "slug": "paxos-standard-token", "circulating_supply": 78491265.44, "total_supply": 82040663.44, "max_supply": null, "date_added": "2018-09-27T00:00:00.000Z", "num_market_pairs": 21, "cmc_rank": 78, "last_updated": "2018-10-24T00:56:46.000Z", "quote": { "USD": { "price": 1.00831038024, "volume_24h": 20258084.9186907, "percent_change_1h": -0.179149, "percent_change_24h": 0.0228809, "percent_change_7d": -0.96176, "market_cap": 79143557.70132516, "last_updated": "2018-10-24T00:56:46.000Z" } } }, { "id": 1169, "name": "PIVX", "symbol": "PIVX", "slug": "pivx", "circulating_supply": 56781165.992094, "total_supply": 56781165.992094, "max_supply": null, "date_added": "2016-02-13T00:00:00.000Z", "num_market_pairs": 27, "cmc_rank": 79, "last_updated": "2018-10-24T00:56:19.000Z", "quote": { "USD": { "price": 1.38550276052, "volume_24h": 3781325.96404007, "percent_change_1h": -0.27344, "percent_change_24h": 5.92839, "percent_change_7d": 11.8544, "market_cap": 78670462.22759059, "last_updated": "2018-10-24T00:56:19.000Z" } } }, { "id": 2694, "name": "Nexo", "symbol": "NEXO", "slug": "nexo", "circulating_supply": 560000011, "total_supply": 1000000000, "max_supply": null, "date_added": "2018-05-01T00:00:00.000Z", "num_market_pairs": 14, "cmc_rank": 80, "last_updated": "2018-10-24T00:56:40.000Z", "quote": { "USD": { "price": 0.14031320049, "volume_24h": 1953957.94355072, "percent_change_1h": -0.598478, "percent_change_24h": 8.51886, "percent_change_7d": 47.2742, "market_cap": 78575393.81784521, "last_updated": "2018-10-24T00:56:40.000Z" } } }, { "id": 1776, "name": "Crypto.com", "symbol": "MCO", "slug": "crypto-com", "circulating_supply": 15793831.0949625, "total_supply": 31587682.3632061, "max_supply": null, "date_added": "2017-07-03T00:00:00.000Z", "num_market_pairs": 41, "cmc_rank": 81, "last_updated": "2018-10-24T00:56:21.000Z", "quote": { "USD": { "price": 4.89493444682, "volume_24h": 8059436.40369873, "percent_change_1h": -0.675105, "percent_change_24h": -9.41331, "percent_change_7d": 14.7471, "market_cap": 77309767.87398878, "last_updated": "2018-10-24T00:56:21.000Z" } } }, { "id": 1966, "name": "Decentraland", "symbol": "MANA", "slug": "decentraland", "circulating_supply": 1050141509.426, "total_supply": 2644403343.1583, "max_supply": null, "date_added": "2017-09-17T00:00:00.000Z", "num_market_pairs": 49, "cmc_rank": 82, "last_updated": "2018-10-24T00:56:37.000Z", "quote": { "USD": { "price": 0.0726768243503, "volume_24h": 5961295.30513458, "percent_change_1h": -0.869466, "percent_change_24h": 1.03708, "percent_change_7d": 2.75539, "market_cap": 76320950.02351232, "last_updated": "2018-10-24T00:56:37.000Z" } } }, { "id": 2213, "name": "QASH", "symbol": "QASH", "slug": "qash", "circulating_supply": 350000000, "total_supply": 1000000000, "max_supply": null, "date_added": "2017-11-21T00:00:00.000Z", "num_market_pairs": 30, "cmc_rank": 83, "last_updated": "2018-10-24T00:56:36.000Z", "quote": { "USD": { "price": 0.218016482035, "volume_24h": 680721.525136403, "percent_change_1h": 0.610764, "percent_change_24h": -0.27308, "percent_change_7d": -1.61346, "market_cap": 76305768.71225, "last_updated": "2018-10-24T00:56:36.000Z" } } }, { "id": 2591, "name": "Dropil", "symbol": "DROP", "slug": "dropil", "circulating_supply": 22527142493.5737, "total_supply": 30000000000, "max_supply": null, "date_added": "2018-03-18T00:00:00.000Z", "num_market_pairs": 6, "cmc_rank": 84, "last_updated": "2018-10-24T00:56:36.000Z", "quote": { "USD": { "price": 0.00333522234094, "volume_24h": 463630.945278645, "percent_change_1h": -9.6302, "percent_change_24h": 9.13966, "percent_change_7d": 5.94034, "market_cap": 75133028.92210582, "last_updated": "2018-10-24T00:56:36.000Z" } } }, { "id": 2300, "name": "WAX", "symbol": "WAX", "slug": "wax", "circulating_supply": 934793406.962148, "total_supply": 1850000000, "max_supply": null, "date_added": "2017-12-21T00:00:00.000Z", "num_market_pairs": 26, "cmc_rank": 85, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.079800306714, "volume_24h": 453931.032049546, "percent_change_1h": 2.00827, "percent_change_24h": -6.45998, "percent_change_7d": 24.0465, "market_cap": 74596800.58980443, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 1727, "name": "Bancor", "symbol": "BNT", "slug": "bancor", "circulating_supply": 58091559.0162128, "total_supply": 78060756.1035398, "max_supply": null, "date_added": "2017-06-18T00:00:00.000Z", "num_market_pairs": 124, "cmc_rank": 86, "last_updated": "2018-10-24T00:56:23.000Z", "quote": { "USD": { "price": 1.27827843098, "volume_24h": 2668713.2973363, "percent_change_1h": -0.09326, "percent_change_24h": 0.408773, "percent_change_7d": -1.75423, "market_cap": 74257186.91242656, "last_updated": "2018-10-24T00:56:23.000Z" } } }, { "id": 1876, "name": "Dentacoin", "symbol": "DCN", "slug": "dentacoin", "circulating_supply": 325226613094, "total_supply": 1963173416169, "max_supply": 8000000000000, "date_added": "2017-08-11T00:00:00.000Z", "num_market_pairs": 13, "cmc_rank": 87, "last_updated": "2018-10-24T00:56:33.000Z", "quote": { "USD": { "price": 0.000227646529923, "volume_24h": 25996.9959190018, "percent_change_1h": -0.110709, "percent_change_24h": -2.25097, "percent_change_7d": -4.17121, "market_cap": 74036709.90945922, "last_updated": "2018-10-24T00:56:33.000Z" } } }, { "id": 2588, "name": "Loom Network", "symbol": "LOOM", "slug": "loom-network", "circulating_supply": 601010547.021356, "total_supply": 1000000000, "max_supply": null, "date_added": "2018-03-14T00:00:00.000Z", "num_market_pairs": 36, "cmc_rank": 88, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.122167344854, "volume_24h": 3399646.5673344, "percent_change_1h": 0.291716, "percent_change_24h": -3.75743, "percent_change_7d": -2.58307, "market_cap": 73423862.75884919, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 213, "name": "MonaCoin", "symbol": "MONA", "slug": "monacoin", "circulating_supply": 63167174.871699, "total_supply": 63167174.871699, "max_supply": null, "date_added": "2014-03-20T00:00:00.000Z", "num_market_pairs": 20, "cmc_rank": 89, "last_updated": "2018-10-24T00:57:07.000Z", "quote": { "USD": { "price": 1.1561973403, "volume_24h": 524080.614199067, "percent_change_1h": -0.0218479, "percent_change_24h": 0.777577, "percent_change_7d": -3.45179, "market_cap": 73033719.58092338, "last_updated": "2018-10-24T00:57:07.000Z" } } }, { "id": 1757, "name": "FunFair", "symbol": "FUN", "slug": "funfair", "circulating_supply": 5179824688.66342, "total_supply": 10999873621.398, "max_supply": null, "date_added": "2017-06-27T00:00:00.000Z", "num_market_pairs": 25, "cmc_rank": 90, "last_updated": "2018-10-24T00:56:27.000Z", "quote": { "USD": { "price": 0.0139434149246, "volume_24h": 1764278.42838468, "percent_change_1h": -0.133112, "percent_change_24h": 2.6932, "percent_change_7d": -4.36923, "market_cap": 72224444.87072107, "last_updated": "2018-10-24T00:56:27.000Z" } } }, { "id": 1908, "name": "Nebulas", "symbol": "NAS", "slug": "nebulas-token", "circulating_supply": 45500000, "total_supply": 100000000, "max_supply": 100000000, "date_added": "2017-08-23T00:00:00.000Z", "num_market_pairs": 18, "cmc_rank": 91, "last_updated": "2018-10-24T00:56:36.000Z", "quote": { "USD": { "price": 1.5713043124, "volume_24h": 3735638.15167502, "percent_change_1h": -0.143032, "percent_change_24h": -2.99757, "percent_change_7d": -6.92557, "market_cap": 71494346.21419999, "last_updated": "2018-10-24T00:56:36.000Z" } } }, { "id": 2496, "name": "Polymath", "symbol": "POLY", "slug": "polymath-network", "circulating_supply": 285282106.860699, "total_supply": 1000000000, "max_supply": null, "date_added": "2018-02-02T00:00:00.000Z", "num_market_pairs": 23, "cmc_rank": 92, "last_updated": "2018-10-24T00:56:36.000Z", "quote": { "USD": { "price": 0.249896504457, "volume_24h": 11702751.4885167, "percent_change_1h": -1.29125, "percent_change_24h": -0.260371, "percent_change_7d": 25.5618, "market_cap": 71291001.28861701, "last_updated": "2018-10-24T00:56:36.000Z" } } }, { "id": 2403, "name": "MOAC", "symbol": "MOAC", "slug": "moac", "circulating_supply": 62463333.6041915, "total_supply": 151205864, "max_supply": null, "date_added": "2018-01-15T00:00:00.000Z", "num_market_pairs": 2, "cmc_rank": 93, "last_updated": "2018-10-24T00:56:39.000Z", "quote": { "USD": { "price": 1.12653173987, "volume_24h": 110965.069219661, "percent_change_1h": -0.815284, "percent_change_24h": -4.58116, "percent_change_7d": -9.95694, "market_cap": 70366927.8832101, "last_updated": "2018-10-24T00:56:39.000Z" } } }, { "id": 2181, "name": "Genesis Vision", "symbol": "GVT", "slug": "genesis-vision", "circulating_supply": 4417122.69524779, "total_supply": 4436643.92853333, "max_supply": null, "date_added": "2017-11-15T00:00:00.000Z", "num_market_pairs": 11, "cmc_rank": 94, "last_updated": "2018-10-24T00:56:36.000Z", "quote": { "USD": { "price": 15.8898460867, "volume_24h": 6880472.13489777, "percent_change_1h": 0.0393241, "percent_change_24h": 8.08933, "percent_change_7d": 33.9207, "market_cap": 70187399.77355686, "last_updated": "2018-10-24T00:56:36.000Z" } } }, { "id": 1710, "name": "Veritaseum", "symbol": "VERI", "slug": "veritaseum", "circulating_supply": 2036645.44, "total_supply": 100000000, "max_supply": null, "date_added": "2017-06-08T00:00:00.000Z", "num_market_pairs": 10, "cmc_rank": 95, "last_updated": "2018-10-24T00:56:21.000Z", "quote": { "USD": { "price": 34.317972015, "volume_24h": 788430.228569761, "percent_change_1h": -0.00110141, "percent_change_24h": -10.9746, "percent_change_7d": 70.4116, "market_cap": 69893541.21439737, "last_updated": "2018-10-24T00:56:21.000Z" } } }, { "id": 2132, "name": "Power Ledger", "symbol": "POWR", "slug": "power-ledger", "circulating_supply": 387585911.559714, "total_supply": 1000000000, "max_supply": null, "date_added": "2017-11-01T00:00:00.000Z", "num_market_pairs": 36, "cmc_rank": 96, "last_updated": "2018-10-24T00:56:30.000Z", "quote": { "USD": { "price": 0.176129116683, "volume_24h": 3987933.66864627, "percent_change_1h": 1.48921, "percent_change_24h": -0.468876, "percent_change_7d": 2.32275, "market_cap": 68265164.24178779, "last_updated": "2018-10-24T00:56:30.000Z" } } }, { "id": 1698, "name": "Horizen", "symbol": "ZEN", "slug": "zencash", "circulating_supply": 4998350, "total_supply": 4998350, "max_supply": 21000000, "date_added": "2017-06-01T00:00:00.000Z", "num_market_pairs": 23, "cmc_rank": 97, "last_updated": "2018-10-24T00:56:33.000Z", "quote": { "USD": { "price": 13.599376689, "volume_24h": 637660.744037972, "percent_change_1h": -0.266506, "percent_change_24h": -1.76893, "percent_change_7d": -3.25352, "market_cap": 67974444.47346315, "last_updated": "2018-10-24T00:56:33.000Z" } } }, { "id": 2492, "name": "Elastos", "symbol": "ELA", "slug": "elastos", "circulating_supply": 7722239.18461575, "total_supply": 33647865.1318678, "max_supply": null, "date_added": "2018-01-31T00:00:00.000Z", "num_market_pairs": 11, "cmc_rank": 98, "last_updated": "2018-10-24T00:56:39.000Z", "quote": { "USD": { "price": 8.73070225896, "volume_24h": 1867224.85374773, "percent_change_1h": 0.0848753, "percent_change_24h": -1.44992, "percent_change_7d": -7.61343, "market_cap": 67420571.09335415, "last_updated": "2018-10-24T00:56:39.000Z" } } }, { "id": 1715, "name": "MobileGo", "symbol": "MGO", "slug": "mobilego", "circulating_supply": 100000000, "total_supply": 100000000, "max_supply": null, "date_added": "2017-06-11T00:00:00.000Z", "num_market_pairs": 19, "cmc_rank": 99, "last_updated": "2018-10-24T00:56:25.000Z", "quote": { "USD": { "price": 0.666618906964, "volume_24h": 18032646.3495096, "percent_change_1h": -1.79491, "percent_change_24h": 9.4223, "percent_change_7d": 17.1849, "market_cap": 66661890.696399994, "last_updated": "2018-10-24T00:56:25.000Z" } } }, { "id": 2308, "name": "Dai", "symbol": "DAI", "slug": "dai", "circulating_supply": 65319631.0978989, "total_supply": 65319631.0978989, "max_supply": null, "date_added": "2017-12-24T00:00:00.000Z", "num_market_pairs": 35, "cmc_rank": 100, "last_updated": "2018-10-24T00:56:37.000Z", "quote": { "USD": { "price": 1.01779880196, "volume_24h": 6969276.68431041, "percent_change_1h": -0.0354756, "percent_change_24h": -1.08503, "percent_change_7d": 0.887898, "market_cap": 66482242.27591065, "last_updated": "2018-10-24T00:56:37.000Z" } } } ] }';


    $coins_array_raw = json_decode($coins_array_raw_json);


    $coins_array = $coins_array_raw->data;

    $tier_I_array = Array();
    $tier_II_array = Array();
    $tier_III_array = Array();
    $coinOrderArray = Array();
    $n = 0;
    foreach ($coins_array as $coinObject){
      $symbol = $coinObject->symbol;
      if ($n < $tier_I_max){
        array_push($tier_I_array, $symbol);
      }elseif ($n < $tier_II_max){
        array_push($tier_II_array, $symbol);
      }elseif ($n < $tier_III_max){
        array_push($tier_III_array, $symbol);
      }
      $n++;
      $coinOrderArray[$symbol] = $n;    
    }

    $r = Array('tier_I'=>$tier_I_array,'tier_II'=>$tier_II_array,'tier_III'=>$tier_III_array,'all_coins'=>$coinOrderArray);
    return $r;

  }


// function for fetching account balances by calling AWS lambda Function End point

// https://p16hsik7j1.execute-api.us-west-2.amazonaws.com/dev/balances

function getAccountBalances() {
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, LAMBDA_API."/dev/balances");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 0);

  $headers = array();
  // $headers[] = "Content-Type: application/json";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $balanceResult = curl_exec($ch);
  if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);

  $arr = '';

  $balanceResult = objToArray(json_decode($balanceResult) , $arr);

  return $balanceResult;
}

// function for fetching coins prices by calling AWS lambda Function End point

// https://p16hsik7j1.execute-api.us-west-2.amazonaws.com/dev/prices

function getCoinPrices() {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, LAMBDA_API."/dev/prices");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 0);

  $headers = array();
  // $headers[] = "Content-Type: application/json";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $priceResult = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);

  //echo "Price API Response"."<br/>";
  $arr = '';
  $priceResult = objToArray(json_decode($priceResult) , $arr);

  return $priceResult;
}

// function for initiating buyTrade MarketBuy by calling AWS lambda Function End point

// https://p16hsik7j1.execute-api.us-west-2.amazonaws.com/dev/buy

function buyTradeResult ($trade_coin_symbol , $accountCoinTradeAmount) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, LAMBDA_API."/dev/buy");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "symbol=".$trade_coin_symbol."&quantity=".$accountCoinTradeAmount);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
  curl_setopt($ch, CURLOPT_POST, 1);

  $headers = array();
  // $headers[] = "Content-Type: application/json";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);

  $arr = '';

  if($result)
    return objToArray(json_decode($result) , $arr);
  else 
    return false;
}



// Function for converting Object to Array recursively.

function objToArray($obj, &$arr){

    if(!is_object($obj) && !is_array($obj)){
        $arr = $obj;
        return $arr;
    }

    foreach ($obj as $key => $value)
    {
        if (!empty($value))
        {
            $arr[$key] = array();
            objToArray($value, $arr[$key]);
        }
        else
        {
            $arr[$key] = $value;
        }
    }
    return $arr;
}

function sortByTradeTime($a, $b) {
  return $b['tradeTime'] - $a['tradeTime'];
}


function sortByOrder_BU($a, $b) {
  return $b['sort_value'] - $a['sort_value'];
}

    function sortByOrder( $x, $y) 
    {    
        // If $x is equal to $y it returns 0 
        if ($x['sort_value']== $y['sort_value']) 
            return 0; 
      
        // if x is less than y then it returns -1 
        // else it returns 1     
        if ($x['sort_value'] > $y['sort_value']) 
            return -1; 
        else
            return 1; 
    } 

/*
function sortByOrder($a,$b)
{
if ($a==$b) return 0;
        if ($a < $b) 
            return -1; 
        else
            return 1; 
    } 

//return ($a<$b)?-1:1;
}
*/

function getTraderSignalsFolderName()
{
  return 'trader_signals';
}

function getBotCoinsFolderName()
{
  return 'sell_bot_active_coins';
}

function getBotCompletedTradesFolderName()
{
	return 'sell_bot_completed';
}

function getBotTradesFolderName()
{
	return 'sell_bot_trades';
}


	


function createBinanceApiObject($account)
{
   $CI  =& get_instance();
   $CI->load->library('encrypt');
   $binanceApiRecord = getApiKeyForBinanceAccount($account);
   $k =$CI->encrypt->decode($binanceApiRecord->api_key);
   $s =$CI->encrypt->decode($binanceApiRecord->api_secret);

  //~ $k = $binanceApiRecord["api-key"];
  //~ $s = $binanceApiRecord["api-secret"];

  $api = new Binance\API($k,$s);

  // print_r($api->balances());
  // exit;

  return $api;
}

function getApiKeyForBinanceAccount($account)
{
  $CI  =& get_instance();
  $account=$CI->db->get_where('user_temp', array('account_name' => $account))->row();
  return $account;
  //~ $arr = '';
  //~ $contents = $CI->s3->read('php-binance-api.json');
  //~ $contents = json_decode($contents);
  //~ $keyArray = objToArray($contents->$account , $arr);
  //return $keyArray; 
}


function getApiKeyAccounts()
{
  $CI =& get_instance();
  $arr = '';
  $array=$CI->db->query('select account_name from user_temp')->result_array();
  foreach($array as $key)
   {
	  $arr[]= $key['account_name'];
	}
	  
  //~ $contents = $CI->s3->read('php-binance-api.json');
  //~ $contents = objToArray(json_decode($contents), $arr);
  //~ $accounts = array_keys($contents);
  return $arr;
}


function listAccountCoinJsonFiles($account)
  {
  
     $CI =& get_instance();
    $arr = array();

    $sellBotCoinDir = getBotCoinsFolderName().'/'.$account;
    $files = $CI->s3->getObjectOfFiles('json-trader-binance-storage',$sellBotCoinDir);
   
   // $files = $CI->s3->getIterator($sellBotCoinDir);
   foreach($files as $f)
   {
	   $keyitem = $f['Key'];
	   $key=explode('/',$keyitem);
	  $arr[]=$key[2];
	  
	 }

      $fileListClean = Array();
    foreach($arr as $file) {
      if(strpos($file, '.') != (int) 0) {
        array_push($fileListClean,$file);
      }
      
    }
   
    return $fileListClean;
}

function getbtcusd()
{
  $url = "https://bitpay.com/api/rates";

  $json = file_get_contents($url);
  $data = json_decode($json, TRUE);
  $rate = 0;

  foreach($data as $item)
  {
    if(($item['code']) == 'USD')
    {
      $BTCUSD = $item['rate'];
      break;
    }
  }
  return $BTCUSD;
}

function listDirectAccountCoinJsonFiles($account)
	{
         $CI =& get_instance();
         $arr=array();
         $homePath = getHomePath();
       $sellBotCoinDir = $homePath.getBotCoinsFolderName().'/'.$account.'/';
      //  $coinJsonFileStatusArray = $CI->s3->read($sellBotCoinDir);
		$files = scandir($sellBotCoinDir);
 
		 $fileListClean = Array();
		 foreach($files as $file) {
 		 	if(strpos($file, '.') !== (int) 0) {
		        array_push($fileListClean,$file);
		    }
		}
		
	return $fileListClean;
}


function getCoinPrice($coinSymbol, $prices, $pairSymbol = 'BTC')
{
  $coinPairSymbol = $coinSymbol.$pairSymbol;
  $coinPrice = !empty($prices[$coinPairSymbol]) ? $prices[$coinPairSymbol] : '' ;
  //echo('<hr />'.$dataRow.'<hr />');
  return $coinPrice;
  // return coinPrice;
}


 ##### ADDED BY HANAAN

	function getCoinOwnedTradedStatus($account,$symbol)
	{
		//die('getCoinOwnedAccountList');
		$accountsArray = getApiKeyAccounts();
		$sellCoinSymbol = 'BTC';

		$CI  =& get_instance();

		$api = createBinanceApiObject($account);
		//$bookPriceArray = $api->bookPrices();
		$balances = $api->balances(true);
		
	    $coinHasPrice = array_key_exists($symbol,$balances);
	    if ($coinHasPrice){
			$coinBalanceRec = $balances[$symbol];
			$thisAmountOwned = $coinBalanceRec['available'];
		}else{
			$thisAmountOwned = 0;
		}
			
		$exchangeInfoRaw = $api->exchangeInfo();
		$lotSizeArray = getCoinLotSize($symbol, $sellCoinSymbol,$exchangeInfoRaw);
		$coinDustThreshold = $lotSizeArray['minQty'];
		$isOwned = $thisAmountOwned > $coinDustThreshold;

 		$coinFilePath = 'sell_bot_active_coins/'.$account.'/'.$symbol.'.json'; 
		$coinJsonFileStatusArray = $CI->s3->read($coinFilePath);
		$arr  = '';
		$coinJsonFileContentArray = objToArray(json_decode($coinJsonFileStatusArray) , $arr);
		$tradeStatus_file = 'NULL';
		$coinTraded = 0;
		if (is_array($coinJsonFileContentArray)){
			$jsonValid1 = array_key_exists('status',$coinJsonFileContentArray);
		
			if ($jsonValid1){
				$tradeStatus_file = $coinJsonFileContentArray['status'];
				if ($tradeStatus_file == 'owned' || $tradeStatus_file == 'watched'){
					$coinTraded = 1;
					$tradeStatus = $tradeStatus_file;
				}else{
					$tradeStatus = 'inactive1';
				}
			}else{
				$tradeStatus = 'inactive2';
			}
		}else{
			$tradeStatus = 'inactive3';		
		}
		$selectedCoinTradeStatusResult =Array('isTraded'=>$coinTraded, 'isOwned'=>$isOwned, 'tradeStatus'=>$tradeStatus);

		return $selectedCoinTradeStatusResult; 
	}


	function aggregateStablecoinData($account)
	{
		//die('getCoinOwnedAccountList'); 
		
		$CI  =& get_instance(); 

 		$stablecoinDataFileName = 'stablecoins_pairs.json';
 		//$coinFilePath = 'sell_bot_active_coins/'.$account.'/'.$coinFileName; 
		$stablecoinPairArrayJson = $CI->s3->read($stablecoinDataFileName);
		
		
		$arr = '';
		$stablecoinArray_raw = objToArray(json_decode($stablecoinPairArrayJson) , $arr);
		$stablecoinArray = $stablecoinArray_raw['stablecoins'];
//		$stablecoinArray = $stablecoinArray_raw['stablecoins'][0];
		
//		print_r($stablecoinArray);
		
		$api = createBinanceApiObject($account);
		$balances = $api->balances(true);
		$bookPriceArray = $api->bookPrices();
		
		/*
			"stablecoins": [
		{
			"TUSD": [
				{
					"symbol": "TUSD",
					"pairs": [
						{
							"TUSDUSDT": { "pair": "TUSDUSDT" , "trade_coin": "TUSD" ,  "base_coin": "USDT", "position": "trade"},
							"PAXTUSD": { "pair": "PAXTUSD" , "trade_coin": "PAX" ,  "base_coin": "TUSD", "position": "base"},
							"USDCTUSD": { "pair": "USDCTUSD" , "trade_coin": "USDC" ,  "base_coin": "TUSD" , "position": "base"}
						}
					]	
*/

		$stablecoinPricesFullArray = Array();
//		foreach ($stablecoinArray as $stablecoinRecord){
		foreach ($stablecoinArray as $symbol => $stablecoinRecord_){
			$stablecoinRecord = $stablecoinRecord_[0];
		
			$coinHasPrice = array_key_exists($symbol,$balances);
			if ($coinHasPrice){
				$coinBalanceRec = $balances[$symbol];
				$amountOwned = $coinBalanceRec['available'];
				$name = $stablecoinRecord['name'];
				$logoLinksArray_ = $stablecoinRecord['logos'];
				$logoLinksArray = $logoLinksArray_[0];
				
				$pairsSpecsArray_ = $stablecoinRecord['pairs'];
				$pairsSpecsArray = $pairsSpecsArray_[0];
				
				
				$pairPriceArray = Array();
				
				### If I own Second part of pair (base) I should sell-trade when Price under 0.99
				### If I own First part of pair (trade) I should sell-trade when Price over 1.01
				foreach ($pairsSpecsArray as $pairSpecsRecord){
//					$pairSpecsRecord = $pairSpecsRecord_[0];
					$pair = $pairSpecsRecord['pair'];
					$trade_coin = $pairSpecsRecord['trade_coin'];
					$base_coin = $pairSpecsRecord['base_coin'];
					$pos = $pairSpecsRecord['position'];

					$pairPriceRec = $bookPriceArray[$pair];
					$pairPrice = $pairPriceRec['bid'];
					//array_push($pairPriceArray,Array($pair => $pairPrice));
					$signal = 0;
					if ($pos == 'base'){
						if ($pairPrice < .99){
							$signal = -1;
						}elseif ($pairPrice > 1.01){
							$signal = 1;
						}
					}else{
						if ($pairPrice < .99){
							$signal = 1;
						}elseif ($pairPrice > 1.01){
							$signal = -1;
						}
					}
					$pairPriceArray[] = Array('pair'=>$pair, 'price' => $pairPrice, 'signal'=>$signal);
				}
				$stablecoinPricesFullArray[] = Array('symbol'=>$symbol, 'name'=>$name, 'price_list' => $pairPriceArray, 'balance'=>$amountOwned, 'icon_list'=>$logoLinksArray);
				
				
			}	
		}


		$stablecoinPairArray = $stablecoinArray_raw['stablecoin_pairs'];
				foreach ($stablecoinPairArray as $pairSpecsRecord){
					$pair = $pairSpecsRecord['pair'];
					$pairOpenOrders = $api->openOrders($pair);
					$pairOrders = $api->orders($pair);
					
					/*					echo '<br />OPEN ORDERS: <br />';
					print_r($pairOpenOrders);
					echo '<br />FINISHED ORDERS: <br />';
					print_r($pairOrders);
					echo '<br />';
					*/
					
				}


		return $stablecoinPricesFullArray;
// symbol=>TUSD, balance=>4000, best_trade_gain_percent=>0.12, best_trade_pair=>USDTTUSD, pair_return_array=>Array(Array(USDTTUSD,0.12),Array(USDTPAX,-0.72),Array(USDTTUSD,0.12))

	}


	function aggregateStablecoinData_REVERSE($account)
	{
		//die('getCoinOwnedAccountList');
		$stablecoinPairArray = Array(Array('TUSDUSDT','TUSD','USDT'), Array('PAXUSDT','PAX','USDT'), Array('USDCUSDT','USDC','USDT'), Array('PAXTUSD','PAX','TUSD'), Array('USDCTUSD','USDC','TUSD'), Array('USDCPAX','USDC','PAX'));
		$api = createBinanceApiObject($account);
		$balances = $api->balances(true);

		foreach ($stablecoinPairArray as $stablecoinPairRecord){
			$pair = $stablecoinPairRecord[0];
			$tradeCoinSymbol = $stablecoinPairRecord[1];
			$baseCoinSymbol = $stablecoinPairRecord[2];
			
			$coinHasPrice = array_key_exists($tradeCoinSymbol,$balances);
			if ($coinHasPrice){
				$coinBalanceRec = $balances[$tradeCoinSymbol];
				$thisAmountOwned_tradecoin = $coinBalanceRec['available'];
			}	
			
			
		}

// symbol=>TUSD, balance=>4000, best_trade_gain_percent=>0.12, best_trade_pair=>USDTTUSD, pair_return_array=>Array(Array(USDTTUSD,0.12),Array(USDTPAX,-0.72),Array(USDTTUSD,0.12))

	}
	
	
	function getActiveTradesList($account)
	{
		//die('getCoinOwnedAccountList');
		$accountsArray = getApiKeyAccounts();
		$sellCoinSymbol = 'BTC';
		$activeTradesArray_owned = Array();
		$activeTradesArray_watched = Array();
		$activeTradesArray_standby = Array();


		$coinJsonFileArray = listAccountCoinJsonFiles($account);
		foreach ($coinJsonFileArray as $coinFileName){
		   
			if ($coinFileName != '.json'){
	       
	 			$arr = '';
				$tradeRec = parseTradeJsonFile($coinFileName,null,$account,$sellCoinSymbol);
						//print_r($tradeRec);
				if ($tradeRec != null){
					$status = $tradeRec['status'];	
					$symbol = $tradeRec['symbol'];	
					if ($status == 'standby'){
						array_push($activeTradesArray_standby,$tradeRec);
					}elseif ($status == 'watched'){
						array_push($activeTradesArray_watched,$tradeRec);
					}elseif ($status == 'owned'){
						array_push($activeTradesArray_owned,$tradeRec);					
					}
				
				}
			}
		}	

		usort($activeTradesArray_standby, 'sortByOrder');
		usort($activeTradesArray_watched, 'sortByOrder');
		usort($activeTradesArray_owned, 'sortByOrder');
		
		$activeTradesArray = array_merge($activeTradesArray_owned,$activeTradesArray_watched,$activeTradesArray_standby);
				
		return $activeTradesArray;
	}

 ##### ADDED BY HANAAN
	function parseTradeJsonFile($coinFileName,$symbol,$account,$sellCoinSymbol)
	{
	  $CI  =& get_instance();

		$api = createBinanceApiObject($account);
		$bookPriceArray = $api->bookPrices();
		$exchangeInfoRaw = $api->exchangeInfo();

		if ($coinFileName==null || $coinFileName==''){
			$coinFileName = $symbol.'.json';
		}

 		$coinFilePath = 'sell_bot_active_coins/'.$account.'/'.$coinFileName; 
		$coinJsonFileStatusArray = $CI->s3->read($coinFilePath);
		$arr  = '';
		$coinJsonFileContentArray = objToArray(json_decode($coinJsonFileStatusArray) , $arr);
		
		$totalCost = 0;
		$totalReturn = 0;
		$totalTrades = 0;
		$tradeTime = 0;
		$thisActiveTradeRecord = null;

	    $jsonValid1 = array_key_exists('status',$coinJsonFileContentArray);

		
		if ($jsonValid1){
		
			$status = $coinJsonFileContentArray['status'];
			$symbol = $coinJsonFileContentArray['symbol'];
			$bnbPrice = $bookPriceArray['BNB'.$sellCoinSymbol]['bid'];

			$validTrade = ($status != 'inactive' && $status != 'delisted' && $symbol != null);
		
			if (!$validTrade){
		
				return null;
			
			}else{
				$isArmed = getValueFromArrayIfKeyExists('is_armed',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['is_armed'];
				$isRebuy = getValueFromArrayIfKeyExists('is_rebuy',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['is_rebuy'];

				$tradeQuantity = getValueFromArrayIfKeyExists('qty',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['qty'];
                
				$first_buy_price = getValueFromArrayIfKeyExists('first_buy_price',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['first_buy_price'];
				$this_buy_price = getValueFromArrayIfKeyExists('this_buy_price',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['this_buy_price']; 

				$initial_standby_price = getValueFromArrayIfKeyExists('initial_standby_price',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['this_buy_price']; 
				
				$high_price = getValueFromArrayIfKeyExists('high_price',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['high_price'];
				$low_price = getValueFromArrayIfKeyExists('low_price',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['low_price'];
				$sold_price = getValueFromArrayIfKeyExists('this_sold_price',$coinJsonFileContentArray,0);//$coinJsonFileContentArray['this_sold_price'];
 
			    $hasPrice = array_key_exists($symbol.$sellCoinSymbol,$bookPriceArray);

				$tradeInitializationTimestamp = getValueFromArrayIfKeyExists('timestamp',$coinJsonFileContentArray,0);
				
				$completeTradeTimeInSeconds = time() - strtotime($tradeInitializationTimestamp);
				
				
				if ($hasPrice){
					$bookPriceRec = $bookPriceArray[$symbol.$sellCoinSymbol];
					$currentBidPrice = $bookPriceRec['bid'];
				}else{
					$currentBidPrice = 0;
				}

				if($isArmed){$armedStr='armed-';}else{$armedStr='';}
				if($isRebuy){$rebuyStr='rebuy-';}else{$rebuyStr='';}

			    $hasTradesObject = array_key_exists('trades',$coinJsonFileContentArray);
			    if ($hasTradesObject){
					$tradesArray = $coinJsonFileContentArray['trades'];
				}else{
					//return null;
					$tradesArray = Array();
				}
				
			    //if ($tradesArray == Array()){
				//	return null;
				//}

				$cleanTradesArray = Array();
				$totalCost_gains = 0;
				$totalCost_losses = 0;
				$totalReturn_gains = 0;
				$totalReturn_losses = 0;
				$countTrades_gains = 0;
				$countTrades_losses = 0;
				$standby_change = 0;
				$averageTradeReturn_gain = 0;
				$averageTradeReturn_losses = 0; 
				$sellType = null;
				
				if ($status == 'standby'){
					if($initial_standby_price > 0 && $currentBidPrice > 0){
						$standby_change = pct_Chg_Log($currentBidPrice,$initial_standby_price,0);
					}else{
						$standby_change = 0;
					}
					$sort_value = $standby_change;
				
    			}else{

					foreach($tradesArray as $tradeNumberStr => $tradeRec){

						//Array ( [bot_buy] => 1 [bot_sell] => 1 [sell_type] => gain [buy_trade] => Array ( [symbol] => VIBBTC [orderId] => 26365492 [clientOrderId] => SYIhwRC46PEABypSmC2WQ7 [transactTime] => 1547482872431 [price] => 0.00000000 [origQty] => 1159.00000000 [executedQty] => 1159.00000000 [cummulativeQuoteQty] => 0.00725534 [status] => FILLED [timeInForce] => GTC [type] => MARKET [side] => BUY [fills] => Array ( [0] => Array ( [price] => 0.00000626 [qty] => 1159.00000000 [commission] => 0.00333054 [commissionAsset] => BNB [tradeId] => 3666179 ) ) ) [sell_trade] => Array ( [symbol] => VIBBTC [orderId] => 26367369 [clientOrderId] => EEKiqskhfTxN38vcZeTIPB [transactTime] => 1547484133099 [price] => 0.00000000 [origQty] => 1159.00000000 [executedQty] => 1159.00000000 [cummulativeQuoteQty] => 0.00731329 [status] => FILLED [timeInForce] => GTC [type] => MARKET [side] => SELL [fills] => Array ( [0] => Array ( [price] => 0.00000631 [qty] => 1159.00000000 [commission] => 0.00337073 [commissionAsset] => BNB [tradeId] => 3666455 ) ) ) ) 
	
						$sellType = getValueFromArrayIfKeyExists('sell_type',$tradeRec,'');
						$buyTradeRec = getValueFromArrayIfKeyExists('buy_trade',$tradeRec,null);//$tradeRec['buy_trade'];
						if ($buyTradeRec!= null){
							$buyProperties = parseOrderFills($buyTradeRec['fills'],$bnbPrice); //($price,$qty,$commission)
							$buyTime = round($buyTradeRec['transactTime']/1000,0);
							$buyPrice = $buyProperties['price'];
							$buyQty = $buyProperties['qty'];
							$buyCost = $buyProperties['cost'];
							$buyCommission = $buyProperties['commission'];
						}else{
							$buyProperties = null;
							$buyCommission = 0;
							$buyCost = 0;
							$buyTime = 0;
						}
						$sellTradeRec = $tradeRec['sell_trade'];
	
						if($sellTradeRec != null){
							$tradeConcludedWithSale = 1;
	
							$sellTradeFills = $sellTradeRec['fills'];
							$sellProperties = parseOrderFills($sellTradeFills,$bnbPrice); //($price,$qty,$commission)
							$sellTime = round($sellTradeRec['transactTime']/1000,0);
							$sellPrice = $sellProperties['price'];
							$sellQty = $sellProperties['qty'];
							$sellCost = $sellProperties['cost'];
							$sellCommission = $sellProperties['commission'];
	
							$totalCommission = $buyCommission + $sellCommission;
							$totalCostNet = $sellCost - $buyCost - $totalCommission;
							if ($sellCost==0 || $sellCost==null || $buyCost==0 || $buyCost==null){
								$return = 0;
								$returnGross = 0;
							}else{
						
								$return = pct_Chg_Log($buyCost + $totalCommission,$sellCost,0);
								$returnGross = pct_Chg_Log($buyCost,$sellCost,0);
							}

							$returnFormat = number_format(round($return,2),2).'%';
							$returnGrossFormat = number_format(round($returnGross,2),2).'%';
	
	
							if($return < 0)
							{
								$totalCost_losses += $totalCostNet;//$totalReturnNet;
								$totalReturn_losses += $return;
								$countTrades_losses += 1;
		
							}else{
	
								$totalCost_gains += $totalCostNet;//$totalReturnNet;
								$totalReturn_gains += $return;
								$countTrades_gains += 1;
	
							}
							$totalCost = $totalCost_losses + $totalCost_gains;
							$totalReturn = $totalReturn_losses + $totalReturn_gains;
							$totalTrades = $countTrades_losses + $countTrades_gains;
							$tradeTime = $sellTime - $buyTime;
						}else{
							$tradeConcludedWithSale = 0;
							$sellProperties = null;
							$totalCommission = 0;
							$totalCostNet = 0;

							$return = 0;
							$returnGross = 0;
							$tradeTime = time() - $buyTime;
						}
						if ($tradeConcludedWithSale == 1){
							$thisCleanTradeRecord = Array('sellType'=>$sellType,'tradeTime'=>$tradeTime,'buyTime'=>$buyTime,'sellTime'=>$sellTime,'buyRec'=>$buyProperties,'sellRec'=>$sellProperties,'commission'=>$totalCommission,'netCost'=>$totalCostNet,'netReturn'=>$return);
							array_unshift($cleanTradesArray,$thisCleanTradeRecord);
						}else{	
							$thisActiveTradeRecord = Array('tradeTime'=>$tradeTime,'buyRec'=>$buyProperties);
							
							$activeTradeBuy_price = $buyProperties['price'];
							
							$pctChg_thisTrade = ((($currentBidPrice - $activeTradeBuy_price) / $activeTradeBuy_price) * 100); 
							$sort_value = $pctChg_thisTrade;
						}
	
					}

					if ($countTrades_gains > 0){
						$averageTradeReturn_gain = $totalReturn_gains/$countTrades_gains;
					}else{
						$averageTradeReturn_gain = 0;
					}
					if ($countTrades_losses > 0){
						$averageTradeReturn_losses = $totalReturn_losses/$countTrades_losses;
					}else{
						$averageTradeReturn_losses = 0;
					}

				if ($status == 'watched'){
					$sort_value = $totalReturn;
				}

				}
				$result = Array('symbol'=>$symbol,'qty'=>$tradeQuantity,'status'=>$status,'complete_time_in_seconds'=>$completeTradeTimeInSeconds,'isArmed'=>$isArmed,'price'=>$currentBidPrice,'totalCost'=>$totalCost,'totalReturn'=>$totalReturn,'totalTrades'=>$totalTrades,'totalReturn_losses'=>$totalReturn_losses,'totalReturn_gains'=>$totalReturn_gains,'countTrades_losses'=>$countTrades_losses,'countTrades_gains'=>$countTrades_gains,'tradesArray'=>$cleanTradesArray,'averageTradeReturn_gain'=>$averageTradeReturn_gain,'averageTradeReturn_losses'=>$averageTradeReturn_losses,'thisActiveTradeRecord'=>$thisActiveTradeRecord, 'standby_change'=> $standby_change, 'sort_value'=>$sort_value);
				return $result;
			}
		}
	}

	function getValueFromArrayIfKeyExists($theKey,$theArray,$altValue)
	{
		if(array_key_exists($theKey,$theArray))
		{
			return $theArray[$theKey];
		}else{
			return $altValue;
		}
	}
	
	
	function parseOrderFills($fillsRec,$bnbPrice){
		 ##### ADDED BY HANAAN
		$cost = 0;
		$qty = 0;
		$commission = 0;
		foreach($fillsRec as $tradeFillRec){
			$thisQty = $tradeFillRec['qty'];
			$thisPrice = $tradeFillRec['price'];
			$thisCommission = $tradeFillRec['commission'];
			$thisCommissionAsset = $tradeFillRec['commissionAsset'];
			$thisCost = $thisQty * $thisPrice;
			if ($thisCommissionAsset == 'BNB'){
				$thisCommission = $thisCommission * $bnbPrice;
			}
			$cost += $thisCost;
			$qty += $thisQty;
			$commission += $thisCommission;
		
		}		
		    if($qty){
              $price = $cost / $qty; 
		     }
		$price= isset($price)?$price:'';
        
		$result = Array('price'=>$price,'qty'=>$qty,'commission'=>$commission, 'cost'=>$cost);
		return $result;
	}
	
	
function getBalanceArray($accountFromForm,$balances,$prices)
{
  $balanceArray = Array();
  $balanceChartValue = Array();
  $balanceChartLabels = Array();
  $coinSymbolArray = Array();

  $balanceTotal = 0; 
  $balanceBitcoinTotal = 0; 
  $balanceAltcoinTotal = 0; 
  $balanceCashTotal = 0; 
  
  $BTCUSD = getbtcusd();
 
  # Add up BTC balances
  
  foreach($balances as $coinSymbol => $balance){
  
    $coinSymbolArray[] = $coinSymbol;
    
    $thisAmountOwned = $balance['available'];
    $onOrder = $balance['onOrder'];
  
    if ($coinSymbol == 'BTC'){
      $amountInBtc = $thisAmountOwned + $onOrder;
      $balanceBitcoinTotal = $amountInBtc; 
    }else{
      if ($coinSymbol == 'USDT'){
        $amountInBtc = $thisAmountOwned  / $BTCUSD;
      }else{

        $thisBalance = getCoinPrice($coinSymbol, $prices);
        $amountInBtc = $thisBalance * ($thisAmountOwned + $onOrder) ;//+ $onOrder;;
      }
      if ($coinSymbol == 'TUSD'){
        $balanceCashTotal += $amountInBtc; 
      // echo $coinSymbol.' - '.$amountInBtc;
      }else{
        $balanceAltcoinTotal += $amountInBtc; 
      }
    }
    $balanceTotal = $balanceTotal + $amountInBtc;
    $thisBalance = Array('coin'=>$coinSymbol,'position'=>$amountInBtc);
    if($amountInBtc > 0){
      array_push($balanceArray, $thisBalance);
      array_push($balanceChartValue, $amountInBtc);
      array_push($balanceChartLabels, $coinSymbol);
    }
  }

  $resultArray = Array($balanceArray,$balanceChartValue,$balanceChartLabels,$balanceTotal,$balanceBitcoinTotal,$balanceAltcoinTotal,$balanceCashTotal);
  return $resultArray;
}

function getBinanceCoinBalance($balances,$coinSymbol)
{
  $thisCoinBalance = $balances[$coinSymbol]; 
  $owned = $thisCoinBalance['available'];
  return $owned;
}

function normalizeBinanceTradeAmount($symbol,$sellCoinSymbol,$qty,$api)
{
  if ($qty > 0) {
    $exchangeInfoRaw = $api->exchangeInfo();
    $lotSizeArray = getCoinLotSize($symbol, $sellCoinSymbol,$exchangeInfoRaw);
    $stepSize = $lotSizeArray['stepSize'];

    $result = $qty / $stepSize;

    $result = round($result);

    $normalizedQty = $result * $stepSize;
  } else {
    $normalizedQty = $qty;
  }
  return $normalizedQty;
}


function getCoinLotSize($symbol, $sellCoin, $exchangeInfoRaw){
  $exchangeInfo = $exchangeInfoRaw['symbols'];

  $pairExchangeInfo = getPairExchangeInfo($symbol, $sellCoin, $exchangeInfo);
  
  if ($pairExchangeInfo != null){
    $hasFilters = array_key_exists('filters',$pairExchangeInfo);
    if ($hasFilters){
      $filtersInfo = $pairExchangeInfo['filters'];
      $lotSize = getLotSizeInfo($filtersInfo);
    }else{
      $lotSize = null;
    }
  }else{
    $lotSize = null;
  }
  
  return $lotSize;
}

function getPairExchangeInfo($symbol, $sellCoin, $exchangeInfo) {
   foreach ($exchangeInfo as $key => $val) {
       if ($val['symbol'] === $symbol.$sellCoin) {
           return $val;
       }
   }
   return null;
}

  
function getLotSizeInfo($filtersInfo) {
   foreach ($filtersInfo as $key => $val) {
       if ($val['filterType'] === 'LOT_SIZE') {
           return $val;
       }
   }
   return null;
}

function auto_version($file='')
{
    if(!file_exists($file))
        return $file;
 
    $mtime = filemtime($file);
    return $file.'?'.$mtime;
}

function formatTradeTime($t)
{


// 1250


	$tMin = $t/60;
	$tHrs = $tMin/60;
	$tHrs_flr = floor($tHrs);
	$tDays = $tHrs/24;
	$tDays_flr = floor($tDays);
	if($tMin < 120){
		$tStr = round($tMin,0).'m';
	}elseif($tHrs < 40){
	
		$minAfter = round($tMin,0) - (floor($tHrs) * 60);
		$tStr = round($tHrs,0).'h'.round($minAfter,0).'m';
	}else{
		$hrsAfter = round($tHrs,0) - (floor($tDays) * 24);
		$tStr = round($tDays,0).'d'.round($hrsAfter,0).'h';
	}
	return $tStr;
}
 

function getBotStatusForCoin($account,$coinFileName,$bookPriceArray,$sellCoinSymbol){
  $CI  =& get_instance();

  $result = '';
  
  $props = getSellBotParameters();
  
  $resultArray = array();
  

  // echo "<pre>";
  //   print_r($props);
  // exit;

  $ArmPct = $props['ArmPct'];//2;//4; // Percent price rise from bought price
  $trailPct = $props['trailPct'];// 20;// How much of the profit are we willing to lose
  $stoplossPct = $props['stoplossPct'];// -20;// Percent drop before sale for loss.
  $rebuyShortLeashRatio = $props['rebuyShortLeashRatio'];// 0.5; // arm% and trail% get reduced Rebuy
  $btcBalanceThreshold = $props['btcBalanceThreshold'];// 0.005; // ignore balances below that
  $ignoreSymbolArray = $props['ignoreSymbolArray'];// Array('BTC', 'BNB', 'TUSD', 'USDT', 'EOS', null);


  //$homePath = getHomePath();
 $coinFilePath = 'sell_bot_active_coins/'.$account.'/'.$coinFileName; 
  $coinJsonFileStatusArray = $CI->s3->read($coinFilePath);
  //$coinJsonFileThere = $coinJsonFileStatusArray[0];
 // print_r($coinJsonFileStatusArray);
  if($coinJsonFileStatusArray) {
  $arr  = '';
  $coinJsonFileContentArray = objToArray(json_decode($coinJsonFileStatusArray) , $arr);
  
  //~ echo "<pre>";
	//~ print_r($coinJsonFileContentArray);
	//~ echo "last";
	//~ exit;
	
  //~ echo "this way";
  //~ print_r($coinFilePath); die('dd');
 
  $status = isset($coinJsonFileContentArray['status'])?$coinJsonFileContentArray['status']:'';
  $symbol = isset($coinJsonFileContentArray['symbol'])?$coinJsonFileContentArray['symbol']:'';
  
  $isArmed = isset($coinJsonFileContentArray['is_armed'])?$coinJsonFileContentArray['is_armed']:'';
  $isRebuy = isset($coinJsonFileContentArray['is_rebuy'])?$coinJsonFileContentArray['is_rebuy']:'';
  $isTest = isset($coinJsonFileContentArray['is_test'])?$coinJsonFileContentArray['is_test']:'';

  $first_buy_price = isset($coinJsonFileContentArray['first_buy_price'])?$coinJsonFileContentArray['first_buy_price']:'';
  $this_buy_price = isset($coinJsonFileContentArray['this_buy_price'])?$coinJsonFileContentArray['this_buy_price']:''; // If rebuy, this-buy-price is the price of the rebuy
  $this_sold_price = isset($coinJsonFileContentArray['this_sold_price'])?$coinJsonFileContentArray['this_sold_price']: '';
  $high_price = isset($coinJsonFileContentArray['high_price'])?$coinJsonFileContentArray['high_price']:'';
  $low_price = isset($coinJsonFileContentArray['low_price'])?$coinJsonFileContentArray['low_price']:'';

  $qty = isset($coinJsonFileContentArray['qty'])?$coinJsonFileContentArray['qty']:'';
  $time = isset($coinJsonFileContentArray['time'])?$coinJsonFileContentArray['time']:'';

  //print_r($coinJsonFileContentArray);//$symbol.$sellCoinSymbol);//$bookPriceRec);
  if ($symbol == 'TEST'){
    $currentBidPrice = getTestPrice();  
  }else{
	 //~ echo $symbol.'ss';
	 //~ echo $sellCoinSymbol;
	// print_r($bookPriceArray);
    $bookPriceRec = $bookPriceArray[$symbol.$sellCoinSymbol];
   //~ print_r($bookPriceRec);
    $currentBidPrice = $bookPriceRec['bid'];
  }

  if ($this_buy_price > 0 && $currentBidPrice > 0){
    $changePct = (($currentBidPrice - $this_buy_price) / $this_buy_price) * 100;
    if ($changePct>0){    
      $changePctFormat = '+'.number_format(round($changePct,2),2).'%';
    }else{
      $changePctFormat = number_format(round($changePct,2),2).'%';
    }
  }else{
    $changePct = 0;
    $changePctFormat = '-';
  }

  if ($first_buy_price > 0 && $this_sold_price > 0){
    $changePctLocked = (($this_sold_price - $first_buy_price) / $first_buy_price) * 100;
    if ($changePctLocked>0){    
      $changePctLockedFormat = '+'.number_format(round($changePctLocked,2),2).'%';
    }else{
      $changePctLockedFormat = number_format(round($changePctLocked,2),2).'%';
    }
  }else{
    $changePctLocked = 0;
    $changePctLockedFormat = '';
  }

  if ($this_buy_price > 0 && $this_sold_price > 0){
    $profitPct = (($this_sold_price - $this_buy_price) / $this_buy_price) * 100;
    if ($profitPct>0){    
      $profitPctFormat = '+'.number_format(round($profitPct,2),2).'%';
    }else{
      $profitPctFormat = number_format(round($profitPct,2),2).'%';
    }
  }else{
    $profitPct = 0; 
    $profitPctFormat = '-' ;
  }

  if ($high_price > 0 && $this_buy_price > 0){
    $changePctFromHigh = (($high_price - $this_buy_price) / $this_buy_price) * 100;
    if ($changePctFromHigh>0){    
      $changePctFromHighFormat = '+'.number_format(round($changePctFromHigh,2),2).'%';
    }else{
      $changePctFromHighFormat = number_format(round($changePctFromHigh,2),2).'%';
    }
  }else{
    $changePctFromHigh = 0;
    $changePctFromHighFormat = '-' ;
  }

  if ($low_price > 0 && $this_buy_price > 0){
    $changePctFromLow = (($low_price - $this_buy_price) / $this_buy_price) * 100;
    if ($changePctFromLow>0){   
      $changePctFromLowFormat = '+'.number_format(round($changePctFromLow,2),2).'%';
    }else{
      $changePctFromLowFormat = number_format(round($changePctFromLow,2),2).'%';
    }
  }else{
    $changePctFromLow = 0;
    $changePctFromLowFormat = '-' ;
  }

  $resultArray = Array('symbol'=>$symbol,'time'=>$time,'status'=>$status,'isArmed'=>$isArmed,'isRebuy'=>$isRebuy,'isTest'=>$isTest,'qty'=>$qty, 'first_buy_price'=>$first_buy_price, 'this_buy_price'=>$this_buy_price,'currentBidPrice'=>$currentBidPrice,'high_price'=>$high_price,'low_price'=>$low_price, 'changePct'=>$changePctFormat, 'changePctVal'=>$changePct, 'changePctFromHigh'=>$changePctFromHighFormat, 'changePctFromLow'=>$changePctFromLowFormat, 'this_sold_price'=>$this_sold_price, 'profitPct'=>$profitPctFormat,'profitPctLocked'=>$changePctLockedFormat);

  if ($symbol != '' && $status != 'inactive' && $status != 'delisted'){ 

    $result .= '<p>'.$symbol.' - '.$status.' - Armed: '.$isArmed.' - Rebuy: '.$isRebuy.'<br />Price start: '.$first_buy_price.'<br />Now: '.$currentBidPrice.'<br />Chg: '.$changePctFormat.'<br />Price High: '.$high_price.'</p>';
    if($isArmed){$armedStr='armed-';}else{$armedStr='';}
    if($isRebuy){$rebuyStr='rebuy-';}else{$rebuyStr='';}
    if ($status == 'owned'){



      if ($isArmed == 1){
        if ($currentBidPrice > $high_price){
          // Enter new_high
          $coinJsonFileContentArray['high_price'] = $currentBidPrice;
          $result .= '<p>Higher price found - Bid: '.$currentBidPrice.' Hi: '.$high_price.'</p>';
                    
        }else{
          // Oh no! Price started to drop.
          $topPriceIncrease = $high_price - $this_buy_price;
          $thisPriceIncrease = $currentBidPrice - $this_buy_price;
          $result .= '<p> - CHG:'.number_format(round($thisPriceIncrease,8),8).'-TOPCHG:'.number_format(round($topPriceIncrease,8),8).'</p>';
          $pctOfProfitGivenBack = (($topPriceIncrease - $thisPriceIncrease) / $thisPriceIncrease) * 100; 
          $pctOfProfitGivenBackFormat = number_format(round($pctOfProfitGivenBack,2),2).'%';
          $result .= '<p>GIVEN BACK:'.$pctOfProfitGivenBackFormat.'</p>';
          if ($isRebuy){
            $trailPct_actual = $trailPct * $rebuyShortLeashRatio;
          }else{
            $trailPct_actual = $trailPct;
          }
          if ($pctOfProfitGivenBack > $trailPct_actual){
            $coinJsonFileContentArray['this_sold_price'] = $currentBidPrice;
            $coinJsonFileContentArray['status'] = 'watched';
            $coinJsonFileContentArray['is_armed'] = 0; 
            //createCoinJsonFile($account,$symbol,$coinJsonFileContentArray);
            // SELL FOR PROFITS!!!!!

            //$tradeResultFills = $tradeResult['fills'];
          
          
          }elseif ($currentBidPrice < $this_buy_price){
            $result .= '<p>Price lower... - Bid: '.$currentBidPrice.' Hi: '.$high_price.'</p>';
          }else{
            $result .= '<p>Price not high enough - Bid: '.$currentBidPrice.' Hi: '.$high_price.'</p>';
                        
          }
        }
    
    
      }else{ // not armed yet...

        if ($changePct > $ArmPct){
          $result .= '<p>Arming coin now</p>';
          $coinJsonFileContentArray['is_armed'] = 1;
          $coinJsonFileContentArray['high_price'] = $currentBidPrice;

        
        }elseif ($isRebuy == 0 && $changePct < $stoplossPct){
          $result .= '<p>Selling at loss :(</p>';
          //SELL NOW!!
        
        }elseif ($isRebuy == 1 && $currentBidPrice < $this_buy_price){
          $result .= '<p>Selling rebuy at loss :(</p>';
          //SELL NOW!!
          $result .= '<p>Dumping REBUY at no profit - Bid: '.$currentBidPrice.' - Bought at: '.$this_buy_price.'</p>';
        
        }elseif ($currentBidPrice > $high_price){
          // Enter new_high

          $result .= '<p>Record new high - Bid: '.$currentBidPrice.'</p>';

        }
      }
  
    }elseif ($status == 'watched'){
          //echo '|opt-w';
      $soldPrice = $coinJsonFileContentArray['this_sold_price'];
      $changePct = (($currentBidPrice - $soldPrice) / $soldPrice) * 100;
      $changePctFormat = number_format(round($changePct,2),2).'%';

      $result .= '<p>WATCHED - Bid: '.$currentBidPrice.' - Sold at: '.$soldPrice.' - Chg: '.$changePctFormat.'</p>';

      if ($currentBidPrice < $soldPrice){
      }elseif($changePct > ($ArmPct * $rebuyShortLeashRatio)){
        //echo ' | Arming coin now';
        $coinJsonFileContentArray['is_armed'] = 1;
        $coinJsonFileContentArray['high_price'] = $currentBidPrice;
      }
    }
  }else{  
    $result .= '';
  }
} else {
	$result .= '';
}
  $r = Array($resultArray,$result);
  return $r;
}

function getSellBotParameters(){
  $ArmPct = 2;//4; // Percent price rise from bought price
  $trailPct = 20;// How much of the profit are we willing to lose
  $stoplossPct = -20;// Percent drop before sale for loss.
  $rebuyShortLeashRatio = 0.35; // arm% and trail% get reduced Rebuy
  $btcBalanceThreshold = 0.005; // ignore balances below that

  $ignoreSymbolArray = Array('BTC', 'BNB', 'TUSD', 'USDT','PAX','USDC', null);
  $result = Array('ArmPct'=>$ArmPct,'trailPct'=>$trailPct,'stoplossPct'=>$stoplossPct,'rebuyShortLeashRatio'=>$rebuyShortLeashRatio,'btcBalanceThreshold'=>$btcBalanceThreshold,'ignoreSymbolArray'=>$ignoreSymbolArray);
  return $result;
}

function getTestPrice()
{
  //$homePath = getHomePath();
  $CI =& get_instance();
  $jsonFileArray = $CI->s3->read('testcoin.json');
  $jsonFileArray = objToArray(json_decode($jsonFileArray) , $arr);
  //$jsonFileThere = $jsonFileArray[0];
  $jsonFileContentArray = $jsonFileArray;
  $price = $jsonFileContentArray['price'];
  
  return $price;

}

function getHomePath()
	{
        $file = getenv("HOME") . "/home/thesunn6/.config/binance/";
        return $file;
	}
	
function pct_Chg_Log($start,$end,$log)
{

	if($start == 0 || $end ==0){
		echo '<p> ••• '.$log.' • START: '.$start.' • END: '.$end.' ••• </p>'; 
	}
	$pctChg = round(((($end - $start) / $start) * 100) , 2); 
	return $pctChg;
}	
	
	
function readConfigFile()
	{
        $file = "php-binance-api.json";
        //$file = getenv("HOME") . "/home/thesunn6/.config/binance/php-binance-api.json";
        $contents = json_decode(file_get_contents($file), true);
        return $contents;
	}
	
function readJsonFile($filePath)
{
   $fileArray=array();
	$fileThere = file_exists($filePath);
	if($fileThere){
		$jsonString = file_get_contents($filePath);
		$fileArray = json_decode($jsonString, true);		
	}
	return Array($fileThere,$fileArray);
}	
	
	
function getTestQuantity()
{
	$homePath = getHomePath();
	$jsonFileArray = readJsonFile($homePath.'testcoin.json');
	$jsonFileThere = $jsonFileArray[0];
	$jsonFileContentArray = $jsonFileArray[1];
	$qty = isset($jsonFileContentArray['qty'])?$jsonFileContentArray['qty']:'';
	if ($qty > 0){
		$qty = $qty;
	}else{
		$qty = 0;
	}
	
	return $qty;

}	


function createFinalTradeJsonFile($account,$coinSymbol,$coinInfoArray)
	{
		$CI =& get_instance();
		$ts_filename = date("Y-m-d h-i-s",time());
        $sellBotCoinFile = getBotCompletedTradesFolderName().'/'.$account.'/'.$ts_filename.'_'.$coinSymbol.'.json';
		
		$jsonData = json_encode($coinInfoArray);

		## HANAAN debug
		## DOUBLE-ENCODE JSON
		$writeRes = $CI->s3->write($sellBotCoinFile,$jsonData);
		//$writeRes = $CI->s3->write($sellBotCoinFile,json_encode($jsonData));
		## HANAAN debug
		
	}
		
	
	
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}	


function   btsusdChangeResponder()
{

	$url = 'https://api.coindesk.com/v1/bpi/currentprice.json';
	$json = file_get_contents($url);
	$data = json_decode($json, TRUE);
	
	$timeStr = $data['time']['updatedISO'];
	$btcusd = $data['bpi']['USD']['rate'];
	$btcusd =  (float) str_replace(',', '', $btcusd);
	$time_ = strtotime($timeStr);

	$time_1 = $time_ - 60;
	$time_2 = $time_ - (60 * 2);
	$time_5 = $time_ - (60 * 5);
	$time_10 = $time_ - (60 * 10);
	$time_15 = $time_ - (60 * 15);
	
	
	$haveProperBtcusdData = true;
	
	$btcusd_file_minago = date('H_i_s',$time_1);
	$dateForFolder_minago = date('Y_m_d',$time_1);

	$r = readBtcusdData($dateForFolder_minago,$btcusd_file_minago);
	
	$hasPrice = $r[0];
	$priceRec = $r[1];
	if ($hasPrice){
		$btcusd_minago = (float) str_replace(',', '', $priceRec['btcusd']);
		$changePct_minago = pct_Chg_Log($btcusd,$btcusd_minago,1);
	}else{
		$haveProperBtcusdData = false;
	}

	$btcusd_file_twominago = date('H_i_s',$time_2);
	$dateForFolder_twominago = date('Y_m_d',$time_2);
	$r = readBtcusdData($dateForFolder_twominago,$btcusd_file_twominago);
	$hasPrice = $r[0];
	$priceRec = $r[1];
	if ($hasPrice){
		$btcusd_twominago =  (float) str_replace(',', '', $priceRec['btcusd']);
		$changePct_twominago = pct_Chg_Log($btcusd,$btcusd_twominago,2);
	}else{
		$haveProperBtcusdData = false;
	}

	
	$btcusd_file_fiveminago = date('H_i_s',$time_5);
	$dateForFolder_fiveminago = date('Y_m_d',$time_5);
	$r = readBtcusdData($dateForFolder_fiveminago,$btcusd_file_fiveminago);
	
	$hasPrice = $r[0];
	$priceRec = $r[1];
	if ($hasPrice){
		$btcusd_fiveminago = (float) str_replace(',', '', $priceRec['btcusd']);
		$changePct_fiveminago = pct_Chg_Log($btcusd,$btcusd_fiveminago,3);
	}else{
		$haveProperBtcusdData = false;
	}
	
	$btcusd_file_tenminago = date('H_i_s',$time_10);
	$dateForFolder_tenminago = date('Y_m_d',$time_10);
	$r = readBtcusdData($dateForFolder_tenminago,$btcusd_file_tenminago);
	$hasPrice = $r[0];
	$priceRec = $r[1];
	if ($hasPrice){
		$btcusd_tenminago = (float) str_replace(',', '', $priceRec['btcusd']);
		$changePct_tenminago = pct_Chg_Log($btcusd,$btcusd_tenminago,4);
	}else{
		$haveProperBtcusdData = false;
	}
	
	$btcusd_file_fifteenminago = date('H_i_s',$time_15);
	$dateForFolder_fifteenminago = date('Y_m_d',$time_15);
	$r = readBtcusdData($dateForFolder_fifteenminago,$btcusd_file_fifteenminago);
	$hasPrice = $r[0];
	$priceRec = $r[1];
	if ($hasPrice){
		$btcusd_fifteenminago = (float) str_replace(',', '', $priceRec['btcusd']);
		$changePct_fifteenminago = pct_Chg_Log($btcusd,$btcusd_fifteenminago,5);
	}else{
		$haveProperBtcusdData = false;
	}


	$r = Array('btcusdDataOk'=>$haveProperBtcusdData, '1min'=>isset($changePct_minago)?$changePct_minago:'','2min'=>isset($changePct_twominago)?$changePct_twominago:'','5min'=>isset($changePct_fiveminago)?$changePct_fiveminago:'','10min'=>isset($changePct_tenminago)?$changePct_tenminago:'','15min'=>isset($changePct_fifteenminago)?$changePct_fifteenminago:'');

	return $r;
}


function display_btsusdChange($btcUsdChangeArray){
	if ($btcUsdChangeArray['btcusdDataOk']){
		echo '<p>';
		echo 'One Minute Change: '. number_format($btcUsdChangeArray['1min'],2).'%'.'<br />';
		echo 'Two Minute Change: '. number_format($btcUsdChangeArray['2min'],2).'%'.'<br />';
		echo 'Five Minute Change: '. number_format($btcUsdChangeArray['5min'],2).'%'.'<br />';
		echo 'Ten Minute Change: '. number_format($btcUsdChangeArray['10min'],2).'%'.'<br />';
		echo 'Fifteen Minute Change: '. number_format($btcUsdChangeArray['15min'],2).'%'.'</p>';
	}else{
		echo '<p>No <strong>BTCUSD</strong>Change Data</p>';
	} 
}

function readBtcusdData($folderName,$fileName)
	{
		  $filePath='btcusd'.'/'.$folderName.'/'.$fileName.'.json';
           $arr='';
          $CI  =& get_instance();
         $jsonFilePath= $CI->s3->read($filePath);
        $fileThere = objToArray(json_decode($jsonFilePath) , $arr);
		//$fileThere = file_exists($jsonFilePath);
	
	
		return $fileThere;
	
	}
	
function checkCoinJsonFile($account,$coinSymbol)
	{
        //$homePath = getHomePath();
        $CI  =& get_instance();
        $arr='';
        $sellBotCoinFile = getBotCoinsFolderName().'/'.$account.'/'.$coinSymbol.'.json';
        $coinJsonFileStatusArray = $CI->s3->read($sellBotCoinFile); 
	   $fileThere = objToArray(json_decode($coinJsonFileStatusArray) , $arr);
		
		return $fileThere;
		
	}
	
	
function getCombinedTradeDetail($account,$symbol,$api)
{

	if ($symbol == 'TEST'){
 
		$id = '99999999';
		$tradeCount = 1;
		$avgPrice = getTestPrice();
		$tradeQuantity = getTestQuantity();
		$totalTradePaidBtc = $price * $qty;

	
		$result = Array('id'=>$id,'first_buy_price'=>$avgPrice,'this_buy_price'=>$avgPrice,'high_price'=>$avgPrice,'first_buy_cost'=>$totalTradePaidBtc,'qty'=>$tradeQuantity,'time'=>$tradeDate,'this_sold_price'=>0);
	
	
	}else{
		// NOT A TEST - REAL

		$tradeHistoryArray = $api->history($symbol.'BTC'); 
		$tradeHistoryArray = array_reverse($tradeHistoryArray);
	//	$isError=$tradeHistoryArray['code'] === '-1121';
		 
         $isError='';
		$totalTradePaidBtc = 0;
		$tradeCount = 0;
		$tradeQuantity = 0;
		$tradeTime = null;
		$avgPrice = null; 
		$prev_id = null; 

		if ($isError != 1){
			foreach ($tradeHistoryArray as $tradeRecord){
                $buyer= isset($tradeRecord['isBuyer'])?$tradeRecord['isBuyer']:'';
				if ($buyer == 1){
					$id = $tradeRecord['orderId'];
					if ($prev_id == null || $prev_id == $id){					
						$tradeCount += 1;
						$price = $tradeRecord['price'];
						$qty = $tradeRecord['qty'];
						$tradeCostInBtc = $price * $qty;
						$totalTradePaidBtc += $tradeCostInBtc;
						$tradeQuantity += $qty;
						
						if ($tradeTime == null){
							$tradeTimeInt = round($tradeRecord['time']/1000);
							$tradeDate = date('Y-m-d G:i:s', $tradeTimeInt); //Y-m-d G:i:s // 'Y/m/d H:i:s'
						}
						$prev_id = $id;
					}else{
						break;
					}
				}else{
					break;
				}
			} 
	
			if ($tradeQuantity > 0){
				$avgPrice = $totalTradePaidBtc / $tradeQuantity;
				$avgPrice = number_format(round($avgPrice,8),8);
			}
			$result = Array('id'=>isset($id)?$id:'','first_buy_price'=>$avgPrice,'this_buy_price'=>$avgPrice,'high_price'=>$avgPrice,'first_buy_cost'=>$totalTradePaidBtc,'qty'=>$tradeQuantity,'time'=>isset($tradeDate)?$tradeDate:'','this_sold_price'=>0);
		}else{
			$result = null;
		}
	}

	return $result;
} 	
		


	
	
function createSellBotFolder($accountsArray)
	{
        $sellBotCoinDir = getBotCoinsFolderName()."/";
		$folderThere = file_exists ($sellBotCoinDir);
		if (!$folderThere){
			mkdir ($sellBotCoinDir, 0777, TRUE);
		}
		foreach ($accountsArray as $account){
			$folderThere = file_exists ($sellBotCoinDir.$account.'/');
			//echo ($sellBotCoinDir.$account.'/');
			if (!$folderThere){
				mkdir ($sellBotCoinDir.$account, 0777, TRUE);
			}
		
		}

        $logDir = 'log/';
		$folderThere = file_exists ($logDir.'/');
		if (!$folderThere){
			mkdir ($logDir, 0777, TRUE);
		}
		
        $logDir = 'json-log/';
		$folderThere = file_exists ($logDir.'/');
		if (!$folderThere){
			mkdir ($logDir, 0777, TRUE);
		}
		
        $btcusdDir = 'btcusd/';
		$folderThere = file_exists ($btcusdDir.'/');
		if (!$folderThere){
			mkdir ($btcusdDir, 0777, TRUE);
		}
		
        $dir = getTraderSignalsFolderName().'/';
		$folderThere = file_exists ($dir);
		if (!$folderThere){
			mkdir ($dir, 0777, TRUE);
		}
		
		
        $sellBotCoinDir = getBotCompletedTradesFolderName()."/";
		$folderThere = file_exists ($sellBotCoinDir);
		if (!$folderThere){
			mkdir ($sellBotCoinDir, 0777, TRUE);
		}
		foreach ($accountsArray as $account){
			$folderThere = file_exists ($sellBotCoinDir.$account.'/');
			if (!$folderThere){
				mkdir ($sellBotCoinDir.$account, 0777, TRUE);
			}
		}
		
        $sellBotCoinDir = getBotTradesFolderName()."/";
		$folderThere = file_exists ($sellBotCoinDir);
		if (!$folderThere){
			mkdir ($sellBotCoinDir, 0777, TRUE);
		}
		foreach ($accountsArray as $account){
			$folderThere = file_exists ($sellBotCoinDir.$account.'/');
			if (!$folderThere){
				mkdir ($sellBotCoinDir.$account, 0777, TRUE);
			}
		}
	}
	
function addToLog($account,$coinSymbol,$logText)
	{
    $CI =& get_instance();
		$ts = date("Y-m-d G:i:s",time());
    $logRow = "\n".$ts.'|'.$account.'|'.$coinSymbol.' | '.$logText;
    $homePath = getHomePath();
    $logFile  = 'log/sellbot.log';
		//file_put_contents($logFile,$logRow,FILE_	D | LOCK_EX);
    $CI->s3->write($logFile , $logRow);

	}	
	

function addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes){
	$status = isset($coinJsonFileContentArray['status'])?$coinJsonFileContentArray['status']:'';
	$coinJsonFileContentArray['action'] = $thisAction;
	$hasActions = array_key_exists('actions',$coinJsonFileContentArray);
	if ($hasActions == false){
		$actionsArray =  Array();
	}else{
		$actionsArray =  $coinJsonFileContentArray['actions'];
	}
	$ts = date("Y-m-d G:i:s",time());
	$notExists=array('BCX','CTR','ONG','SBTC');
	$bookPriceRec='';
	if(!in_array($symbol,$notExists))
	{
	  $bookPriceRec = $bookPriceArray[$symbol.$sellCoinSymbol];
	  $bid = isset($bookPriceRec['bid'])?$bookPriceRec['bid']:'';
	  $ask = isset($bookPriceRec['ask'])?$bookPriceRec['ask']:'';
	 } 
	
	$thisActionRecord = Array('timestamp'=>$ts,'bid'=>isset($bid)?$bid:'','ask'=>isset($ask)?$ask:'', 'action'=>$thisAction, 'notes'=>$thisActionNotes, 'status'=>$status);
	array_push($actionsArray, $thisActionRecord);
	$coinJsonFileContentArray['actions'] = $actionsArray;
	return $coinJsonFileContentArray;

}


function dumpCoin($symbol,$sellCoinSymbol,$api,$account,$tradeQuantity)
{


//Array ( [symbol] => AIONBTC [orderId] => 24514169 [clientOrderId] => x9yh88CS2l74RHX1isZKoe [transactTime] => 1538495785447 [price] => 0.00000000 [origQty] => 171.00000000 [executedQty] => 171.00000000 [cummulativeQuoteQty] => 0.01096110 [status] => FILLED [timeInForce] => GTC [type] => MARKET [side] => SELL [fills] => Array ( [0] => Array ( [price] => 0.00006410 [qty] => 171.00000000 [commission] => 0.00543722 [commissionAsset] => BNB [tradeId] => 3919921 ) ) )

  $pairSymbol = $symbol.$sellCoinSymbol;
  $thisTimezone = date_default_timezone_get();
  date_default_timezone_set('UTC');
  $nowInt = time();
  $nowInt = $nowInt * 1000;
  date_default_timezone_set($thisTimezone);
	$tradeResult = Array ();
  if ($symbol == 'TEST'){
    $qty =  0;
    //changeTestQty($qty);
    $testPrice = getTestPrice();
    $fillsArray = Array (Array ('price' => $testPrice, 'qty' => 1000.00000000, 'commission' => 0.001, 'commissionAsset' => 'BNB', 'tradeId' => '88888888' ));
    $tradeResult = Array ( 'symbol' => 'TESTBTC', 'orderId' => '99999999', 'clientOrderId' => 'x9yh88CS2l74RHX1isZKoe', 'transactTime' => $nowInt, 'price' => 0.00000000, 'origQty' => 1000.00000000, 'executedQty' => 1000.00000000, 'cummulativeQuoteQty' => 0.01, 'status' => 'FILLED', 'timeInForce' => 'GTC', 'type' => 'MARKET', 'side' => 'SELL', 'fills' => $fillsArray );
    
  }elseif ($account == 'WAS hanaan'){
    $bookPriceArray = $api->bookPrices();
    $bookPriceRec = $bookPriceArray[$pairSymbol];
    $currentAskPrice = $bookPriceRec['ask'];
    $fillsArray = Array (Array ('price' => $currentAskPrice, 'qty' => $tradeQuantity, 'commission' => 0.001, 'commissionAsset' => 'BNB', 'tradeId' => '77777777' ));
    $tradeResult = Array ( 'symbol' => $pairSymbol, 'orderId' => '77776666', 'clientOrderId' => 'x9yh88CS2l74RHX1isZKoe', 'transactTime' => $nowInt, 'price' => $currentAskPrice, 'origQty' => $tradeQuantity, 'executedQty' => $tradeQuantity, 'cummulativeQuoteQty' => 0.01, 'status' => 'FILLED', 'timeInForce' => 'GTC', 'type' => 'MARKET', 'side' => 'SELL', 'fills' => $fillsArray );
    
  }else{
    $balances = $api->balances(true);
    $coinBalanceRec = $balances[$symbol];
    $coinBalance = $coinBalanceRec['available'];
    $tradeResult = null;
    if ($coinBalance > 0){
      $tradeAmount = normalizeBinanceTradeAmount($symbol,$sellCoinSymbol,$coinBalance,$api);

      $tradeResult = $api->marketSell($pairSymbol, $tradeAmount); 
    }
  }
  return $tradeResult;
}


function buyCoin($symbol,$sellCoinSymbol,$qty,$api,$account)
{
//Array ( [symbol] => GTOBTC [orderId] => 31268815 [clientOrderId] => ORrYhJOOLx16i2cgRzt224 [transactTime] => 1538870546422 [price] => 0.00000000 [origQty] => 622.00000000 [executedQty] => 622.00000000 [cummulativeQuoteQty] => 0.00649368 [status] => FILLED [timeInForce] => GTC [type] => MARKET [side] => BUY [fills] => Array ( [0] => Array ( [price] => 0.00001044 [qty] => 622.00000000 [commission] => 0.00308124 [commissionAsset] => BNB [tradeId] => 5365901 ) ) )
  $tradeResult = null;
  $pairSymbol = $symbol.$sellCoinSymbol;
  
  /*
  if ($symbol == 'TEST'){
    $qty =  1000;
    //changeTestQty($qty);
    $testPrice = getTestPrice();
    $fillsArray = Array (Array ('price' => $testPrice, 'qty' => 1000.00000000, 'commission' => 0.001, 'commissionAsset' => 'BNB', 'tradeId' => '88888888' ));
    $tradeResult = Array ( 'symbol' => 'TESTBTC', 'orderId' => '99999999', 'clientOrderId' => 'x9yh88CS2l74RHX1isZKoe', 'transactTime' => time(), 'price' => 0.00000000, 'origQty' => 1000.00000000, 'executedQty' => 1000.00000000, 'cummulativeQuoteQty' => 0.01, 'status' => 'FILLED', 'timeInForce' => 'GTC', 'type' => 'MARKET', 'side' => 'BUY', 'fills' => $fillsArray );
  }elseif ($account=='hanaan'){
    $isTest = 1;

    $thisTimezone = date_default_timezone_get();

    date_default_timezone_set('UTC');
    $nowInt = time(); 
    $nowInt = $nowInt * 1000;
    date_default_timezone_set($thisTimezone);
    
    $bookPriceArray = $api->bookPrices();
    $bookPriceRec = $bookPriceArray[$symbol.$sellCoinSymbol];
    $currentAskPrice = $bookPriceRec['ask'];
    $tradeResultJson = '{"symbol":"'.$symbol.$sellCoinSymbol.'","orderId":99999999,"clientOrderId":"a9a9a9a9a9a9a9a9a9a9a9a9",
    "transactTime":'.$nowInt.',"price":'.$currentAskPrice.',"origQty":'.$qty.',"executedQty":'.$qty.',
    "cummulativeQuoteQty":"0.01102870","status":"FILLED","timeInForce":"GTC","type":"MARKET","side":"BUY",
    "fills":[{"price":'.$currentAskPrice.',"qty":'.$qty.',
    "commission":"0.005","commissionAsset":"BNB","tradeId":88888888}]}';
    
    $cummulativeQuoteQty = $currentAskPrice * $qty;
    
    $fillsArray = Array(Array('price'=>$currentAskPrice,'qty'=>$qty,'commission'=>0.005,'commissionAsset'=>'BNB','tradeId'=>88888888));
    
    $tradeResult = json_decode($tradeResultJson);
    $tradeResult = Array('symbol'=>$symbol.'BTC','orderId'=>99999999, 'clientOrderId' => 'a9a9a9a9a9a9a9a9a9a9a9a9','transactTime'=>$nowInt,'price'=>$currentAskPrice,'origQty'=>$qty,'executedQty'=>$qty,'cummulativeQuoteQty'=>$cummulativeQuoteQty,'status'=>'FILLED','timeInForce'=>'GTC','type'=>'MARKET','side'=>'BUY','fills'=>$fillsArray);  
  }else{
  */
    $tradeResult = $api->marketBuy($symbol.$sellCoinSymbol, $qty);
  //}
  return $tradeResult;
}

	

function initializeJsonFiles($accountsArray,$sellCoinSymbol,$btcBalanceThreshold,$ignoreSymbolArray)
{
	foreach ($accountsArray as $account){
		$api = createBinanceApiObject($account);
		$api->useServerTime();
		$bookPriceArray = $api->bookPrices();
		$balances = $api->balances(true);
		$prices = $api->prices(true);
		$exchangeInfoRaw = $api->exchangeInfo();
		$symbol='';
		$sellCoin='';
		
		$testQty = getTestQuantity();
		$ts_filename = date("Y-m-d h-i-s",time());
	    $ts = date("Y-m-d G:i:s",time());
		
		$testBalance = Array('available'=>$testQty);
		$balances['TEST'] = Array('available'=>$testQty, 'onOrder'=>0);
		
		$testPrice = getTestPrice();

		$prices['TEST'] = isset($testPrice)?$testPrice:'';
		
		$CI =& get_instance();

		echo '<h1>Initialize account: '.$account.'</h1>';
        
		foreach($balances as $coinSymbol => $balance){
			
			
			$lotSizeArray = getCoinLotSize($coinSymbol, $sellCoinSymbol,$exchangeInfoRaw);
			$invalidCoin = $lotSizeArray == null;
			$avoidCoin = in_array($coinSymbol,$ignoreSymbolArray);

			if (!$invalidCoin && !$avoidCoin){
//			if (!($lotSizeArray == null) && !in_array($coinSymbol, $ignoreSymbolArray)){


				$thisAmountOwned = $balance['available'];
				$btcBalance = $thisAmountOwned * $btcBalanceThreshold;
				
				
				### Check if owned amount is dust
				$coinDustThreshold = $lotSizeArray['minQty'];
				$isDust = $thisAmountOwned < $coinDustThreshold;
				
				$ownsCoin = $thisAmountOwned > 0 && !$isDust;
				
				//echo $coinSymbol.' - Owned: '.$thisAmountOwned;

				$coinJsonFileContentArray = checkCoinJsonFile($account,$coinSymbol);

        // echo "------<pre>";
        //     print_r($coinJsonFileContentArray);
				
				
				//~ $coinJsonFileThere = $coinJsonFileStatusArray[0];
				//~ $coinJsonFileContentArray = $coinJsonFileStatusArray[1];
				
				$coinJsonFileThere = true;
				if (!$coinJsonFileContentArray){
					$coinJsonFileThere = false;
				}
				
			
				 $coinJsonStatus    = isset($coinJsonFileContentArray['status'])?$coinJsonFileContentArray['status']:'';
				 $coinJsonFileThere = isset($coinJsonFileThere)?$coinJsonFileThere:'';
				
						
				if ($coinJsonFileThere){
				
 					if ($coinJsonStatus == 'owned' && !$ownsCoin){
						//echo 'Coin status: owned but balance is zero. Update file ('.$coinSymbol.') | ';
						if ($account == 'was hanaan'){
							//echo ' TEST RECORD FOR HANAAN | ';
						}else{
						     
							$coinInfoArray = Array('id'=>uniqid(),'account'=>$account,'symbol'=>$coinSymbol,'status'=>'inactive','is_rebuy'=>0,'is_armed'=>0, 'action'=>'initialize', 'actions'=>Array());
							//$coinFileJson = createCoinJsonFile($account,$coinSymbol,$coinInfoArray);
							
							$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$coinSymbol.'.json';
							$sellBotCoinFile_log = 'json-log/'.$account.'_'.$coinSymbol.'_'.$ts_filename.'.json';
							$coinInfoArray['timestamp'] = $ts;
							$jsonData = json_encode($coinInfoArray);
						    //$coinFileJson = $CI->s3->write($sellBotCoinFile,$jsonData);
						    //$coinFileJson = $CI->s3->write($sellBotCoinFile_log,$jsonData);
						
						}
						
					}elseif ($coinJsonStatus == 'inactive' && $ownsCoin){
				
						$coinInfoArray = Array('id'=>uniqid(),'account'=>$account,'symbol'=>$coinSymbol,'status'=>'owned','is_rebuy'=>0,'is_armed'=>0);
						
						$resultArray = getCombinedTradeDetail($account,$coinSymbol,$api);
					
						if ($resultArray != null && $resultArray != '' && $resultArray != Array()){						
							$coinInfoArray = array_merge($coinInfoArray,$resultArray);			
							$coinInfoArray['action'] = 'Initialize';
							//$coinFileJson = createCoinJsonFile($account,$coinSymbol,$coinInfoArray);
							//$logText = $logText.'JSON :'.$coinFileJson;
							$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$coinSymbol.'.json';
							$sellBotCoinFile_log = 'json-log/'.$account.'_'.$coinSymbol.'_'.$ts_filename.'.json';
							$coinInfoArray['timestamp'] = $ts;
							$jsonData = json_encode($coinInfoArray);
						   $coinFileJson = $CI->s3->write($sellBotCoinFile,$jsonData);
						    $coinFileJson = $CI->s3->write($sellBotCoinFile_log,$jsonData);
							
						}else{
							echo 'DELIST COINS ('.$coinSymbol.') | ';
							$coinInfoArray = Array('id'=>uniqid(),'account'=>$account,'symbol'=>$coinSymbol,'status'=>'delisted'); 
							$coinInfoArray['action'] = 'Delist';
							//$coinFileJson = createCoinJsonFile($account,$coinSymbol,$coinInfoArray);
							
							$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$coinSymbol.'.json';
							$sellBotCoinFile_log = 'json-log/'.$account.'_'.$coinSymbol.'_'.$ts_filename.'.json';
							$coinInfoArray['timestamp'] = $ts;
							$jsonData = json_encode($coinInfoArray);
						   $coinFileJson = $CI->s3->write($sellBotCoinFile,$jsonData);
						    $coinFileJson = $CI->s3->write($sellBotCoinFile_log,$jsonData);
							
						}
					}elseif ($coinJsonStatus == 'rebuy' && $ownsCoin){

						echo 'Coin rebuy occured. Replace inactive file ('.$coinSymbol.') | ';

						if ($account == 'was hanaan'){
							$bookPriceRec = $bookPriceArray[$symbol.$sellCoinSymbol];
							$bid = $bookPriceRec['bid'];
							$ask = $bookPriceRec['ask'];
							$thisBuyPrice = $ask;
							$resultArray = Array('Test Buy');

						}else{
							$resultArray = getCombinedTradeDetail($account,$coinSymbol,$api);
							$thisBuyPrice = $resultArray['this_buy_price'];
						}

						
						$coinJsonFileContentArray['this_buy_price'] = $thisBuyPrice;
						$coinJsonFileContentArray['is_rebuy'] = 1;
						$coinJsonFileContentArray['is_armed'] = 0;
						$coinJsonFileContentArray['status'] = 'owned';
						
						// echo '<p>';
// 						print_r($resultArray);
// 						echo '/<p>';
						
						if ($resultArray != null){						
							echo 'Coin owned after REBUY. Create file ('.$coinSymbol.') | ';
							echo '<br />Coin: '.$coinSymbol.' = '.$thisAmountOwned.' | ';
							echo 'Coin has JSON file | ';
							$thisAction = 'Perform rebuy';
							$thisActionNotes = '';
							$coinJsonFileContentArray = addActionToActionsArray($coinJsonFileContentArray,$thisAction,$bookPriceArray,$symbol,$sellCoinSymbol,$thisActionNotes);
 							//$coinFileJson = createCoinJsonFile($account,$coinSymbol,$coinJsonFileContentArray);
 							$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$coinSymbol.'.json';
							$sellBotCoinFile_log = 'json-log/'.$account.'_'.$coinSymbol.'_'.$ts_filename.'.json';
							$coinInfoArray['timestamp'] = $ts;
							$jsonData = json_encode($coinJsonFileContentArray);
						   $coinFileJson = $CI->s3->write($sellBotCoinFile,$jsonData);
						    $coinFileJson = $CI->s3->write($sellBotCoinFile_log,$jsonData);
						}
				 
					}
				}else{ // NO FILE
					if ($ownsCoin){
					
					
						$resultArray = getCombinedTradeDetail($account,$coinSymbol,$api);
					
						if ($resultArray == null){						
							$coinInfoArray = Array('id'=>uniqid(),'account'=>$account,'symbol'=>$coinSymbol,'status'=>'delisted','action'=>'Delist','actions'=>Array()); 
							//$coinFileJson = createCoinJsonFile($account,$coinSymbol,$coinInfoArray);
							$sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$coinSymbol.'.json';
							$sellBotCoinFile_log = 'json-log/'.$account.'_'.$coinSymbol.'_'.$ts_filename.'.json';
							$coinInfoArray['timestamp'] = $ts;
							$jsonData = json_encode($coinInfoArray);
						    $coinFileJson = $CI->s3->write($sellBotCoinFile,$jsonData);
						    $coinFileJson = $CI->s3->write($sellBotCoinFile_log,$jsonData);
							
					
						}else{
							$coinInfoArray = Array('id'=>uniqid(), 'account'=>$account, 'symbol'=>$coinSymbol, 'status'=>'owned', 'is_rebuy'=>0, 'is_armed'=>0, 'action'=>'Initialize','actions'=>Array());
							echo 'Coin owned. Create file ('.$coinSymbol.') | ';
							echo '<br />Coin: '.$coinSymbol.' = '.$thisAmountOwned.' | ';
							echo 'Coin has *NO* JSON file | ';
							echo $coinSymbol.' - Owned: '.$thisAmountOwned.'<br />';
							$coinInfoArray = array_merge($coinInfoArray,$resultArray);
							
						    $sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$coinSymbol.'.json';
							$sellBotCoinFile_log = 'json-log/'.$account.'_'.$coinSymbol.'_'.$ts_filename.'.json';
							$coinInfoArray['timestamp'] = $ts;
							$jsonData = json_encode($coinInfoArray);
						    $coinFileJson = $CI->s3->write($sellBotCoinFile,$jsonData);
						    $coinFileJson = $CI->s3->write($sellBotCoinFile_log,$jsonData);
							
						}
					
						
					}else{
						$coinInfoArray = Array('id'=>uniqid(), 'account'=>$account, 'symbol'=>$coinSymbol, 'status'=>'inactive', 'is_rebuy'=>0, 'is_armed'=>0, 'action'=>'Initialize','actions'=>Array());
						//$coinFileJson = createCoinJsonFile($account,$coinSymbol,$coinInfoArray);
						 $sellBotCoinFile = 'sell_bot_active_coins/'.$account.'/'.$coinSymbol.'.json';
							$sellBotCoinFile_log = 'json-log/'.$account.'_'.$coinSymbol.'_'.$ts_filename.'.json';
							$coinInfoArray['timestamp'] = $ts;
							$jsonData = json_encode($coinInfoArray);
						   //$coinFileJson = $CI->s3->write($sellBotCoinFile,$jsonData);
						   // $coinFileJson = $CI->s3->write($sellBotCoinFile_log,$jsonData);
					
					
					}
				}
			}
		}
	}	
}		


?>
