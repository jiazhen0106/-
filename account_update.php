<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>更新帳戶</title>
    <style>
        form {
            margin: 50px;
        }

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

        /* table,
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
        $id            = $_POST["id"];
        $name          = $_POST["name"];
        if($accountnumber!=""&&$password!=""&&$id!=""&&$name!=""){
            $update = "UPDATE account SET accountnumber = '" . $accountnumber . "', password = '" . $password . "', name = '" . $name . "' WHERE id = $id";
            $transport = pg_query($update);
        }
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
            <!-- <form action="account_update.php" method="post">
                <p>請更新想變更的資料</p>
                <p><input type="text" id="accountnumber" name="accountnumber" placeholder="Account number"></p>
                <p><input type="text" id="password" name="password" placeholder="Password"></p>
                <p><input type="text" id="id" name="id" placeholder="ID"></p>
                <p><input type="text" id="name" name="name" placeholder="Name"></p>
                <p><input type="submit" id="edit" name="edit" value="edit"></p>
                <p><input type="button" id="back" name="back" value="back" onclick="Back()"></p>
            </form> -->
            <form action="account_update.php" method="post">
                <div class="form-group">
                    <h3>請更新想變更的資料</h3>
                    <input type="text" class="form-control" id="accountnumber" name="accountnumber" placeholder="帳號">
                    <p></p>
                    <input type="text" class="form-control" id="password" name="password" placeholder="密碼">
                    <p></p>
                    <input type="text" class="form-control" id="id" name="id" placeholder="編號">
                    <p></p>
                    <input type="text" class="form-control" id="name" name="name" placeholder="姓名">
                </div>
                <p><input class="btn btn-primary" type="submit" id="edit" name="edit" value="修改">
                    <input class="btn btn-primary" type="button" id="back" name="back" value="返回上一頁" onclick="Back()"></p>
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
            <table id="table" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">account number</th>
                        <th scope="col">password</th>
                        <th scope="col">ID</th>
                        <th scope="col">name</th>
                    </tr>
                </thead>
            </table>
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
            window.location.href = 'account.php';
        }
    </script>

</body>

</html>