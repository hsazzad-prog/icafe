<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Createuser extends CI_Controller {
   function __construct()
 {
   parent::__construct();
     if($this->session->userdata('fname')==''){
            redirect('login'); }
    $this->load->database();
      //  $this->load->model ('maddpub');   
         $this->check_isvalidated();
 }
    public function index($msg = NULL){
          
         
          
        $this->load->view('vcreateuser');
       
       
    }
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
      public function val()
    {
        
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname', 'Name', 'trim|required');
		$this->form_validation->set_rules('usname', 'Username', 'trim|required|is_unique[user.uname]');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		//$this->form_validation->set_rules('contact', 'Contact', 'required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_error_delimiters('<span class="label label-important"><font size=2><border:5px>', '</font></span>');
           $this->form_validation->set_message('is_unique', 'This %s already exists. Please enter another %s.');
//$data['msg'] = $msg;
            //    $this->form_validation->set_message('required', 'Your custom message here');
          if ($this->form_validation->run() == FALSE)
		{
			$this->load->view ('vcreateuser');
                        return false;
		}
 else {
            $this->addpub->insert();
 }
 
    }
    
    public function insert()
    {
        
                        $passht=$this->input->post ('pass');
                       $passht2=htmlspecialchars($passht);
                       
                       $unam=$this->input->post ('usname');
                       $unam2=htmlspecialchars($unam);
                       
                       $fnam=$this->input->post ('fname');
                       $fnam2=htmlspecialchars($fnam);
                                              
                         $emal=$this->input->post ('email');
                       $emal2=htmlspecialchars($emal);
        
        $this->load->library('encrypt');
        $pass=$passht2;
        $password = $this->encrypt->encode($pass);
        $name = $unam2;
        $query = $this->db->get_where('user', array('uname' => $name));
             $numrows = $query->num_rows();
        if($numrows==0)
        {
            
       
       $data = array(
                   
                    'fname' => $fnam2,
                    'upassword' => $password,
                    'uname' => $unam2,
                'email' => $emal2,
                
                    );
           $this->db->insert('user', $data);
          
           
           
        redirect('createuser/success','refresh');
       
        }
        
        else{
        
    $msg = '<div class="alert alert-error"><label>Username already exists. Please enter another username. </label></div>';
            
            
       $this->index($msg);
        }
    }
   
    public function success()
    {
          
$this->load->view ('added');
    }
}

?>
