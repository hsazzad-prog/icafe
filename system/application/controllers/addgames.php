<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addgames extends CI_Controller {
   function __construct()
 {
   parent:: __construct();
   if($this->session->userdata('fname')==''){
            redirect('login'); }
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->model ('maddgames');   
         $this->check_isvalidated();
 }
     public function index(){
                   $this->load->view('vaddgames');
        
    }
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
    public function insert()
    {
                $this->load->library('form_validation');

		$this->form_validation->set_rules('game_name', 'Game name', 'required|is_unique[game.game_name]');
		$this->form_validation->set_rules('game_url', 'Game URL', 'trim|required|callback_url_check');
		$this->form_validation->set_rules('game_des', 'Game Description', 'trim|required');
               $this->form_validation->set_rules('userfile', 'Game Icon', 'callback_image_check');
                $this->form_validation->set_error_delimiters('<span class="label label-important"><font size=2><border:5px>', '</font></span>');
           $this->form_validation->set_message('is_unique', 'This game already exists. Please enter another game.');

          if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('vaddgames');
                        //return false;
		}
 else {
            $this->maddgames->do_upload();
 }
        
    }
     public function image_check($str)
	{
         $config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		
		$this->load->library('upload', $config);
        
		if ( ! $this->upload->do_upload())
		{
			$this->form_validation->set_message('image_check', 'Please enter a valid image.');
			return FALSE;
			
		}
		else
		{
                    return true;
                }
        }
     
    public function url_check($str)
	{
       if (preg_match('/^http(|s):\/{2}(.*)\.([a-z]){2,}(|\/)(.*)$/i', $str))
                {
                        return TRUE;
                }
                else
                {
                        $this->form_validation->set_message('url_check', 'Please enter valid url. Ex: http://www.abc.com');
			return FALSE;
                }
		
	}
   
    public function success()
    {
     $this->load->view ('added');
    
    }
    
  
}

?>




