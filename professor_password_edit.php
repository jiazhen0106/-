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
    <title>更新帳戶</title>
    <style>
        #container1 {
            padding-top: 100px;
        }

        #container2 {
            opacity: 0.9;
            width: auto;
            text-align: center;
            border-width: 1px;
            margin: 0px auto;
            box-shadow: 3px 3px 5px 6px;
            padding-bottom: 25px;
            padding-top: 20px;
        }

        /* form {
            margin: 50px;
        }

        table,
        th,
        tr {
            border: 3px solid yellow;
            margin: 50px;
            text-align: center;
        }

        td {
            border: 1px solid black;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        } */
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

    $pgSelect = "SELECT * from account";

    if (isset($_POST["edit"])) {
        $accountnumber = $_POST["accountnumber"];
        $password      = $_POST["password"];
        $update = "UPDATE account SET password = '" . $password . "' WHERE accountnumber = '" . $accountnumber . "'";
        $transport = pg_query($update);

        echo "<script> alert('修改密碼完成') </script>";
    }

    $jsonArray = array();
    $count = 0;
    foreach ($PDO->query($pgSelect) as $rows) {
        $jsonArray[$count] = [
            "accountnumber" => $rows['accountnumber'],
            "password" => $rows['password'],
            "id" => $rows['id'],
            "name" => $rows['name']
        ];
        $count++;
    }
    $json = json_encode($jsonArray);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<body>
    <div class="container" id="container1">
        <div class="container" id="container2">
            <form action="professor_password_edit.php" method="post">
                <h3>請輸入你/妳的帳號與新密碼</h3>
                <p><input type="text" id="accountnumber" name="accountnumber" placeholder="帳號"></p>
                <p><input type="text" id="password" name="password" placeholder="密碼"></p>
                <p><input type="submit" class="btn btn-primary" id="edit" name="edit" value="修改">
                    <input type="button" class="btn btn-primary" id="back" name="back" value="返回" onclick="Back()"></p>
            </form>
            <!-- <table id="table">
    <thead>
        <tr>
            <th colspan="6">Table</th>
        </tr>

        <tr>
            <th>account number</th>
            <th>password</th>
            <th>ID</th>
            <th>name</th>
        </tr>
    </thead>>
</table> -->
        </div>
    </div>
    <script>
        var json = <?php echo $json; ?>

        $(document).ready(function() {
            var append = "";
            $.each(json, function(key, value) {
                append += "<tr>";
                append += "<td>" + value.accountnumber + "</td>";
                append += "<td>" + value.password + "</td>";
                append += "<td>" + value.id + "</td>";
                append += "<td>" + value.name + "</td>";
                append += "</tr>";
            });
            $("#table").append(append);
        });

        function Back() {
            window.location.href = 'professor.php';
        }
    </script>

</body>

</html>