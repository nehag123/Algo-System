<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('user_model');
		$this->load->library('GoogleAuthenticator');
	}
	
	
	public function index() {

	}
	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		// create the data object

		if((!$this->session->userdata('username') && !$this->session->userdata('logged_in'))) {
			redirect('/');
		}

		if(($this->session->userdata('is_admin') != 1)) {
			redirect('/dashboard');
		}

		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('recaptcha');
		$data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('user_role', 'User Role', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');
		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('user/register/register', $data);
			$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username  = $this->input->post('username');
			$email     = $this->input->post('email');
			$user_role = $this->input->post('user_role');
			$password  = $this->input->post('password');
			$recaptcha = $this->input->post('g-recaptcha-response');
		    $response  = $this->recaptcha->verifyResponse($recaptcha); 
			
			if (isset($response['success']) and $response['success'] === true) {
			
				if ($this->user_model->create_user($username, $email, $user_role, $password)) {
					
					// user creation ok
					$this->load->view('header');
					$this->load->view('user/register/register_success', $data);
					$this->load->view('footer');
					
				} else {
					
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
					$this->load->view('user/register/register', $data);
					$this->load->view('footer');
					
				}
		   }else{
			      $data= 'Please verify captcha.';
			      // send error for captcha
					$this->load->view('header');
					$this->load->view('user/register/register', $data);
					$this->load->view('footer');
			   }
		}
		
	}
		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {
		
		// create the data object

		if($this->session->userdata('username') && $this->session->userdata('logged_in')) {
			redirect('dashboard');
		}

		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('user/login/login');
			$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) {
				
				//$gv =$this->google_verification();
			      
				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);
				
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->username;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				$_SESSION['is_admin']     = (bool)$user->is_admin;
				
				// user login ok
				$this->load->view('header');
				$this->load->view('user/login/login_success', $data);
				$this->load->view('footer');

				redirect('dashboard');
				//redirect("auth");
				
			} else {
				
				// login failed
				$data->error = 'Wrong username or password.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/login/login', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->view('header');
			$this->load->view('user/logout/logout_success', $data);
			$this->load->view('footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
		
	}
	
	public function passkey()
	{
		//~ $this->load->library('encrypt');
		//~ echo  $skey="hIDluCP9NqnIXjp61sY3ohArYa0UHEETadsiiWHQucxm4sYOEtT2I6tm7gWpoqCc";
		//~ echo "<br>";
		//~ echo $k="olUcQWXisgt56K8xpTyOkNJ3Gv16m3zUjEyDCisLF8ven4wrHt5aBbXdNCdDsLW2";
		//~ echo "<br>";
		//~ echo  $ekey=$this->encrypt->encode($k);
		//~ echo " <br/>";
		//~ echo  $e=$this->encrypt->encode($skey);
		
		//~ echo " <br/> ";
		 //~ echo $d=$this->encrypt->decode($ekey);
		 //~ echo " <br/> ";
		 //~ echo $f=$this->encrypt->decode($e);
		
		}
	
 
	
	
}
