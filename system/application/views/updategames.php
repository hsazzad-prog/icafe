<?php 
 
header("cache-Control: no-store, no-cache, must-revalidate");
header("cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

?>

<!DOCTYPE html>
<html>
<head>
     <style>
       
input[type=text], input[type=password] {
    height: 20px !important;
}
       </style>
    
<link href="<?php echo base_url();?>bootstrap/docs/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>bootstrap/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">
   <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="<?php echo base_url();?>bootstrap/docs/assets/js/jquery.js"></script>
    <script src="<?php echo base_url();?>bootstrap/docs/assets/js/google-code-prettify/prettify.js"></script>
    <script src="<?php echo base_url();?>bootstrap/docs/assets/js/bootstrap-transition.js"></script>
    <script src="<?php echo base_url();?>bootstrap/docs/assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url();?>bootstrap/docs/assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url();?>bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
    
    
    
    <title>Edit Games</title>
</head>


<body>
   <div id="navbar-example" class="navbar navbar-static">
            <div class="navbar-inner">
              <div class="container" style="width: auto;">
                <a class="brand" href="<?php  $this->load->helper('url'); echo site_url("/first"); ?>">Friendster iCafe</a>
                <ul class="nav">
                    <li class="active"><a href="<?php  $this->load->helper('url'); echo site_url("/first"); ?>">HOME</a></li>
                      
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">PUBLISHER <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php  $this->load->helper('url'); echo site_url("/addpub"); ?>">ADD</a></li>
                      <li><a href="<?php  $this->load->helper('url'); echo site_url("/searchpub/search"); ?>">SEARCH</a></li>            
                     </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">GAME<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php  $this->load->helper('url'); echo site_url("/addgames"); ?>">ADD</a></li>
                      <li><a href="<?php  $this->load->helper('url'); echo site_url("/searchgames/search"); ?>">SEARCH</a></li>
                                           
                    </ul>
                  </li>
                   <li><a href="#">CONTACT</a></li>
                      
                </ul>
               
                  <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="icon-user"></i>  <?php
   echo $this->session->userdata('username');    ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
   if($this->session->userdata('username') =='Admin')
       echo "<li><a href='".site_url("/createuser")."'>Create User</a></li>
              <li class='divider'></li>
              <li><a href='".site_url("/edituser")."'>Delete/Edit User</a></li>
              <li class='divider'></li>";    
   
   
   ?>
                
              
              <li><a href="<?php  $this->load->helper('url'); echo site_url("/first/do_logout"); ?>">Sign Out</a></li>
            </ul>
          </div>
              </div>
            </div>
          </div> <!-- /navbar-example -->

<?php

$this->load->helper('form');
$attributes = array('name' => 'addgame', 'class'=> 'well');
echo form_open_multipart('searchgames/do_upload', $attributes);
echo "<h3>Edit Game Details</h3>";
echo "<table border='0' class='tabledetail'>";
 

echo "<tr>"."<td>"."Select Publisher "."</td>";
$query2 = $this->db->get('company');

echo "<td>"."<select name='selcpid'>";
//echo " <option selected value=$gmcpid >$gmcpname</option>";
foreach ($query2->result() as $row)
{
    $gmcpid2=$row->cpid;
    $gmcpname2=$row->companyname;
    
    if($gmcpid==$gmcpid2)
   {
   echo "<option value='".$gmcpid."' selected='selected' >".$gmcpname2."</option>";
   }
  else
  {
   echo "<option value='".$gmcpid2."'>".$gmcpname2."</option>";
  }
}
echo "</select>"."</td>"."</tr>";
echo "<input type='hidden' name='gameid' value='$edited'>";
echo "<input type='hidden' name='gmicon' value='$gmicon'>";
echo "<input type='hidden' name='game_name2' value='$gmname'>";
//echo "<input type='hidden' name='game_icon' value='$gmicon'>";
echo "<tr>"."<td>"."Game name"."</td>"."<td>"."<input type='text' name='game_name' value='$gmname'>"."</td><td>".form_error('game_name')."</td>"."</tr>";
//echo "<tr>"."<td>"."Game Type"."</td>"."<td>"."  <input type='text' name='game_type' value='$gmtype'>"."</td>"."</tr>";
echo "<tr>"."<td>".form_label('Game Type')."</td>";
$query3 = $this->db->get('gametype');
echo "<td>";
echo "<select name='game_type'>";
    foreach ($query3->result() as $raw)
{
    $gmtype2=$raw->type;
   // $gmcpname2=$row->companyname;
    
    if($gmtype==$gmtype2)
   {
   echo "<option value='".$gmtype."' selected='selected' >".$gmtype."</option>";
   }
  else
  {
   echo "<option value='".$gmtype2."'>".$gmtype2."</option>";
  }
}
echo"</select>";
echo "</td>"."</tr>";

echo "<tr>"."<td>"."Game URL "."</td>"."<td>"." <input type='text' name='game_url' value='$gmurl'>"."</td><td>".form_error('game_url')."</td>"."</tr>";
echo "<tr>"."<td>"."Game Icon"."</td>"."<td>"." <input type ='file' name='userfile'/>"."</td>";
//echo "<tr>"."<td>".form_label('Game Icon')."</td>"."<td>".form_upload('userfile')."</td>";

echo "<td>"."<img src='/icafeapi2/images/".$gmicon."' width='50' height='50'/>"."</td><td>"."</td>"."</tr>";
echo "<tr>"."<td>"."Game Description  "."</td>"."<td>"." <input type='text' name='game_des' value='$gmdes'>"."</td><td>".form_error('game_des')."</td>"."</tr>";

echo "<tr>"."<td>"."<input class='btn btn-primary' type=submit value='Submit'>"."</td>"."<td>";

echo "</table>";
echo form_close();
?>

    </body>
    </html>