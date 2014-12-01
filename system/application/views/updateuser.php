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
echo "<form  id='updateuser' name='updateuser'  method='post' action='".site_url("/edituser/updating")."' class= 'well'>";

echo "<h3>Edit User</h3>";
echo "<table border='0' class='tabledetail'>";

echo "<input type='hidden' name='uname' value='$uname'>";

echo "<tr>"."<td>"."Name"."</td>"."<td>"."<input type='text' name='fname' value='$fname'>"."</td><td>".form_error('fname')."</td></tr>";

echo "<td>"."Username"."</td>"."<td>"."  <input type='text' name='uname2' value='$uname'>"."</td><td>".form_error('uname2')."</td>";
if($msg != NULL)
{
  echo "<td>".$msg."</td>";
}     
echo "</tr>";
echo "<td>"."Password"."</td>"."<td>"." <input type='password' name='upassword' value='$upassword'>"."</td><td>".form_error('upassword')."</td>"."</tr>";

echo "<td>"."Email"."</td>"."<td>"." <input type='text' name='email' value='$email'>"."</td><td>".form_error('email')."</td>"."</tr>";
     
     echo "<td>"."<input class='btn btn-primary' name='submit' id='submit' type=submit value='Update' onsubmit='return validate();'>"."</td>"."</tr>";
     
     echo "</table>";

echo "</form>";

       
    

?>
          
           </body>
    </html>
    
    
  <script  type="text/javascript">
    
  function validate(){

   
    if( document.updateuser.fname.value == "")
 {
alert("Please enter valid name");
 return false;
 }  
 var reEmail = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;
 if( !reEmail.test(document.updateuser.email.value))
 {
alert("Please Enter a valid email");
 return false;
 }  
 var usr_name = /^[A-Za-z0-9 ]{3,20}$/;
  if(!usr_name(document.updateuser.uname2.value))
    {
        alert("Please enter valid username");
        return false;
    }
    if(document.updateuser.pass.value == "")
    {
        alert("Please enter valid password");
        return false;
    }
    
 
}
 
</script>