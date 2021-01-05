<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
    <title>學生資訊編輯</title>
    <style>
        #container1 {
            padding-top: 100px;
        }

        #container2 {
            opacity: 0.9;
            width: 500px;
            text-align: center;
            border-width: 1px;
            margin: 0px auto;
            box-shadow: 3px 3px 5px 6px;
            padding-bottom: 25px;
            padding-top: 20px;
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

$postgresql = "pgsql:$host; port=5432; $dataBaseName; $user; $password";
try {
    $PDO = new PDO($postgresql);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<body>
    <div class="container" id="container1">
        <div class="container" id="container2">
            <form action="studentInformation.php" method="get">
                <h3>請進行學生資訊管理</h3>
                <p></p>
                <p><input class="btn btn-primary" type="button" id="insert" name="insert" value="新增學生資訊" onclick="Insert()">
                    <input class="btn btn-primary" type="button" id="edit" name="edit" value="修改學生資訊" onclick="Edit()"></p>
                <p><input class="btn btn-primary" type="button" id="delete" name="delete" value="刪除學生資訊" onclick="Delete()">
                    <input class="btn btn-primary" type="button" id="back" name="back" value="返回上一頁" onclick="Back()"></p>
            </form>
        </div>
    </div>
    <script>
        function Insert() {
            window.location.href = 'studentInformation_insert.php';
        }

        function Edit() {
            window.location.href = 'studentInformation_update.php';
        }

        function Delete() {
            window.location.href = 'studentInformation_delete.php';
        }

        function Back() {
            window.location.href = 'controller.php';
        }
    </script>

    <body>

</html>