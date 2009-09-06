<?php include_once('cjcf/form.inc.php'); ?>
<!doctype HTML>
<html>
<head>
<title>Contact Us!</title>
<style type="text/css">
body { font-family:sans serif; }
textarea { clear:both; }
form#contact-form ol { list-style:none; list-style-type:none; }
label { float:left; }
form#contact-form { width:600px; }
span.error {color:maroon; }
</style>
</head>
<body>
<div id="contact">
<?php /*Echo the final output*/
echo $form->display(); ?>
</div>
</body>
</html>
