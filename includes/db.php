<?php

//Creating Values For Connect
$db["db_host"] = "localhost"; //Hostname
$db["db_user"] = "root";      //Username
$db["db_pass"] = "";          //Password
$db["db_name"] = "cms";       //Database

//Converting Values to Constant For Security
foreach ($db as $key => $value){
    define(strtoupper($key), $value);
}

//Connection to the Database with Constant Values
$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);

//Check Connection
if(!$connection){
    echo "DB Connection Failed";
}


