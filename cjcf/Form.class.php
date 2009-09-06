<?php
class Form{
 public $form;
 private $fields = array();
 public $output;

 function __construct(){

 }

 function run(){
 
 if ($_POST['submit']){
    $this->getFieldValue();
      if ((getOption('submit') == 'yes!') && ($this->checkForm())) {
        $mail = new Data($this->output, $this->fields);
        $this->output = $this->opt['success'];
        $this->output .= $mail->result();
      }
      
      else {
        $this->output = '';
            	$this->open();
        $this->getFields();

	$this->close(getOption('submittext'));
      }
    }
    else { 
    	
    	$this->open();
    	$this->getFields();
	$this->close();
    
     }
 
 }

 function addF($name, $label, $type, $error = false, $required = false){
    $this->fields[$name] = new Input($name, $label, $error, $type, $required); 
 }

 function getFields(){
    foreach($this->fields as $field){
     $this->output .= $field->buildHTML();
    }
 }

 function getFieldValue(){
  foreach($this->fields as $field){
     $field->getVal();
     $this->output .= $field->getResult();
    }
 }
 
  function ensureIncluded(){
if(stripos($_SERVER['REQUEST_URI'],$_SERVER['PHP_SELF'])){
header("HTTP/1.1 405 Access Forbidden", 504); echo('Direct Access Forbidden'); exit;
}
}

 
 function open(){
 $url = getOption('formurl');
 $this->output .= '<form action="'.$url.'" method="post" id="contact-form"><ol>';
 }
 
 function close(){
 
 $submit = getOption('submittext');
 $etag = $this->genToken();
 $this->output .= '<li>'.$etag.'<input type="submit" value="'.$submit.'" name="submit" /></li></ol></form>';
 
 }
 
 


function checkForm(){
$form = getOption('etagpre');

if (getOption('etag')){
if ((isset($_SESSION['cjform_token'])) && (isset($_POST['cjform_token']))) {
if ($_SESSION['cjform_token'] == $_POST['cjform_token']) {return true;} else {return false;}
} else {return false;}

}
}

function genToken(){

if (getOption('etag')){
	$form = getOption('etagpre');
       // generate a token from an unique value
    	$token = md5(uniqid(microtime(), true));  
    	// Write the generated token to the session variable to check it against the hidden field when the form is sent
    	$_SESSION[$form.'_token'] = $token; 
}

return '<input type="hidden" name="'.$form.'_token" value="'.$token.'" />';

}

function display(){
echo ($this->output);
}
 
}

