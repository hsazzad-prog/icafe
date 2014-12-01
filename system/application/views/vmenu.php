

<html>
<head>
     <script language="javascript" type="text/javascript">
         
 function getFile(url) {
  if (window.XMLHttpRequest) {              
    AJAX=new XMLHttpRequest();              
  } else {                                  
    AJAX=new ActiveXObject("Microsoft.XMLHTTP");
  }
  if (AJAX) {
     // alert(AJAX.responseText);
     AJAX.open("GET", "menu/track?uid="+url, false);                             
     AJAX.send(null);
     //return AJAX.responseText;  
     var data=AJAX.responseText.split("[BRK]");
    // var num=AJAX.responseText;
    var uri = data[0];
 var num = data[1];
    
    alert(num);
     openw(uri);
    // window.location = uri;
  } else {
     return false;
  }                                             
}
</script>
    
<script type="text/javascript">
function openw(uri)
{
   // alert(uri);

// alert("fasd");
window.open(uri);
}

</script>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Menu</title>
	<style>

td:hover 
{   
  background-color: whitesmoke;
}

table td{
    float: left;
	margin-right: 10px;   
}

a:link    {
  /* Applies to all unvisited links */
 
  text-decoration:  none;
  color:            #010120;
  } 
a:visited {
  /* Applies to all visited links */
 text-decoration:  none;
 color:            #323260;
  }

</style>
    
</head>
<body>
 
<div id="sample-container">

<?php

 $query = $this->db->get('game');

// $numrows = $query->num_rows(); 
foreach ($query->result() as $row)
{
  $r[]=$row->game_name;
  natcasesort($r);
}
 echo "<table id='hello'>";
  foreach ($r as $key => $val) {

    
   $str= $val;
  $len=strlen($str);
  
    $querycp = $this->db->get_where('game', array('game_name' => $val));
  
  
  foreach ($querycp->result() as $row2)
{
          $url = $row2->game_url;
           $img = $row2->game_icon;
           $uid = $row2->gameid;
}
  $numbers = rand(10000,100000);
$url2 = prep_url($url);

echo "<td class='highlightit' width='80' title='".$val."'><a href='#'  onClick= getFile('$uid')><p align='center'><img align='middle' src='"."/icafeapi2/images/".$img."' width='32' height='32' />"."</p>";

for($i=0;$i<$len;$i++)
{  
    if($i>=8 && $str[$i]==' ')
    {      
        $post = substr($str, 0, $i); 
        $post2 = substr($str, $i, 10);
        $post3 = "...";   
        break;
          }
  else
  {
    $post = $str; 
        $post2 = "";  
         $post3 = ""; 
    }
}
     echo "<p align='center'><font size='2'>".$post."<br />".$post2.$post3."<font></p>"."</a></td>";

}
echo "</table>";
?>

</div>


</body>
</html>

