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
    
<title>Add Publisher</title>
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



$companyname=array (
'companyname'=>'companyname',
'id'=>'companyname',
'value'=>'',
);
$address=array (
'address'=>'address',
'id'=>'address',
'value'=>'',
 

);
$state=array (
'state'=>'state',
'id'=>'state',
'value'=>'',
);
$country=array (
'country'=>'country',
'id'=>'country',
'value'=>'',
);
$contact=array (
'contact'=>'contact',
'id'=>'contact',
'value'=>'',
);




$this->load->helper('form');
$this->load->library('form_validation');
$attributes = array('name' => 'addpub', 'class'=> 'well');
 
echo form_open('addpub/insert', $attributes);
echo "<class='well'>";
echo "<h3>Add Publisher Data</h3>";

echo "<table border='0' class='tabledetail'>";
echo "<tr>"."<td>"."Company Name"."</td><td>"."<input type='text' name='companyname' value='".set_value('companyname')."' />"."</td><td>".form_error('companyname')."</td></tr>";
//echo "<tr>"."<td>".form_label('Company Name')."</td>"."<td>".form_input('companyname')."</td>"."</tr>";
echo "<tr>"."<td>"."Address"."</td><td>"."<input type='text' name='address' value='".set_value('address')."' />"."</td><td>".form_error('address')."</td></tr>";
echo "<tr>"."<td>"."State"."</td><td>"."<input type='text' name='state' value='".set_value('state')."' />"."</td><td>".form_error('state')."</td></tr>";

//echo "<tr>"."<td>".form_label('Address')."</td>"."<td>".form_textarea('address')."</td>"."</tr>";
  //      print $addrErr;
//echo "<tr>"."<td>".form_label('State')."</td>"."<td>".form_input('state')."</td>"."</tr>";
//print $emailErr;
//echo "<tr>"."<td>".form_label('Country')."</td>"."<td>".form_input('country')."</td>"."</tr>";
$query2 = $this->db->get('country');

echo "<tr><td>Country</td><td>"."<select name='country'>";

foreach ($query2->result() as $row)
{
   echo "<option value='".$row->name."' >". $row->name."</option>";
}
echo"</td></tr>";
echo "<tr>"."<td>"."Contact Number"."</td><td>"."<input type='text' name='contact' value='".set_value('contact')."' />"."</td><td>".form_error('contact')."</td></tr>";

//echo "<tr>"."<td>".form_label('Contact Number')."</td>"."<td>".form_input('contact')."</td>"."</tr>";


echo "<tr>"."<td>"."<input class='btn btn-primary' name='submit' id='submit' type=submit value='Submit'>"."</td>"."</tr>";
echo "</table>";
echo form_close();



// define variables and initialize with empty values


   

?>

    </body>
    </html>
    
  