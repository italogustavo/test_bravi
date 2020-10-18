<?php
class People extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('People_model');
        $this->load->model('Modelloginsecure', 'loginsecure');
        $this->loginsecure->verifica_sessao();
    } 

    /*
     * Listing of peoples
     */
    function index()
    {
        $data['peoples'] = $this->People_model->get_all_peoples();
        
        $data['_view'] = 'people/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new people
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('fullname','Fullname','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'fullname' => $this->input->post('fullname'),
            );
            
            $people_id = $this->People_model->add_people($params);
            redirect('people/index');
        }
        else
        {            
            $data['_view'] = 'people/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a people
     */
    function edit($id)
    {   
        // check if the people exists before trying to edit it
        $data['people'] = $this->People_model->get_people($id);
        
        if(isset($data['people']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('fullname','Fullname','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'fullname' => $this->input->post('fullname'),
                );

                $this->People_model->update_people($id,$params);            
                redirect('people/index');
            }
            else
            {
                $data['_view'] = 'people/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The people you are trying to edit does not exist.');
    } 

    /*
     * Deleting people
     */
    function remove($id)
    {
        $people = $this->People_model->get_people($id);

        // check if the people exists before trying to delete it
        if(isset($people['id']))
        {
            $this->People_model->delete_people($id);
            redirect('people/index');
        }
        else
            show_error('The people you are trying to delete does not exist.');
    }
    
}
