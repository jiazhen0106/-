<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
    <title>成績管理系統</title>
    <style>
        #container1{
            padding-top: 240px;
        }
        #container2{
            opacity: 0.9;
            width: 500px;
            text-align: center;
            border-width: 1px;
            margin: 0px auto;
            box-shadow: 3px 3px 5px 6px;
            padding-bottom: 25px;
            padding-top: 20px;
            
        }
        body{
            background: url("bg");
        }
        h1{
            font-family:"微軟正黑體";
            font-size: 60px;
            
        }
        /* #inputpass{
            font-family: 'Langar', cursive;
        } */
        .myButton {
        box-shadow:inset 0px 1px 0px 0px #91b8b3;
        background:linear-gradient(to bottom, #768d87 5%, #6c7c7c 100%);
        background-color:#768d87;
        border-radius:12px;
        display:inline-block;
        cursor:pointer;
        color:#ffffff;
        font-family:Arial;
        font-size:15px;
        font-weight:bold;
        padding:8px 11px;
        text-decoration:none;
        text-shadow:1px 2px 0px #2b665e;
        }
        .myButton:hover {
            background:linear-gradient(to bottom, #6c7c7c 5%, #768d87 100%);
            background-color:#6c7c7c;
        }
        .myButton:active {
            position:relative;
            top:1px;
        }
        input {  
        border:1px solid rgb(246, 246, 196);   
        background:rgb(236, 236, 215);   
        }  
          
    </style>
</head>

<?php
    $host         = "host=127.0.0.1";
    $port         = "port=5432";
    $dataBaseName = "dbname=postgres";
    $user         = "user=postgres";
    $password     = "password=123456";

    $dataBase = pg_connect("$host $port $dataBaseName $user $password ");
    // if(!$dataBase){
    //     echo "Error : Unable to open database";
    // } 
    // else {
    //     echo "Opened database successfully";
    // }

    $postgresql = "pgsql:$host; port=5432; $dataBaseName; $user; $password";

    try{
        $PDO = new PDO($postgresql);

        $accountnumber = null;
        if(isset($_POST["submit"])){
            
            $accountnumber = $_POST["accountnumber"];
               

            $password = $_POST["password"];
            $accountnumberParse = strval($accountnumber);
            $passwordParse = strval($password);
            $account = "SELECT * FROM account";

            $count = 0;
            foreach($PDO->query($account) as $rows){
                if($accountnumber == $rows['accountnumber'] && $password == $rows['password']){
                    session_start();
                    $_SESSION['accountnumber'] = $accountnumber; 
                    if(substr($accountnumberParse, 0, 1) == '4'){
                        header("Location: student.php");
                        $count = 0;
                    }
                    if(substr($accountnumberParse, 0, 1) == '5'){
                        header("Location: professor.php");
                        $count = 0;
                    }
                    if(substr($accountnumberParse, 0 ,1) == '6'){
                        header("Location: controller.php");
                        $count = 0;
                    }
                }
                else{
                    $count++;
                }
            }
            if($count != 0){
                echo "<script>alert('帳號或密碼有錯')</script>";
            }
        }
    }
    catch (PDOException $e){
        echo $e->getMessage();
    }
?>


<body>
    <div class="container" id="container1">
        <div class="container" id="container2">
                <h1>成績管理系統</h1>
                <form action="主頁面.php" method="post">
                    <p id="inputpass">輸入你的帳號密碼</p>
                    <p><input type="text" id="accountnumber" name="accountnumber" placeholder="帳號"></p>
                    <p><input type="password" id="password" name="password" placeholder="密碼"></p>
                    <p><input class="myButton" type="submit" id="submit" name="submit" value="登入" class="button"></p>
                </form>
        </div>
    </div>
    <script>
    </script>

<body>
</html>