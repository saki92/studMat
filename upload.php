<?php

function __autoload($class_name)        {
        include $class_name . '.php';
}

$obj = new footer();
$obj->text();


if(md5($_POST['key'])!="f711b1b7a09153e6ded8772b2b7c4fa5")
	die("Authentication failed!");

$target_path = "uploads/";

$target_path = $target_path . basename($_FILES['uploadedfile']['name']);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	echo "The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded";
	
	$con = mysql_connect("localhost", "sunny_studies", "darkowlzz");
        mysql_select_db("sunny_studies", $con);
	
	$a = $_POST['name'];
	//echo $a;
        $sql = "update subList set entries=entries+1 where name='$a';";

	if(!mysql_query($sql, $con))	{
		die("error: " . mysql_error());
	}
	
	$link = basename($_FILES['uploadedfile']['name']);
	mysql_query("insert into matList (title, sub_name, link) values('$_POST[title]','$_POST[name]', '$link')");

        mysql_close();

} 
else{
    echo "There was an error uploading the file, please try again!";
}
$obj->bottom();
?>
