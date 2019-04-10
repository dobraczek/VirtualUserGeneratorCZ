<?php

/**
 * User Virtual Generator CZ
 * @author Martin Dobry
 * @link http://webscript.cz
 * @version 1.0
 */

include "UserVirtual.php";
$UserGenerator = new VirtualUserGeneratorCZ\User();
$User = $UserGenerator->getUser();


?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title>Virtual User Generator CZ</title>
	
	<meta content="" name="keywords">
	<meta content="" name="author">
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

    <h1>Virtual User Generator CZ</h1>
    
    <?php
    foreach($User as $key => $value)
        echo '<strong>['.$key.']</strong>: '.$value.'<br />';
    ?>

</body>
</html>
