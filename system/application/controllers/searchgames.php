<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Searchgames extends CI_Controller {
 function __construct()
 {
   parent:: __construct();
          if($this->session->userdata('fname')==''){
            redirect('login'); }
        $this->load->helper(array('form', 'url','file'));
        
        $this->load->database();
        $this->load->model ('msearchgames');   
         $this->check_isvalidated();
 }
     public function index($msg = NULL){
          
           
          
        $this->load->view('vsearchgames');
       
       
    }
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }  
    
   
    public function search()
    {
        $this->load->view ('vsearchgames');
    }
     public function datatab()
    {
        $this->load->view ('datatable');
    }
   
 public function insert()
    {
       // $data=$_FILES['userfile'];
     $data=$this->input->post('game_name');
        if($data !=''){
           $this->searchgames->do_upload();
           
        }  
        
   
      $this->load->view ('vsearchgames');
    }
    
   
    
    public function deleted()
    {
        $this->load->view ('vsearchgames');
$this->load->view ('deleted');
    }
  
   
     public function updated()
    {
      $this->load->view ('vsearchgames');
$this->load->view ('updated');
    }
     public function delete()
    {
   
     $delete = $_GET['uid'];
 
   $this->db->delete('game', array('gameid' => $delete)); 
   redirect('searchgames/deleted');
    
 }
   
    
    
    public function update()
    {
              $edited = $_GET['uid'];
       
        $query = $this->db->get_where('game', array('gameid' => $edited));
    
foreach ($query->result() as $raw)
{
        $gmcpid=$raw->cpid;
          $gmname=$raw->game_name;
           $gmtype=$raw->game_type;
           $gmurl=$raw->game_url;
           $gmicon=$raw->game_icon;
           $gmdes=$raw->game_des;
}

$query5 = $this->db->get_where('company', array('cpid' => $gmcpid));
foreach ($query5->result() as $raw)
{
   $gmcpname=$raw->companyname;
}

$data=array (
    'gmcpname'=>$gmcpname,
    'gmcpid'=>$gmcpid,
'gmname'=>$gmname,
'gmtype'=>$gmtype,
'gmurl'=>$gmurl,
 'gmicon'=>$gmicon,
'gmdes'=>$gmdes,
'edited'=>$edited,   
    
);

$this->load->view ('updategames',$data);

    }
    
     public function game_check($str)
	{
         $nam=$this->input->post ('game_name2');
                            
$chk=$this->input->post ('game_name');
 $query = $this->db->get_where('game', array('game_name' => $chk));
             $numrows = $query->num_rows();
        if($chk!=$nam && $numrows>0)
        {
            $this->form_validation->set_message('game_check', 'This game already exists. Please insert another game');
			return FALSE;
        }
        else
        {
            return TRUE;
        }
        }
    
    
    
    public function do_upload()
	{
          $this->load->library('form_validation');

		$this->form_validation->set_rules('game_name', 'Game name', 'required|callback_game_check');
		$this->form_validation->set_rules('game_url', 'Game URL', 'trim|required|callback_url_check');
		$this->form_validation->set_rules('game_des', 'Game Description', 'trim|required');
               //$this->form_validation->set_rules('userfile', 'Game Icon', 'callback_image_check');
                $this->form_validation->set_error_delimiters('<span class="label label-important"><font size=2><border:5px>', '</font></span>');
           $this->form_validation->set_message('is_unique', 'This game already exists. Please enter another game.');

          if ($this->form_validation->run() == FALSE)
		{
	$edited=$this->input->post('gameid');	
       
            
             $query = $this->db->get_where('game', array('gameid' => $edited));
    
foreach ($query->result() as $raw)
{
        $gmcpid=$raw->cpid;
          $gmname=$raw->game_name;
           $gmtype=$raw->game_type;
           $gmurl=$raw->game_url;
           $gmicon=$raw->game_icon;
           $gmdes=$raw->game_des;
}
            

$data=array (
'gmname'=>$gmname,
'gmtype'=>$gmtype,
'gmurl'=>$gmurl,
 'gmicon'=>$gmicon,
    'gmdes'=>$gmdes,
'edited'=>$edited,   
    
);
  $this->load->view ('updategames',$data);
		}
 else {
            $id=$this->input->post ('gameid'); 

                $config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		
		 $this->load->library('upload', $config);
        
		if ( ! $this->upload->do_upload())
		{
			$gmicon=$this->input->post('gmicon');
                            $this->db->where('gameid', $id);
		$this->db->update('game', array(
       
                 'game_icon' => $gmicon,
        
                    ));                      
                                           
		}
                else
                {
                    
     $data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data();
                      $picx=$upload_data['file_name'];
                      $this->db->where('gameid', $id);
		$this->db->update('game', array(
       
                 'game_icon' => $picx,
        
                    ));
                   }
                      
                       
                         $gmname=$this->input->post('game_name');
                       $gmname2=htmlspecialchars($gmname);
                       
                       $gmurl=$this->input->post('game_url');
                       $gmurl2=htmlspecialchars($gmurl);
                       
                       $gmdes=$this->input->post('game_des');
                       $gmdes2=htmlspecialchars($gmdes);
                       
                      

$this->db->where('gameid', $id);
$this->db->update('game', array(
        
       'cpid' => $this->input->post('selcpid'),
        'game_name' => $gmname2,
    
        'game_type' => $this->input->post('game_type'),
        'game_url' => $gmurl2,
     
        'game_des' => $gmdes2
           
   
    ));       

redirect('searchgames/updated','refresh');
		//}         
       
        
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
                        $this->form_validation->set_message('url_check', 'Please enter valid url.');
			return FALSE;
                }
		
	}
   
        
        
}

?>




