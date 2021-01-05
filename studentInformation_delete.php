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
    <title>刪除學生資訊</title>
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

        /* form{
            margin: 50px;
        }
        table, th, tr{
            border: 3px solid yellow;
            margin: 50px;
            text-align: center;
        }   
        td{
            border: 1px solid black;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
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

    $pgSelect = "SELECT * from student_information";

    if (isset($_POST["delete"])) {
        $studentnumber = $_POST["studentnumber"];
        $delete = "DELETE FROM student_information WHERE studentnumber = '" . $studentnumber . "'";
        $transport = pg_query($delete);
    }

    $jsonArray = array();
    $count = 0;
    foreach ($PDO->query($pgSelect) as $rows) {
        $jsonArray[$count] = [
            "studentnumber" => $rows['studentnumber'],
            "name" => $rows['name'],
            "year" => $rows['year']
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
            <form action="studentInformation_delete.php" method="post">
                <h3>請輸入想刪除的學生資料</h3>
                <p><input type="text" id="studentnumber" name="studentnumber" placeholder="學號"></p>
                <p><input class="btn btn-primary" type="submit" id="delete" name="delete" value="刪除">
                <input class="btn btn-primary" type="button" id="back" name="back" value="返回" onclick="Back()"></p>
            </form>

            <table id="table" class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">學號</th>
                        <th scope="col">姓名姓名</th>
                        <th scope="col">入學年</th>
                    </tr>
                </thead>>
            </table>
            <!-- <table id="table" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">學期</th>
                        <th scope="col">課程</th>
                        <th scope="col">課程類型</th>
                        <th scope="col">課程代碼</th>
                        <th scope="col">學生學號</th>
                        <th scope="col">學生姓名</th>
                        <th scope="col">教授</th>
                        <th scope="col">分數</th>
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
                append += "<td>" + value.studentnumber + "</td>";
                append += "<td>" + value.name + "</td>";
                append += "<td>" + value.year + "</td>";
                append += "</tr>";
            });
            $("#table").append(append);
        });

        function Back() {
            window.location.href = 'studentInformation.php';
        }
    </script>

</body>

</html>