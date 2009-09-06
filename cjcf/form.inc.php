<?php
session_start();
function __autoload($class_name) {
    require_once $class_name . '.class.php';
}

$opt = new Config;


$opt->mail = 'someone@example.com'; //Your Email (Send to)
$opt->subject = 'Client Email'; //Email Subject (For your email)
$opt->error = 'There were errors, please fix them'; //Main Error Message
$opt->submit = 'yes!'; //Don't change this, unless you want to disable the email sending (or database), = 'yes!'
$opt->submittext = 'Submit!'; //Text for the Submit Button
$opt->success = '<p>Your Message was Successfully sent. <strong>Thanks!</strong></p>'; //Success Message
$opt->show = true; //Show the message sent, along with a confirmation
$opt->serv = true; //Include server information such as the IP or the Referring URL
$opt->allowHTML = false; //If you wish to allow html tags within messages, type the tags here ('<a><b><br>') etc.
$opt->debug = false; //Show debug information? (false while online, true while testing).
$opt->formID = 'cj-codejoust'; //Contact form ID.
$opt->etag = true; //Use etag spam protection.
$opt->etagpre = 'cjform'; //Prefix for Etag.
$opt->formurl = $_SERVER['PHP_SELF']; //Relative or absolute url to the form (using PHP server variable, might need to be changed, usually not though.
$opt->saveResponse = 'cjcf/submissions.xml'; //Save responses to a file. (set to false to disable) (add an Allow from (yourip) in .htaccess to see the records, or just move the file from the server. (Or password-protect the directory.)

$form  = new Form(); //Creates the Form Object
/**Syntax for adding a field ::
* $form->addF(	The Name Attribute, 
		The Label for the Field,
		The Input Type (optional),
		Error/Invalid Text (optional),
		Field Required? (true or false, no quotes) (optional)
  )
**/
$form->addF('name','Your Name','text','Please enter your name',true);         //Don't Remove, Please! (Used for Email)
$form->addF('email','Your Email','email','Please enter a valid email',true); //Don't Remove, Please! (Used for Email)
$form->addF('subject','Regarding','text','Please type a subject',true);	      //Don't Remove, Please! (Used for Email)
$form->addF('message','My Very Important Message','textarea','Please Include a Message',true);
$form->addF('address','Your address','address');
$form->addF('phone','Your phone','phone');


/*Run the form code*/
$form->run();

/** 
*   To add the form(s) to any page, 
*	just put a <?php include_once('cjcf/form.inc.php'); ?>, at the very beginning of your .php contact page (important! no whitespace, breaks, or anything before it. (Replacing the path with the path to this file) rename and copy this form file for a different page.
*   To echo out the form,
*  	just put <?php $form->display(); ?>
*  
**/
