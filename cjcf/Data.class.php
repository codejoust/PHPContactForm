<?php
/*Data Class. Can be used for Email, Databases, and such*/

class Data{
public $opts;
public $server;
private $fields;
private $message;
private $result;

function __construct($msg, $f){
    $this->getServ();
    $this->message = $msg . $this->getServ();
   if (getOption('show')){ $this->result = $msg . getOption('success'); }
   else { $this->result = getOption('success'); }
    $this->fields = $f;
    $this->sendMail();
    if (getOption('saveResponse')){
    $this->saveResponse();
    }
    
    }

function sendMail(){
$reply = getOption('email');
$messageproper = "From: \"{$this->fields['name']->val}\" <{$this->fields['email']->val}>\r\nReply-To:<{$this->fields['email']->val}>\r\nX-Mailer: CodeJoust Contact Form :)";
try {
mail(getOption('mailto'), getOption('subject'), $messageproper, $this->message);
return true;
}
catch (Exception $e){
if (!getOption('debug')){ $e = ''; }
die ('Unable to send email for an unknown reason. :' .$e.':');
return false;
}

}
function saveResponse(){

try {
$xml = simplexml_load_file(getOption('saveResponse'));

$submission = $xml->addChild('submission');

foreach ($this->fields as $field){
$submission->addChild($field->name, $field->val); 
}

$submission->addAttribute('date',date("r"));

$fp = fopen(getOption('saveResponse'), 'w');
fwrite($fp, $xml->asXML());
fclose($fp);

}
catch (Exception $e){

}


}
function getServ(){
if (getOption('serv')){
$string = "IP - {$_SERVER['REMOTE_IP']} : Ref - {$_SERVER['HTTP_REFERER']}";
return $this->server = $string;}
}

function result(){
return $this->result;
}

}
