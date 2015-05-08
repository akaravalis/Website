
<?php

require_once 'DB_info.php';
require_once 'UTILS.php';

session_start(); 

$UserID = $_POST["UserID"];
$UserPass = $_POST["UserPass"];


//Create connection to database 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM $myUsers WHERE UserID='$UserID' AND UserPass='$UserPass'";
$result = $conn->query($sql);

//checkErrorReturn is a simple error-reporting and link-offering 
//function written in UTILS.php 
//Generally, you should put such auxliary functions in separte 
//files which can be imported from several scripts
checkErrorReturn
    ($result->num_rows == 0, 
     "This User name or Password you Enter is Invalid", 
     "Back to the signin page", 
     "index.html"); 

//$row = $result->fetch_assoc(); 

//Store the UserID in the session array, to make it available 
//to the next page, namely mainpage
$_SESSION['UserID'] = $UserID; 
$_SESSION['Location'] = $Location;

//Instruct client to switch to a new location: 
header("Location: mainpage.php");

?> 
