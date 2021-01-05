<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>刪除帳戶</title>
    <style>
        form {
            margin: 50px;
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

    $pgSelect = "SELECT * from account";

    if (isset($_POST["delete"])) {
        $id = $_POST["id"];
        $delete = "DELETE FROM account WHERE id = $id";
        $transport = pg_query($delete);
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
    <!-- <div class="container">
        <form action="account_delete.php" method="post">
            <p>請輸入想刪除的資料</p>
            <p><input type="text" id="id" name="id" placeholder="ID"></p>
            <p><input type="submit" id="delete" name="delete" value="delete"></p>
            <p><input type="button" id="back" name="back" value="back" onclick="Back()"></p>
        </form>
    </div> -->
    <div class="container" id="container1">
        <div class="container" id="container2">
            <form action="account_delete.php" method="post">
                <div class="form-group">
                    <h3>請輸入想刪除的資料</h3>
                    <input type="text" class="form-control" id="id" name="id" placeholder="編號">
                </div>
                <p><input class="btn btn-primary" type="submit" id="delete" name="delete" value="刪除">
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
            <table  id="table" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">帳戶</th>
                        <th scope="col">密碼</th>
                        <th scope="col">編號</th>
                        <th scope="col">姓名</th>
                    </tr>
                </thead>
            </table>
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