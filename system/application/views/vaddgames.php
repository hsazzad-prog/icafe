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
    
    
    
    <title>Add Games</title>
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$game_name=array (
'game_name'=>'game_name',
'id'=>'companyname',
'value'=>'',
);
$game_type=array (
'game_type'=>'game_type',
'id'=>'game_type',
'value'=>'',
);
$game_des=array (
'game_des'=>'game_des',
'id'=>'game_des',
'value'=>'',
);
$game_url=array (
'game_url'=>'game_url',
'id'=>'game_url',
'value'=>'',
);


$this->load->helper('form');
$attributes = array('name' => 'addgame', 'class'=> 'well');
echo form_open_multipart('addgames/insert', $attributes);
echo "<h3>Add Game Details</h3>";

echo "<table border='0' class='tabledetail'>";
 
echo "<tr>"."<td>"."Select Publisher "."</td>";
$query2 = $this->db->get('company');

echo "<td>"."<select name='selcpid'>";

foreach ($query2->result() as $row)
{
   echo "<option value='".$row->cpid."'>". $row->companyname."</option>";
}
echo "</select>"."</td>"."</tr>";

echo "<tr>"."<td>"."Game name"."</td><td>"."<input type='text' name='game_name' value='".set_value('game_name')."' />"."</td><td>".form_error('game_name')."</td></tr>";
//echo "<tr>"."<td>".form_label('Game name')."</td>"."<td>".form_input('game_name')."</td>"."</tr>";

echo "<tr>"."<td>".form_label('Game Type')."</td>";
echo "<td>";
echo "<select name='game_type'>
     <option value ='Web'>Web</option>
  <option value ='Client'>Client</option>
</select>";
echo "</td>"."</tr>";

echo "<tr>"."<td>"."Game URL"."</td><td>"."<input type='text' name='game_url' value='".set_value('game_url')."' />"."</td><td>".form_error('game_url')."</td></tr>";
//echo "<tr>"."<td>".form_label('Game URL')."</td>"."<td>".form_input('game_url')."</td>"."</tr>";
echo "<tr>"."<td>"."Game Icon"."</td><td>"."<input type='file' name='userfile' value='".set_value('userfile')."' />"."</td><td>".form_error('userfile')."</td></tr>";

//echo "<tr>"."<td>".form_label('Game Icon')."</td>"."<td>".form_upload('userfile')."</td>"."</tr>";
echo "<tr>"."<td>"."Game Description"."</td><td>"."<input type='text' name='game_des' value='".set_value('game_des')."' />"."</td><td>".form_error('game_des')."</td></tr>";
//echo "<tr>"."<td>".form_label('Game Description')."</td>"."<td>".form_textarea('game_des')."</td>"."</tr>";
echo "<tr>"."<td>"."<input class='btn btn-primary' name='submit' id='submit' type=submit value='Submit'>"."</td>"."<td>";
echo "</table>";
echo form_close();



?>


 
    </body>
    </html>

