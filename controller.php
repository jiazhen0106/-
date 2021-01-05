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
    <title>管理員專區</title>
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

        /* #container1{
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
            font-family: 'Langar', cursive;
            font-size: 60px;
            
        }
        #inputpass{
            font-family: 'Langar', cursive;
        }
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
        }   */
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
        <div class="contianer" id="container2">
            <form action="controller.php" method="post">
                <h2>管理員老大 選擇你想進行的作業~</p>
                <!-- <p><input type="text" id="id" name="id" placeholder="Account"></p>
            <p><input type="text" id="password" name="password" placeholder="Password"></p> -->
                <!-- <p><input type="button" id="account" name="account" value="帳戶編輯" onclick="Account()"></p>
                <p><input type="button" id="studentinformation" name="studentinformation" value="學生資訊編輯" onclick="studentInformation()"></p>
                <p><input type="button" id="electiveSubjectScore" name="electiveSubjectScore" value="各學期選修成績編輯" onclick="electiveSubjectcore()"></p>
                <p><input type="button" id="createSheet" name="createSheet" value="產生各學生各學期成績單" onclick="CreateSheet()"></p>
                <p><input type="button" id="student_course_choose" name="student_course_choose" value="編輯學生各學期選修課程" onclick="studentcoursechoose()"></p>
                <p><input type="button" id="lesson" name="lesson" value="編輯各學期課程資訊" onclick="course_information()"></p>
                <p><input type="button" id="course_list" value="查看課程清單" onclick="see_course_list()"></p>
                <p><input type="button" id="student_list_of_course" value="查看選課的學生清單" onclick="search_student_list_of_course()"></p>
            </form> -->
            <form action="controller.php" method="post">
                <p>
                    <input class="btn btn-primary" type="button" id="account" name="account" value="帳戶編輯" onclick="Account()">
                    <input class="btn btn-primary" type="button" id="studentinformation" name="studentinformation" value="學生資訊編輯" onclick="studentInformation()">
                    <input class="btn btn-primary" type="button" id="electiveSubjectScore" name="electiveSubjectScore" value="各學期選修成績編輯" onclick="electiveSubjectcore()"></p>
                <p>
                    <input class="btn btn-primary" type="button" id="createSheet" name="createSheet" value="產生各學生各學期成績單" onclick="CreateSheet()">
                </p>
                <p>
                    <input class="btn btn-primary" type="button" id="student_course_choose" name="student_course_choose" value="編輯學生各學期選修課程" onclick="studentcoursechoose()">
                    <input class="btn btn-primary" type="button" id="lesson" name="lesson" value="編輯各學期課程資訊" onclick="course_information()">
                </p>
                <p>
                    <input class="btn btn-primary" type="button" id="course_list" value="查看課程清單" onclick="see_course_list()">
                    <input class="btn btn-primary" type="button" id="student_list_of_course" value="查看選課的學生清單" onclick="search_student_list_of_course()">
                </p>
            </form>
        </div>
    </div>
    <script>
        function Account() {
            window.location.href = 'account.php';
        }

        function studentInformation() {
            window.location.href = 'studentInformation.php';
        }

        function electiveSubjectcore() {
            window.location.href = 'electivecourse_scoreinsert.php';
        }

        function CreateSheet() {
            window.location.href = 'create_student_sheet.php';
        }

        function studentcoursechoose() {
            window.location.href = 'student_course_choose.php';
        }

        function course_information() {
            window.location.href = 'course_information.php';
        }

        function see_course_list() {
            window.location.href = 'course_list.php';
        }

        function search_student_list_of_course() {
            window.location.href = 'students_list_of_courses.php';
        }
    </script>

    <body>

</html>