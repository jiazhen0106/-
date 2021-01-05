<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
    <title>課程資訊</title>
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
        h2{
            font-family: "微軟正黑體";
        }
        /* table {
            border: 1px solid;
            margin: auto;
            width: 800px;
        }

        th,
        td {
            text-align: center;
            border: 1px solid;
        } */
    </style>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
</head>

<body>
    <div class="container" id="container1">
        <div class="container" id="container2">
            <h2>課程列表</h2>
            <p>
                <select id="search_semester">
                    <option value="1081">108_1</option>
                    <option value="1082">108_2</option>
                    <option value="1091">109_1</option>
                    <option value="1092">109_2</option>
                    <option value="*">全部</option>
                </select>
                <input class="btn btn-primary" type="button" name="search" id="search" value="查詢">
            </p>

            <table id=course class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">開課學期</th>
                        <th scope="col">課程代碼</th>
                        <th scope="col">課程名稱</th>
                        <th scope="col">課程學分</th>
                        <th scope="col">開課教授</th>
                        <th scope="col">課程類型</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input class="btn btn-primary" type="button" name="back" id="back" value="返回上一頁" onclick="history.back()">
        </div>
    </div>
    <script>
        function show(a) {
            $.each(a, function(key, value) {
                $("#course tbody").append(
                    "<tr>" +
                    "<td>" + value.semester + "</td>" +
                    "<td>" + value.course_id + "</td>" +
                    "<td>" + value.course + "</td>" +
                    "<td>" + value.credit + "</td>" +
                    "<td>" + value.professor + "</td>" +
                    "<td>" + value.course_type + "</td>" +
                    "</tr>");
            });
        }

        function show_semester(c) {
            $.each(c, function(key, value) {
                if (value.semester == $("#search_semester").val()) {
                    $("#course tbody").append(
                        "<tr>" +
                        "<td>" + value.semester + "</td>" +
                        "<td>" + value.course_id + "</td>" +
                        "<td>" + value.course + "</td>" +
                        "<td>" + value.credit + "</td>" +
                        "<td>" + value.professor + "</td>" +
                        "<td>" + value.course_type + "</td>" +
                        "</tr>");
                }
            });
        }

        function clean() {
            $('#course tbody tr').remove();
        }
        $(function() {
            $.ajax({
                url: "course_information_list.php",
                type: "GET",
                dataType: "json",
                success: function(abc) {
                    show(abc);
                },
                error: function() {
                    alert("Error");
                }
            })
            $('#search').on('click', function() {
                var searched_semester = $("#search_semester").val();
                $.ajax({
                    url: "course_information_list.php",
                    type: "GET",
                    dataType: "json",
                    success: function(abc) {
                        clean();
                        show_semester(abc);
                        if (searched_semester == "*") {
                            clean();
                            show(abc);
                        }
                    },
                    error: function() {
                        alert("Error");
                    }
                })
            })
        })
    </script>
</body>

</html>