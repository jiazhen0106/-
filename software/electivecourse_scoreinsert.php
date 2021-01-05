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
    <title>新增學生各學期選修成績</title>
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

    //$pgSelect = "SELECT * from student_information";
    $pgSelect = "SELECT * from big_database";

    if (isset($_POST["insert"])) {
        $semester      = $_POST["semester"];
        $course_id     = $_POST["course_id"];
        $student_id    = $_POST["student_id"];
        $professor     = $_POST["professor"];
        $score         = $_POST["score"];
        if($semester!=""&&$course_id!=""&&$student_id!=""&&$professor!=""&&$score!=""){
            $insert = "UPDATE big_database SET score=$score
                WHERE semester='" . $semester . "' AND course_id = '" . $course_id . "' AND student_id='" . $student_id . "' AND professor='" . $professor . "'";
            $transport = pg_query($insert);
        }
    }

    $jsonArray = array();
    $count = 0;
    foreach ($PDO->query($pgSelect) as $rows) {
        $jsonArray[$count] = [
            "semester"            => $rows['semester'],
            "course_id"           => $rows['course_id'],
            "course"              => $rows['course'],
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
            <form action="electivecourse_scoreinsert.php" method="post">
                <h2>請選擇學期並新增學生的選修成績</h2>
                <h3>輸入課程代碼、學生ID、該課的教授名字及想給學生的分數~~</h3>
                <select id="semester" name="semester">
                    <option value="1081">108_1</option>
                    <option value="1082">108_2</option>
                    <option value="1091">109_1</option>
                    <option value="1092">109_2</option>
                </select>
                <p></p>
                <p><input type="text" id="course_id" name="course_id" placeholder="課程代碼"></p>
                <p><input type="text" id="student_id" name="student_id" placeholder="學生學號"></p>
                <p><input type="text" id="professor" name="professor" placeholder="教授名稱"></p>
                <p><input type="text" id="score" name="score" placeholder="分數"></p>
                <p><input type="submit" class="btn btn-primary" id="insert" name="insert" value="輸入">
                    <input type="button" class="btn btn-primary" id="back" name="back" value="返回" onclick="Back()"></p>
                
            </form>

            <table id="table" class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">學期</th>
                        <th scope="col">課程代碼</th>
                        <th scope="col">課程名稱</th>
                        <th scope="col">課程類型</th>
                        <th scope="col">學生代碼</th>
                        <th scope="col">學生</th>
                        <th scope="col">教授</th>
                        <th scope="col">分數</th>
                    </tr>
                </thead>>
            </table>
            <!-- <table id="course" class="table table-striped">
                    <thead>

                        <tr>
                            <th scope="col">開課學期</th>
                            <th scope="col">課程代碼</th>
                            <th scope="col">課程名稱</th>
                            <th scope="col">課程類型</th>
                            <th scope="col">學生代碼</th>
                            <th scope="col">學生名稱</th>
                            <th scope="col">開課教授</th>
                            <th scope="col">分數</th>
                        </tr>
                    </thead>
                </table> -->
        </div>
    </div>

    <script>
        var json = <?php echo $json; ?>

        $(document).ready(function() {
            var append = "";
            $.each(json, function(key, value) {
                append += "<tr>";
                append += "<td>" + value.semester + "</td>";
                append += "<td>" + value.course_id + "</td>";
                append += "<td>" + value.course + "</td>";
                append += "<td>" + value.course_type + "</td>";
                append += "<td>" + value.student_id + "</td>";
                append += "<td>" + value.student + "</td>";
                append += "<td>" + value.professor + "</td>";
                append += "<td>" + value.score + "</td>";
                append += "</tr>";
            });
            $("#table").append(append);
        });

        function Back() {
            window.location.href = 'electivecourse_editscore.php';
        }
    </script>
</body>

</html>