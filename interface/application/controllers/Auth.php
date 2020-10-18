<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		if (!empty($_POST)){
			$this->load->helper('cookie');
			$this->load->library('session');

			$url = API_URL.'/users/me';
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$uriReturn = $this->input->post('uriReturn');

			$auth = base64_encode(''.$username.':'.$password.''); 
			$headers = ['Authorization: Basic '.$auth.'', 'Content-Type: application/json'];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response  = curl_exec($ch);
			curl_close($ch);
			
			$userLogin = json_decode($response, true);
			
			if($userLogin){
				$cookie0 = array(
					'name'   => 'user_data',
					'value'  => $userLogin,
					'base_url' => base_url(),
					'expire' => 86400,
					'secure' => TRUE
				);

				setcookie('user_data', json_encode($cookie0, true), time()+2592000, '/'); // Ativo por 30 dias
			}
			
			if ($userLogin['id'] > 0){
				// Salva cookie do remember_me
				if($this->input->post('remember')){
					$cookie1 = array(
						'name'   => 'queryRememberMe',
						'value'  => 'yes',
						'expire' => 86400,
						'secure' => TRUE
					);
					
					setcookie('queryRememberMe', json_encode($cookie1, true), time()+2592000, '/'); // Ativo por 30 dias
				 }
				 
				// Salva cookie com chave do login
				$cookie = array(
					'name'   => 'cookieLogin',
					'value'  => $auth,
	        		'expire' => 86400,
					'secure' => TRUE
				);
				
				setcookie('cookieLogin', json_encode($cookie, true), time()+2592000, '/'); // Ativo por 30 dias

				$this->session->set_flashdata('resultForm', 'Login efetuado!');
				redirect(base_url('dashboard/index'), 'refresh');
			} else {
				$this->session->set_flashdata('resultForm', 'Erro ao efetuar Login!');
				redirect(base_url('dashboard/login'), 'refresh');
			}
		} else {
			echo "Wrong method!";
		}
	}

	public function logout($url = '')
	{
		$this->load->helper('cookie');
		delete_cookie("queryRememberMe");
		delete_cookie("cookieLogin");
		$this->session->set_flashdata('resultForm', 'Sessão finalizada!');
		$this->session->set_flashdata('uriReturn', $this->session->flashdata('uriReturn'));
		redirect(base_url('dashboard/login'), 'refresh');
	}

}
