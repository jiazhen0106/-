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
    <title>列印成績單</title>
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

    $pgSelect = "SELECT * from big_database";

    if (isset($_POST["choose"])) {
        session_start();
        $studentWhose = $_SESSION['accountnumber'];
        if (isset($_POST['select'])) {
            $select = $_POST['select'];
            $pgSelect = "SELECT * from big_database WHERE student_id = '" . $studentWhose . "'AND semester='" . $select . "'";
        }
        //session_destroy();
    }

    $jsonArray = array();
    $count = 0;
    foreach ($PDO->query($pgSelect) as $rows) {
        $jsonArray[$count] = [
            "semester"            => $rows['semester'],
            "course"              => $rows['course'],
            "course_id"           => $rows['course_id'],
            "course_type"         => $rows['course_type'],
            "student_id"          => $rows['student_id'],
            "student"             => $rows['student'],
            "professor"           => $rows['professor'],
            "score"               => $rows['score']
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
            <form action="print_scoreSheet.php" method="post">
                <h2>請選擇要列印成績的學期</h2>
                <select name="select">
                    <option value="1081">108 上學期</option>
                    <option value="1082">108 下學期</option>
                    <option value="1091">109 上學期</option>
                    <option value="1092">109 下學期</option>
                </select>
                <p></p>
                <p><input type="submit" class="btn btn-primary" id="choose" name="choose" value="確定選擇">
                <input type="button" class="btn btn-primary" id="show" name="show" value="顯示" onclick="Show()">
                <input type="button" class="btn btn-primary" id="print" name="print" value="印出成績單" onclick="Print(print_parts)">
                <input type="button" class="btn btn-primary" id="back" name="back" value="返回" onclick="Back()"></p>
            </form>

            <!-- <div id="print_parts">
                <table id="table">
                    <thead>
                        <tr>
                            <th colspan="8">成績單</th>
                        </tr>

                        <tr>
                            <th>學期</th>
                            <th>課程</th>
                            <th>課程類型</th>
                            <th>課程代碼</th>
                            <th>學生學號</th>
                            <th>學生姓名</th>
                            <th>教授</th>
                            <th>分數</th>
                        </tr>
                    </thead>>
                </table>
            </div> -->
            <div id="print_parts">
            <table id="table" class="table table-striped">
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
                <tbody>
                </tbody>
            </table>
            </div> 
    <script type="text/javascript">
        function Show() {
            var json = <?php echo $json; ?>

            $(document).ready(function() {
                $("#table tbody tr").remove();
                var append = "";
                $.each(json, function(key, value) {
                    append += "<tr>";
                    append += "<td>" + value.semester + "</td>";
                    append += "<td>" + value.course + "</td>";
                    append += "<td>" + value.course_type + "</td>";
                    append += "<td>" + value.course_id + "</td>";
                    append += "<td>" + value.student_id + "</td>";
                    append += "<td>" + value.student + "</td>";
                    append += "<td>" + value.professor + "</td>";
                    append += "<td>" + value.score + "</td>";
                    append += "</tr>";
                });
                $("#table tbody").append(append);
            });
        }

        function Back() {
            window.location.href = 'student.php';
        }

        function Print(printlist) {
            var value = printlist.innerHTML;
            var printPage = window.open("", "Printing...", "");
            printPage.document.open();
            printPage.document.write("<HTML><head></head><BODY onload='window.print();window.close()'>");
            printPage.document.write("<PRE>");
            printPage.document.write(value);
            printPage.document.write("</PRE>");
            printPage.document.close("</BODY></HTML>");
        }
    </script>

</body>

</html>