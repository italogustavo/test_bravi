<?php

class Modelloginsecure extends CI_Model {

	public function verifica_sessao() {
		// Verifica se existe sessão para algum usuário logado, evitando alguem entrar
		$cookieLogin = json_decode($_COOKIE['cookieLogin'], true);
		$user_data = json_decode($_COOKIE['user_data'], true);
		
		if ($user_data && $cookieLogin){
			
		} else {
			$this->session->set_flashdata('uriReturn', uri_string());
			redirect('auth/logout', 'refresh');
		}
  }


}
