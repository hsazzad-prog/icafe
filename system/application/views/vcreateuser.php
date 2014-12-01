<?php 
 
header("cache-Control: no-store, no-cache, must-revalidate");
header("cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

?>

<!DOCTYPE html>
<html>
<head>
     <meta http-equiv="content-type" content="text/html; charset=<?php echo config_item('charset');?>" />
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <style>
       
input[type=text] {
    height: 20px !important;
}
textarea {
	width: 80px;
	height: 40px;
	
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
    
<title>Create User</title>
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




$this->load->helper('form');

//$attributes = array('name' => 'createuser', 'class'=> 'well');
//echo form_open('createuser/insert', $attributes);

echo "<form class='well' id='createuser' name='createuser'  method='post' action='".site_url("/createuser/val")."' >";

echo "<h3>Create User</h3>";
echo "<table>";

echo "<tr>"."<td>"."Name"."</td>"."<td>"."<input type='text' name='fname' id='fname' value='".set_value('fname')."' >"."</td><td>".form_error('fname')."</td>"."</tr>";
echo "<tr>"."<td>"."Username"."</td>"."<td>"."<input type='text' name='usname' id='usname' value='".set_value('usname')."' >"."</td><td>".form_error('usname')."</td>"."</tr>";
echo "<tr>"."<td>"."Password"."</td>"."<td>"."<input type='password' name='pass' id='pass' value='".set_value('pass')."'>"."</td><td>".form_error('pass')."</td>"."</tr>";
echo "<tr>"."<td>"."Email"."</td>"."<td>"."<input type='text' name='email' id='email' value='".set_value('email')."'>"."</td><td>".form_error('email')."</td>"."</tr>";
echo "<tr>"."<td>"."<input class='btn btn-primary' name='submit' id='submit' type=submit value='Submit'>"."</td>"."<td>";
echo "</table>";
echo form_close();

?>

    </body>
    </html>
    
    <script  type="text/javascript">
    
