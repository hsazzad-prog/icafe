<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addpub extends CI_Controller {
   function __construct()
 {
   parent::__construct();
     if($this->session->userdata('fname')==''){
            redirect('login'); }
    $this->load->database();
        $this->load->model ('maddpub');   
         $this->check_isvalidated();
 }
    public function index(){
       
			$this->load->view('vaddpub');
                        //return false;
	
    }
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
    public function insert()
    {
        
		$this->load->library('form_validation');

		$this->form_validation->set_rules('companyname', 'Company name', 'trim|required|is_unique[company.companyname]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		//$this->form_validation->set_rules('contact', 'Contact', 'required');
                $this->form_validation->set_rules('contact', 'Contact', 'trim|required|callback_number_check');
                $this->form_validation->set_error_delimiters('<span class="label label-important"><font size=2><border:5px>', '</font></span>');
           $this->form_validation->set_message('is_unique', 'This company already exists. Please enter another company.');
//$data['msg'] = $msg;
            //    $this->form_validation->set_message('required', 'Your custom message here');
          if ($this->form_validation->run() == FALSE)
		{
			$this->load->view ('vaddpub');
                        //return false;
		}
 else {
            $this->maddpub->insert();
 }
 
    }
    
   public function number_check($str)
	{
       if (preg_match('/^[0-9]{9,25}$/', $str))
                {
                        return TRUE;
                }
                else
                {
                        $this->form_validation->set_message('number_check', 'Please insert a valid contact number');
			return FALSE;
                }
		
	}
    
    
    public function success()
    {
          
$this->load->view ('added');
    }
}

?>




