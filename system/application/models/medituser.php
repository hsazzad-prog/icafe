<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class medituser extends CI_Model {
   
    function medituser() {
        parent:: __construct();
            }
  
     public function search()
    {
         
          $cpname=$this->input->post('uname');
                       $cpname2=htmlspecialchars($cpname);
          $data=$cpname2;
          
          if($data =='')
         {
              $query = $this->db->get('user');
         }
        if($data !='')
          {
          $comp_name = $data;
         
    $query = $this->db->get_where('user', array('uname' => $data));
            
            $numrows = $query->num_rows();
              if($numrows<1)
{
    echo "No Data Found";
    return 0;
}
      
          }

          echo "<table class='table table-striped table-bordered'>";

echo "<thead><tr><th>"."Username"."</th>"."<th>"."Name"."</th>"."<th>"."Email"."</th>"."<th>"."Actions"."</th></tr></thead>";
    echo "<form name='frm1' method='POST'>";
     
foreach ($query->result() as $row)
{
     
 echo "<input type='hidden' name='uname' id='uname' value='$row->uname'>";
   $uname=$row->uname;
 
    echo "<tbody><tr>"."<td>".$row->uname."</td>";
      echo "<td>".$row->fname."</td>";
       // echo "<td>".$row->upassword."</td>";
          echo "<td>".$row->email."</td>";
          
         
    echo "<td>"."<a href='".site_url("/edituser/updateuser?uname=").$uname."' ><img src='/icafeapi2/pics/ico_edit.png' width='20' height='20' title='Edit Record'></a>";
    echo "<a href=javascript:confirmDelete('".site_url("/edituser/delete?uname=").$uname."') ><img src='/icafeapi2/pics/DeleteIcon.jpg' width='20' height='20' title='Delete Record' onclick='return confirm('Are you sure you want to delete?')'></a>"."</td></tr></tbody>";
            
}

echo "</table>";

echo "</form>";



    }

}

?>
