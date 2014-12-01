<?php
header("cache-Control: no-store, no-cache, must-revalidate");
header("cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

?>
<!DOCTYPE html>

<html lang="en">
  <head>
      
      
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
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
   
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

    .login-form {
      margin-left: 65px;
    }
  
    legend {
      margin-right: -50px;
      font-weight: bold;
      color: #404040;
    }

    </style>

</head>
<body>
  <div class="container">
      <div class="content">
          <div class="row">
              <div class="login-form">
                  <h2>Login</h2>
                  <form action="<?php $this->load->helper('url'); echo site_url("/login/process");?>" method="post" name="process">
                       
                      <fieldset>
                          <?php if(! is_null($msg)) echo $msg;?>  
                          <div class="clearfix">
                              <input type="text" placeholder="Username" name='username' id='username'>
                          </div>
                          <div class="clearfix">
                              <input type="password" placeholder="Password" name="password" id='password'>
                          </div>
                          <button class="btn btn-primary" type="submit">Sign in</button>
                      </fieldset>
                  </form>
                   <a href="<?php  $this->load->helper('url'); echo site_url("/menu"); ?>"  target="_blank">Click here</a> to go to the Menu
              </div>
          </div>
      </div>
  </div> <!-- /container -->
   

        
</body>
</html>

