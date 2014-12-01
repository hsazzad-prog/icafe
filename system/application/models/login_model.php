<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
     
    public function validate(){
        // grab user input
        
        $this->load->library('encrypt');

//$encrypted_string = $this->input->post('password');

//$password = $this->encrypt->decode($encrypted_string);

        
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
         
         $query = $this->db->get_where('user', array('uname' => $username));
         $num=$query->num_rows();
         if($num>0){
         foreach ($query->result() as $row)
{
    $pass=$row->upassword;
}
$passd= $this->encrypt->decode($pass);
        // Prep the query
      //  $this->db->where('uname', $username);
       // $this->db->where('upassword', $password);
         
        // Run the query
        //$query = $this->db->get('user');
        // Let's check if there are any results
        if($password == $passd)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                   
                    'fname' => $row->fname,
                    'password' => $row->upassword,
                    'username' => $row->uname,
                'email' => $row->email,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
         }
        // If the previous process did not validate
        // then return false.
        return false;
    }
}
?>