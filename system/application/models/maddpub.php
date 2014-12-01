<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maddpub extends CI_Model {
   
    function maddpub() {
        parent:: __construct();
            }
    public function insert()
    {
    

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
                       
          //     $name = $cpname2;
        //$query = $this->db->get_where('company', array('companyname' => $name));
         //    $numrows = $query->num_rows();
        //if($numrows==0)
        //{      
        $this->companyname=$cpname2;
        $this->address=$cpadd2;
        $this->state=$cpstat2;
        $this->country=$cpcon2;
        $this->contact=$cpcont2;
        //echo"name country".$this->input->post ('country');
          
        $this->db->insert('company', $this);
        redirect('addpub/success','refresh');
        //}
        
       //  else{
    //redirect('addpub/val');
      //  }
       
    }
}

?>