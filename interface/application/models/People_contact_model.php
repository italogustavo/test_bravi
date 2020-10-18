<?php
class People_contact_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get people_contact by id
     */
    function get_people_contact($id)
    {
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/peoples/'.$this->input->get('people_id').'/contacts/'.$id.'?is_active=1';
            $headers = [
                    'Authorization: Basic '.$auth.'',
                    'Content-Type: application/json'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);
            $result_list = json_decode($response, true);

            if($response) {
                return $result_list; 
            } else {
                return false;
            }
        } else {
            return false;
        }
        // return $this->db->get_where('people_contacts',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all people_contacts
     */
    function get_all_people_contacts($params = array())
    {
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/peoples/'.$this->input->get('people_id').'/contacts?is_active=1';
            // $url = API_URL.'/peoples/?is_active=1';
            $headers = [
                    'Authorization: Basic '.$auth.'',
                    'Content-Type: application/json'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);
            $result_list = json_decode($response, true);

            if($response) {
                return $result_list; 
            } else {
                return false;
            }
        } else {
            return false;
        }
        // return $this->db->get('people_contacts')->result_array();
    }
        
    /*
     * function to add new people_contact
     */
    function add_people_contact($params)
    {
        
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value']; 
            $url = API_URL.'/peoples/'.$this->input->get('people_id').'/contacts';
            $headers = [
                    'Authorization: Basic '.$auth.'',
                    'Content-Type: application/json'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);

            if(is_array($result)) {
                return $result['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
        // $this->db->insert('people_contacts',$params);
        // return $this->db->insert_id();
    }
    
    /*
     * function to update people_contact
     */
    function update_people_contact($id,$params)
    {
        
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/peoples/'.$this->input->get('people_id').'/contacts/'.$id;
            // $url = API_URL.'/peoples/'.$id;
            $headers = [
                    'Authorization: Basic '.$auth.'',
                    'Content-Type: application/json'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);
            
            if(is_array($result)) {
                return $result['id']; 
            } else {
                return false;
            }
        } else {
            return false;
        }
        
        // $this->db->where('id',$id);
        // return $this->db->update('people_contacts',$params);
    }
    
    /*
     * function to delete people_contact
     */
    function delete_people_contact($id)
    {
        
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/peoples/'.$this->input->get('people_id').'/contacts/'.$id;
            $headers = [ 
                    'Authorization: Basic '.$auth.'',
                    'Content-Type: application/json'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);
            
            if(is_array($result)) {
                return $result['id']; 
            } else {
                return false;
            }
        } else {
            return false;
        }
        // return $this->db->delete('people_contacts',array('id'=>$id));
    }
}
