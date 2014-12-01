<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class msearchgames extends CI_Model {
   
    function msearchgames() {
        parent:: __construct();
            }
    


 
      public function search()
    {
          
           $cpname=$this->input->post('companyname');
                       $cpname2=htmlspecialchars($cpname);
                       
                 $gmnam=$this->input->post('game_name');
                       $gmnam2=htmlspecialchars($gmnam);
                       
                       
         $data=$gmnam2;
         $data2=$cpname2;
         
          if($data =='' && $data2 =='')
         {
        $query = $this->db->get('game');
         }       
         if($data || $data2 !='')
         {
            if($data2 =='' && $data !='')
         {
             $query = $this->db->get_where('game', array('game_name' => $data));   
             $numrows = $query->num_rows();
             $r= $numrows;
            }
         
         if($data =='' && $data2 !='')
         {        
             $querycp = $this->db->get_where('company', array('companyname' => $data2));
             $numrows = $querycp->num_rows();
         
        if($numrows>0)
        {
         foreach ($querycp->result() as $row5)
            {
                            $cpid5=$row5->cpid;         
             }      
              $query = $this->db->get_where('game', array('cpid' => $cpid5));
        }
        else
            {
             echo "No Data Found";
             return 0;
        }
         }
        if($data && $data2 !='')
         { 
         $this->db->like('game_name', $data); // users table
    $this->db->or_like('companyname', $data2); // companies table
   $this->db->from('game g');
$this->db->join('company c', 'c.cpid = g.cpid', 'left');

$this->db->group_by('g.cpid'); // added a group_by
$query=$this->db->get();

    
    }
       }   
      
       
            $numrows = $query->num_rows();
if($numrows>0)
{
echo "<table class='table table-striped table-bordered table-condensed' >";
 
echo "<thead><tr>"."<th>"."Game ID"."</th>"."<th>"."Game Name"."</th>"."<th>"."Publisher Name"."</th>"."<th>"."Game Type"."</th>"."<th>"."Game description"."</th>"."<th>"."Game URL"."</th>"."<th>"."Game icon"."</th>"."<th>"."Actions"."</th>"."</tr></thead>";
echo "<form name='search' method='POST' >";
 
foreach ($query->result() as $row)
{
    $id=$row->gameid;
     $cpid=$row->cpid;
    $querycp = $this->db->get_where('company', array('cpid' => $cpid));
    
   echo "<tbody><tr>"."<td>".$row->gameid."</td>";
      echo "<td>".$row->game_name."</td>";
       foreach ($querycp->result() as $row2)
{
          echo "<td>".$row2->companyname."</td>";
}
        echo "<td>".$row->game_type."</td>";
          echo "<td>".$row->game_des."</td>";
           echo "<td>".$row->game_url."</td>";
           echo "<td>"."<img src='"."/icafeapi2/images/".$row->game_icon."' width='50' height='50'/>"."</td>";
       echo "<td>"."<a href='update?uid=".$id."' ><img src='/icafeapi2/pics/ico_edit.png' width='20' height='20' title='Edit Record'></a>";
    echo "<a href=javascript:confirmDelete('delete?uid=".$id."') ><img src='/icafeapi2/pics/DeleteIcon.jpg' width='20' height='20' title='Delete Record'></a>"."</td></tr></tbody>";
                    
}
echo "</tr></tbody></table>";
}
else
{
    echo "No Data Found";
}
}
          

}

?>

