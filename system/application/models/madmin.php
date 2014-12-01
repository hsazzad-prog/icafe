<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class madmin extends CI_Model{
  function __construct(){
        parent::__construct();
		 $this->load->database();
		
    }
    
}
?>