<!doctype HTML>
<html>
<head>

<!-- Add you own styling etc here! -->







</head>
<body>
<?php

$pass = 'test';//Set your password here IMPORTANT!
$filename = 'cjcf/submissions.xml';

if ($_POST['pass-auth'] == $pass){

$xml = simplexml_load_file($filename);

foreach ($xml->submission as $submission){
echo('<div class="submission"><h5>'.$submission->attributes()->date.'</h5>');

foreach ($submission->children() as $field){
echo('<p><span class="val">'.$field->getName().'</span>:<span class="val"> '.$field.'</span></p>');
}

echo('</div>');
}


}

else {

?>
<form action="" method="post"><label for="pass">Password:</label><input type="text" name="pass-auth" value="" /><input type="submit" /></form>
<?php

}
?>
</body>
</html>
