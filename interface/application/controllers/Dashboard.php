<?php
class Dashboard extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->model('Modelloginsecure', 'loginsecure');
        $this->loginsecure->verifica_sessao();
        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main',$data);
    }
    
	public function login()
	{
		if($this->input->cookie('queryRememberMe') == "yes"){
			redirect(base_url('dashboard'), 'refresh');
		} else {
			$this->load->view('layouts/header_login');
			$this->load->view('page-login');
			$this->load->view('layouts/footer_login');
		}
	}
}
