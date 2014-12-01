<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Searchpub extends CI_Controller {
   
    function __construct()
 {
   parent:: __construct();
         if($this->session->userdata('fname')==''){
            redirect('login'); }
        $this->load->database();
        $this->load->model ('msearchpub'); 
         $this->check_isvalidated();
 }
     public function index($msg = NULL){
         $data['msg'] = $msg;
        $this->load->view('vsearchpub', $data);
    }
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }  
   
    public function search()
    {
        $this->load->view ('vsearchpub');
    }
   
   public function deleted()
    {
          $this->load->view ('vsearchpub');
$this->load->view ('deleted');
    }
 
   
  public function updated()
    {
        
        $this->load->view ('vsearchpub');
$this->load->view ('updated');
    }
 
   public function update($msg = NULL)
    {
        
        $edited = $_GET['uid'];
    
      // $edited= $row->cpid;
        $query = $this->db->get_where('company', array('cpid' => $edited));
    
foreach ($query->result() as $raw)
{
          $cpname=$raw->companyname;
           $cpadd=$raw->address;
           $cpstate=$raw->state;
           $cpcountry=$raw->country;
           $cpcontact=$raw->contact;
}
             
$cpid=array (
'cpid'=>$edited,
'id'=>$edited,
'value'=>$edited,
);     
     
     $companyname=array (
'companyname'=>'companyname',
'id'=>'companyname',
'value'=>$cpname,
);
$address=array (
'address'=>'address',
'id'=>'address',
'value'=>$cpadd,
);
$state=array (
'state'=>'state',
'id'=>'state',
'value'=>$cpstate,
);
$country=array (
'country'=>'country',
'id'=>'country',
'value'=>$cpcountry,
);
$contact=array (
'contact'=>'contact',
'id'=>'contact',
'value'=>$cpcontact,
);

$data=array (
'cpname'=>$cpname,
'cpadd'=>$cpadd,
'cpstate'=>$cpstate,
 'cpcountry'=>$cpcountry,
'cpcontact'=>$cpcontact,
'edited'=>$edited,
    'msg'=>$msg
    
);
//$data['cpname'] = $cpname;
//$data['address'] = $address;

$this->load->view ('update',$data);

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
        
   public function unam_check($cnam)
	{
       if($cnam!='')
       {
       $chk=$this->input->post ('companyname');
       $str=$this->input->post ('cname');
 $query = $this->db->get_where('company', array('companyname' => $cnam));
             $numrows = $query->num_rows();
        if($cnam!=$str && $numrows>0)
        {
              $this->form_validation->set_message('unam_check', 'This company already exists. Please enter another companyname.');
			return FALSE;  
              
        }
       else
                {
                   return TRUE;   
                   
                }
       }
     
		
	}
 
 
 public function updating($msg = NULL)
{
     
     $this->load->library('form_validation');

		$this->form_validation->set_rules('companyname', 'Company name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		//$this->form_validation->set_rules('contact', 'Contact', 'required');
                $this->form_validation->set_rules('contact', 'Contact', 'trim|required|callback_number_check');
                $this->form_validation->set_error_delimiters('<span class="label label-important"><font size=2>', '</font></span>');
           $this->form_validation->set_message('is_unique', 'This company already exists. Please enter another company.');

            //    $this->form_validation->set_message('required', 'Your custom message here');
          if ($this->form_validation->run() == FALSE)
		{
              $cpname=$this->input->post('companyname');                       
                       
                       $cpadd=$this->input->post('address');
                       
                       
                       $cpstate=$this->input->post('state');
                       
                                              
                         $cpcountry=$this->input->post('country');                       
                       $cpcontact=$this->input->post('contact');
                     
                       
    $edited=$this->input->post ('cpid');
              
               $data=array (
                   'cpname'=>$cpname,
'cpadd'=>$cpadd,
'cpstate'=>$cpstate,
 'cpcountry'=>$cpcountry,
'cpcontact'=>$cpcontact,
'edited'=>$edited, 
'msg'=>$msg
    
);
			
$this->load->view ('update',$data);

		}
 else {

                     $cpname=$this->input->post('companyname');
                       $cpname2=htmlspecialchars($cpname);
                       
                       $cpadd=$this->input->post('address');
                       $cpadd2=htmlspecialchars($cpadd);
                       
                       $cpstat=$this->input->post('state');
                       $cpstat2=htmlspecialchars($cpstat);
                                              
                         $cpcon=$this->input->post('country');
                       $cpcon2=htmlspecialchars($cpcon);
                       
                       $cpcont=$this->input->post('contact');
                       $cpcont2=htmlspecialchars($cpcont);
                        $edited=$this->input->post ('cpid');
                       $nam=$this->input->post ('cname');               
$chk=$this->input->post ('companyname');
 $query = $this->db->get_where('company', array('companyname' => $chk));
             $numrows = $query->num_rows();
        if($chk!=$nam && $numrows>0)
        {
             $msg = '<span class="label label-important"><font size=2>Company name already exists. Please enter another company. </font></span>';
           $data=array (
                   'cpname'=>$nam,
'cpadd'=>$cpadd,
'cpstate'=>$cpstat,
 'cpcountry'=>$cpcon,
'cpcontact'=>$cpcont,
'edited'=>$edited, 
'msg'=>$msg
);
  $this->load->view ('update',$data);
           }
           else
           {
       
    
     $id=$this->input->post ('cpid');
     $this->companyname=$cpname2;
        $this->address=$cpadd2;
        $this->state=$cpstat2;
        $this->country=$cpcon2;
        $this->contact=$cpcont2;
        
          $this->db->where('cpid', $id);
          $this->db->update('company', $this);


    

redirect('searchpub/updated');

 }
 }        
}
 
 public function delete()
    {
     
//$i=0;
     $delete = $_GET['uid'];
 // $i = count($delete);
   // foreach ($delete as $del) {
   $this->db->delete('company', array('cpid' => $delete)); 
   
  //  }
  //  echo "$delete";
 redirect('searchpub/deleted');
    
 }
 
    
}

?>




