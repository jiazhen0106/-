<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
    <title>產生各學生各學期成績單</title>
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
        } */
        h2{
            font-family: "微軟正黑體";
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


<body>
    <div class="container" id="container1">
        <div class="container" id="container2">
            <h2>產生學生成績單</h2>
            <select id="search_semester">
                <option value="1081">108_1</option>
                <option value="1082">108_2</option>
                <option value="1091">109_1</option>
                <option value="1092">109_2</option>
            </select>
            <input type="text" id="search_student_id" placeholder="學生代碼">
            <input type="button" class="btn btn-primary" name="print" id="print" value="印出成績單" onclick="Print(print_parts)">
            <input type="button" class="btn btn-primary" id="search" value="查詢">
            <input type="button" class="btn btn-primary" name="back" id="back" value="返回上一頁" onclick="history.back()">
            <div id="print_parts">
                <!-- <table id=course>
            <thead>
                <tr>
                    <th>開課學期</th>
                    <th>課程代碼</th>
                    <th>課程名稱</th>
                    <th>課程類型</th>
                    <th>學生代碼</th>
                    <th>學生名稱</th>
                    <th>開課教授</th>
                    <th>分數</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table> -->
                <table id="course" class="table table-striped">
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
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function show_all(a) {
            $.each(a, function(key, value) {
                $("#course tbody").append(
                    "<tr>" +
                    "<td>" + value.semester + "</td>" +
                    "<td>" + value.course_id + "</td>" +
                    "<td>" + value.course + "</td>" +
                    "<td>" + value.course_type + "</td>" +
                    "<td>" + value.student_id + "</td>" +
                    "<td>" + value.student + "</td>" +
                    "<td>" + value.professor + "</td>" +
                    "<td>" + value.score + "</td>" +
                    "</tr>");
            });
        }

        function show(c) {
            $.each(c, function(key, value) {
                if (value.semester == $("#search_semester").val() && value.student_id == $("#search_student_id").val()) {
                    $("#course tbody").append(
                        "<tr>" +
                        "<td>" + value.semester + "</td>" +
                        "<td>" + value.course_id + "</td>" +
                        "<td>" + value.course + "</td>" +
                        "<td>" + value.course_type + "</td>" +
                        "<td>" + value.student_id + "</td>" +
                        "<td>" + value.student + "</td>" +
                        "<td>" + value.professor + "</td>" +
                        "<td>" + value.score + "</td>" +
                        "</tr>");
                }
            });
        }

        function clean() {
            $('#course tbody tr').remove();
        }
        $(function() {
            $('#search').on('click', function() {
                $.ajax({
                    url: "bigdata.php",
                    type: "GET",
                    dataType: "json",
                    success: function(abc) {
                        clean();
                        show(abc);
                    },
                    error: function() {
                        alert("Error");
                    }
                })
            })
        })

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

        function Back() {
            window.location.href = 'controller.php';
        }
    </script>
</body>

</html>