<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Cache-control: no-cache');
class menu extends CI_Controller {
    function __construct(){
        parent::__construct();
   
    }	
	public function index(){
                  
        $this->load->view('vmenu');
       
    }
     public function track()
    {
        // $this->load->library('ajax');
              $uid = $_GET['uid'];
      // $rand = $_GET['numbers'];
              $numbers = rand(10000,100000);
              $date = date_create();

date_default_timezone_set('Singapore');
$date=date("d/m/y - h:i:s a", time());

$status = "OK";

       $data = array(
                   
                    'sessionid' => $numbers,
                    'gameid' => $uid,
                    'timestamp' => $date,
                'status' => $status,
                                    );
           $this->db->insert('game-session', $data);
 
           
           $querycp = $this->db->get_where('game', array('gameid' => $uid));
  
  
  foreach ($querycp->result() as $row2)
{
         // echo $row2->game_url;
          $uri =$row2->game_url;
        
}

//echo $uri,$numbers;
echo $uri."[BRK]".$numbers;
 
    }
    
}


     