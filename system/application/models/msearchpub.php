<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class msearchpub extends CI_Model {
   
    function msearchpub() {
        parent:: __construct();
            }
  
     public function search()
    {
         
          $cpname=$this->input->post('companyname');
                       $cpname2=htmlspecialchars($cpname);
          $data=$cpname2;
       
          if($data =='')
         {
              $query = $this->db->get('company');
         }
        if($data !='')
          {
         
      
    $query = $this->db->get_where('company', array('companyname' => $data));
            
            $numrows = $query->num_rows();
              if($numrows<1)
{
    echo "No Data Found";
    return 0;
}
      
          }

          echo "<table class='table table-striped table-bordered'>";

echo "<thead><tr><th>"."Company ID"."</th>"."<th>"."Company Name"."</th>"."<th>"."Address"."</th>"."<th>"."State"."</th>"."<th>"."Country"."</th>"."<th>"."Contact"."</th>"."<th>"."Actions"."</th></tr></thead>";
    echo "<form name='frm1' method='POST'>";
     
foreach ($query->result() as $row)
{
     
 echo "<input type='hidden' name='cpid' id='cpid' value='$row->cpid'>";
   $id=$row->cpid;
 
    echo "<tbody><tr>"."<td>".$row->cpid."</td>";
      echo "<td>".$row->companyname."</td>";
        echo "<td>".$row->address."</td>";
          echo "<td>".$row->state."</td>";
           echo "<td>".$row->country."</td>";
            echo "<td>".$row->contact."</td>";
         
    echo "<td>"."<a href='update?uid=".$id."' ><img src='/icafeapi2/pics/ico_edit.png' width='20' height='20' title='Edit Record'></a>";
    echo "<a href=javascript:confirmDelete('delete?uid=".$id."') ><img src='/icafeapi2/pics/DeleteIcon.jpg' width='20' height='20' title='Delete Record' onclick='return confirm('Are you sure you want to delete?')'></a>"."</td></tr></tbody>";
            
}

echo "</table>";

echo "</form>";

    }

}

?>
