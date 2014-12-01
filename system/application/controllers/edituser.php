<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class edituser extends CI_Controller {
   
    function __construct()
 {
   parent:: __construct();
        if($this->session->userdata('fname')==''){
            redirect('login'); }
        $this->load->database();
        $this->load->model ('medituser'); 
         $this->check_isvalidated();
 }
     public function index($msg = NULL){
        
         
          $data['msg'] = $msg;
         $this->load->view('vedituser', $data);
    }
    
    
    
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }  
   
    public function search()
    {
        $this->load->view ('vedituser');
    }
   
   public function deleted()
    {
          $this->load->view ('vedituser');
$this->load->view ('deleted');
    }
 
   
  public function updated()
    {
        
        $this->load->view ('vedituser');
$this->load->view ('updated');
    }
 
   public function updateuser($msg = NULL)
    {
        
        $uname = $_GET['uname'];
       
 
        $query = $this->db->get_where('user', array('uname' => $uname));
    
foreach ($query->result() as $raw)
{
    $uname=$raw->uname;
          $fname=$raw->fname;
           $email=$raw->email;
           $upass=$raw->upassword;
        
}
      
$this->load->library('encrypt');
        $pass=$upass;
        $password = $this->encrypt->encode($pass);

$data=array (
'fname'=>$fname,
    'uname'=>$uname,
'email'=>$email,
'upassword'=>$password,
  'msg'=>$msg
);


$this->load->view ('updateuser',$data);
 
 }
 
 
 
 public function updating($msg = NULL)
{
     $this->load->library('form_validation');

		
		$this->form_validation->set_rules('fname', 'Name', 'required');
                $this->form_validation->set_rules('uname2', 'Username', 'required');
		$this->form_validation->set_rules('upassword', 'Password', 'required');
		//$this->form_validation->set_rules('contact', 'Contact', 'required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                $this->form_validation->set_error_delimiters('<span class="label label-important"><font size=2>', '</font></span>');
          
            //    $this->form_validation->set_message('required', 'Your custom message here');
          if ($this->form_validation->run() == FALSE)
		{
              
      
      
      
         $fname=$this->input->post('fname');                       
                       
                       $uname=$this->input->post('uname');
                       
                       
                       $email=$this->input->post('email');
                       
                                              
                         $upassword=$this->input->post('upassword');                       
                       $msg=$this->input->post('msg');
            $data=array (
'fname'=>$fname,
    'uname'=>$uname,
'email'=>$email,
'upassword'=>$upassword,
  'msg'=>$msg
);
  $this->load->view ('updateuser',$data);
  
  
       
		}
     else
     {
     
                     $passht=$this->input->post ('upassword');
                       $passht2=htmlspecialchars($passht);
                       
                       $unam=$this->input->post ('uname2');
                       $unam2=htmlspecialchars($unam);
                       
                       $fnam=$this->input->post ('fname');
                       $fnam2=htmlspecialchars($fnam);
                                              
                         $emal=$this->input->post ('email');
                       $emal2=htmlspecialchars($emal);

                       $nam=$this->input->post ('uname');
                            
$chk=$this->input->post ('uname2');
 $query = $this->db->get_where('user', array('uname' => $chk));
             $numrows = $query->num_rows();
        if($chk!=$nam && $numrows>0)
        {
             $msg = '<span class="label label-important"><font size=2>Username already exists. Please enter another username. </font></span>';
            
            $data=array (
'fname'=>$fnam,
    'uname'=>$nam,
'email'=>$emal,
'upassword'=>$passht,
  'msg'=>$msg
);
  $this->load->view ('updateuser',$data);
           }
           else
           {
          $this->load->library('encrypt');
        $pass=$passht2;
        $password = $this->encrypt->encode($pass);
    
    $this->db->where('uname', $nam);      
          $this->db->update('user', array(
         'uname' => $unam2,
        'fname' => $fnam2,   
        'email' => $emal2,
        'upassword' => $password
    )); 
          redirect('edituser/updated');
           }
     }
   
 }        
 
 
 public function delete()
    {
     

     $delete = $_GET['uname'];
 
   $this->db->delete('user', array('uname' => $delete)); 
   
 redirect('edituser/deleted');
    
 }
 
    
}

?>




