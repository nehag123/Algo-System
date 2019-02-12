<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Bot_cron_model class.
 * 
 * @extends CI_Model
 */
class Bot_cron_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		// $this->load->database();
		
	}
	
	public function getCoinPairs($days) {
		$this->db->select('DISTINCT(coin_pair)');
		$this->db->from('ema_cross');
		$this->db->where('created_date >= DATE(NOW()) - INTERVAL '.$days.' DAY');
		$qry = $this->db->get();
		$result = $qry->result();
		if($result) {
			return $result;
		} else {
			return false;
		}
	}
	
}
