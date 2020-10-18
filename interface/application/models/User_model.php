<?php
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get user by id
     */
    function get_user($id)
    {
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/users/'.$id.'?is_active=1';
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
        // return $this->db->get_where('users',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all users
     */
    function get_all_users()
    {
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/users/?is_active=1';
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
        // $this->db->order_by('id', 'desc');
        // return $this->db->get('users')->result_array();
    }
        
    /*
     * function to add new user
     */
    function add_user($params)
    {
        
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/users/';
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

        // $this->db->insert('users',$params);
        // return $this->db->insert_id();
    }
    
    /*
     * function to update user
     */
    function update_user($id,$params)
    {
        
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/users/'.$id;
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
        // return $this->db->update('users',$params);
    }
    
    /*
     * function to delete user
     */
    function delete_user($id)
    {
        
        $userdata = json_decode($_COOKIE['user_data'], true);
        $cookieLogin = json_decode($_COOKIE['cookieLogin'], true);

        if ($cookieLogin && $userdata){
            $auth = $cookieLogin['value'];
            $url = API_URL.'/users/'.$id;
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
        // return $this->db->delete('users',array('id'=>$id));
    }
}
