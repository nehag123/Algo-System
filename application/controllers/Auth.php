<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/************************************** Google Authenication of login User *****************************************/

class Auth extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->library('GoogleAuthenticator');
		
		if(!$this->session->userdata('username')) {
			redirect('/');
		}
	}
	
	
	public function index() {

                 
         $secret = $this->googleauthenticator->createSecret();   
              
        $qrCodeUrl = $this->googleauthenticator->getQRCodeGoogleUrl('test@developer.com', 'dev', $secret);
		
		$data['qrCodeUrl']= $qrCodeUrl;
		$data['authcode'] = $secret;
		$this->load->view('user/login/auth_check', $data);	
		

	}
	
	
 
 /******************************** Verify with phone code *******************************************************/
 
  public function verify_phonecode()
  {
	  $code=$_POST['code'];
	  $secret=$_POST['authcode'];

	  $checkResult = $this->googleauthenticator->verifyCode($secret, $code, 2); // 2 = 2*30sec clock tolerance

				if ($checkResult) {
					 
			        $_SESSION['verified']= $secret; 
					    redirect('dashboard');
				} else {
					
					redirect('auth');
				}
	  
	  }	
	
	
}	
?>
