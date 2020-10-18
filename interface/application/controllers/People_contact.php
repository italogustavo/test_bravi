<?php
class People_contact extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('People_contact_model');
        $this->load->model('Modelloginsecure', 'loginsecure');
        $this->loginsecure->verifica_sessao();
    } 

    /*
     * Listing of people_contacts
     */
    function index()
    {
        $params['people_id'] = $this->input->get('people_id');
        $data['people_contacts'] = $this->People_contact_model->get_all_people_contacts($params);
        
        $data['_view'] = 'people_contact/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new people_contact
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('email','Email','valid_email');
		$this->form_validation->set_rules('whatsapp','Whatsapp','max_length[20]');
		$this->form_validation->set_rules('phone','Phone','max_length[20]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'people_id' => $this->input->post('people_id'),
				'phone' => $this->input->post('phone'),
				'whatsapp' => $this->input->post('whatsapp'),
				'email' => $this->input->post('email'), 
            );
            
            $people_contact_id = $this->People_contact_model->add_people_contact($params);
            redirect('people_contact/index?people_id='.$this->input->get('people_id'));
        }
        else
        {
			$this->load->model('People_model'); 
			$data['all_peoples'] = $this->People_model->get_all_peoples();
            
            $data['_view'] = 'people_contact/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a people_contact
     */
    function edit($id)
    {   
        // check if the people_contact exists before trying to edit it
        $data['people_contact'] = $this->People_contact_model->get_people_contact($id);
        
        if(isset($data['people_contact']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('email','Email','valid_email');
			$this->form_validation->set_rules('whatsapp','Whatsapp','max_length[20]');
			$this->form_validation->set_rules('phone','Phone','max_length[20]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'people_id' => $this->input->post('people_id'),
					'phone' => $this->input->post('phone'),
					'whatsapp' => $this->input->post('whatsapp'),
					'email' => $this->input->post('email'),
                );

                $this->People_contact_model->update_people_contact($id,$params);            
                redirect('people_contact/index?people_id='.$this->input->get('people_id'));
            }
            else
            {
				$this->load->model('People_model');
				$data['all_peoples'] = $this->People_model->get_all_peoples();

                $data['_view'] = 'people_contact/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The people_contact you are trying to edit does not exist.');
    } 

    /*
     * Deleting people_contact
     */
    function remove($id)
    {
        $people_contact = $this->People_contact_model->get_people_contact($id);

        // check if the people_contact exists before trying to delete it
        if(isset($people_contact['id']))
        {
            $this->People_contact_model->delete_people_contact($id);
            redirect('people_contact/index?people_id='.$this->input->get('people_id'));
        }
        else
            show_error('The people_contact you are trying to delete does not exist.');
    }
    
}
