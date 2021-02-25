<?php

function loginBackend(): string
{
    global $connection;
    if(isset($_POST["submit"])){

        $users_username_mail = $_POST["users_username_mail"];
        $users_password = $_POST["users_password"];

        if(empty($users_username_mail) || empty($users_password)){
            return "O";
        }

        //Determine Username or Mail
        if(str_contains($users_username_mail,"@")){
            $variable = "users_mail";
        }
        else{
            $variable = "users_username";
        }

        $query = "SELECT * FROM users";
        $select_from_table = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_from_table)){

            if($variable == "users_mail"){
                $table_variable = $row['users_mail'];
            }
            else{
                $table_variable = $row['users_username'];
            }
            $table_pass = $row["users_password"];

            if($users_username_mail === $table_variable && $users_password === $table_pass){
                return 'T';
            }
        }
        return 'F';
    }
    return "O";
}

function registerBackend()
{
    //Register Backend
    global $connection;
    if(isset($_POST["signup"])){

        $users_name = $_POST["users_name"];
        $users_username = $_POST["users_username"];
        $users_mail = $_POST["users_mail"];
        $users_password = $_POST["users_password"];
        $users_re_password = $_POST["users_re_password"];

        //Controls Before Register
        $flag = checkRules($users_name,$users_username,$users_mail,$users_password,$users_re_password);

        if($flag == "T"){

            $query = "INSERT INTO users (users_username,users_name,users_mail,users_password) VALUES ('$users_username','$users_name','$users_mail','$users_password')";
            $add_to_db = mysqli_query($connection,$query);
            echo "<strong>Register Completed Successfully</strong>";
        }
    }
}

function checkRules($users_name,$users_username,$users_mail,$users_password,$users_re_password): string
{
    global $connection;
    $rules_check = array();

    //Checking Agree-Term Checkbox
    if(empty($_POST["agree_term"])){
        echo "<strong>You Must Agree Terms For Register<br></strong>";
        array_push($rules_check,"F");
    }

    //Checking Invalid Symbols For Name
    $name_array = str_split($users_name);
    foreach ($name_array as $letter){

        if((ord($letter) >=65 && ord($letter) <=90) || (ord($letter) >=97 && ord($letter) <=122 || $letter == " ")){
            continue;
        }else{
            echo "<strong>Invalid Name<br></strong>";
            array_push($rules_check,"F");
            break;
        }
    }

    //Checking Invalid Symbols For Username
    $name_array = str_split($users_username);
    foreach ($name_array as $letter){

        if((ord($letter) >=65 && ord($letter) <=90) || (ord($letter) >=97 && ord($letter) <=122 || $letter == " ")){
            continue;
        }else{
            echo "<strong>Invalid Username<br></strong>";
            array_push($rules_check,"F");
            break;
        }
    }

    //Checking Mail Format
    if((str_contains($users_mail,"@hotmail.com") || str_contains($users_mail,"@gmail.com") || str_contains($users_mail,"@outlook.com") || str_contains($users_mail,"@yandex.com")) == 0){
        echo "<strong>Invalid Email<br></strong>";
        array_push($rules_check,"F");
    }

    //Checking Pass and Repass equality
    if($users_password !== $users_re_password){
        echo "<strong>Passwords dont match<br></strong>";
        array_push($rules_check,"F");
    }

    //Checking Pass For at least 8 char one upper one lower and one number condition
    $pass_array = str_split($users_password);
    $flags = array();
    //Upper Letter
    foreach ($pass_array as $char){
        if(ord($char)<=90 && ord($char)>=65){
            array_push($flags,"T");
            break;
        }
    }
    //Lower Letter
    foreach ($pass_array as $char){
        if(ord($char)<=122 && ord($char)>=97){
            array_push($flags,"T");
            break;
        }
    }
    //Number
    foreach ($pass_array as $char){
        if(ord($char)<=57 && ord($char)>=48){
            array_push($flags,"T");
            break;
        }
    }
    //Size
    if(strlen($users_password) >=8){
        array_push($flags,"T");
    }

    //Check Flag Size
    if(count($flags) != 4){
        echo "<strong>Password Must be Bigger than 8 Characters and Must Include Least One Upper, Lower and Number Characters<br></strong>";
        array_push($rules_check,"F");
    }

    //Check Database For Mail
    $query = "SELECT * FROM users";
    $select_mails = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_mails)){

        if($users_mail === $row["users_mail"]){
            echo "<strong>This User Already Exists<br></strong>";
            array_push($rules_check,"F");
            break;
        }

    }

    //Checking Rule Array For Decide
    if(empty($rules_check)){
        return "T";
    }
    else{
        return "F";
    }

}