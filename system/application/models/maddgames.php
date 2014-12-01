<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maddgames extends CI_Model {
   
    function maddgames() {
        parent:: __construct();
            }
 
public function do_upload()
	{
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		
		$this->load->library('upload', $config);
        
		
			$data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data();
                       $insert_data = array(
                   'game_icon' => $upload_data['file_name']                  
                                              );
     
                       $gmname=$this->input->post('game_name');
                       $gmname2=htmlspecialchars($gmname);
                       
                       $gmurl=$this->input->post('game_url');
                       $gmurl2=htmlspecialchars($gmurl);
                       
                       $gmdes=$this->input->post('game_des');
                       $gmdes2=htmlspecialchars($gmdes);
                       
                         $name = $gmname2;
        $query = $this->db->get_where('game', array('game_name' => $name));
             $numrows = $query->num_rows();
        if($numrows==0)
        {      
$this->db->insert('game', array(
        
        'cpid' => $this->input->post('selcpid'),
        'game_name' => $gmname2,
    
        'game_type' => $this->input->post('game_type'),
        'game_url' => $gmurl2,
        'game_icon' => $upload_data['file_name'],
        'game_des' => $gmdes2
           
    ////'content'  => $this->input->post('content')
    ));                  
                redirect('addgames/success');
         	}  
                  else{
    redirect('addgames/val');
        }
                
                
                }
                 
}
?>

