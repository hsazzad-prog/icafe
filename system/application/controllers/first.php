<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class first extends CI_Controller {
    function __construct(){
        parent::__construct();
       
               if($this->session->userdata('fname')==''){
            redirect('login'); }
             $this->check_isvalidated();
       
    }
	
	
	public function index($msg = NULL){
        
            $data['msg'] = $msg;
          
        $this->load->view('vfirst', $data);
       
    }
    
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
 
    }
     
    public function do_logout(){
       
       $data = array(
                   
                      'fname' => '',
                    'password' => '',
                    'username' => '',
                'email' => '',
                 'validated' => false  
                    );
            $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect('login');
      

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */