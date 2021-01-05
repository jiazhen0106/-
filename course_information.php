<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
    <title>管理員 課程資訊</title>
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
            
            margin: auto;
            width: 800px;
        } */

        /* th,
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
            <h2>管理員 課程資訊</h3><br>
            <input type="text" id="course_id" placeholder="課程代碼">
            <input type="text" id="course" placeholder="課程名稱">
            <input type="text" id="credit" placeholder="課程學分">
            <input type="text" id="professor" placeholder="課程教授">
            <select id="course_type">
                <option value="必修"> 必修</option>
                <option value="選修"> 選修</option>
            </select>
            <select id="semester">
                <option value="1081">108_1</option>
                <option value="1082">108_2</option>
                <option value="1091">109_1</option>
                <option value="1092">109_2</option>
            </select>
            <input class="btn btn-primary" type="button" name="add" id="add" value="新增">
            <input class="btn btn-primary" type="button" name="delete" id="delete" value="刪除">
            <input class="btn btn-primary" type="button" name="update" id="update" value="修改">
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
                        <th scope="col">選取</th>
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
            <p></p>
            <input class="btn btn-primary" type="button" name="back" id="back" value="返回上一頁" onclick="back()">
        </div>
    </div>
    <script>
        function show(a) {
            $.each(a, function(key, value) {
                $("#course tbody").append(
                    "<tr>" +
                    "<td>" + "<input type='checkbox' name='record'>" + "</td>" +
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
                        "<td>" + "<input type='checkbox' name='record'>" + "</td>" +
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

        function back() {
            window.location.href = 'controller.php';
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
            $('#add').on('click', function() {
                var new_semester = $("#semester").val();
                var new_course = $("#course").val();
                var new_course_id = $("#course_id").val();
                var new_credit = $("#credit").val();
                var new_professor = $("#professor").val();
                var new_course_type = $("#course_type").val();
                $.ajax({
                    type: "post",
                    url: "course_information_list.php",
                    dataType: 'html',
                    data: {
                        method_add: "add_func",
                        semester: new_semester,
                        course: new_course,
                        course_id: new_course_id,
                        credit: new_credit,
                        professor: new_professor,
                        course_type: new_course_type
                    },
                    success: function() {
                        $.ajax({
                            url: "course_information_list.php",
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
                    },
                    error: function() {
                        if (new_semester == "" || new_course == "" || new_course_id == "" || new_credit == "" || new_professor == "" || new_course_type == "") {
                            alert("請填寫所有資料")
                        }
                    }
                });
            });
            $("#delete").on('click', function() {
                $("#course tbody").find('input[name="record"]').each(function() {
                    if ($(this).is(":checked")) {
                        var delete_course_id = $(this).parents("tr").children("td").eq(2).text();
                        $.ajax({
                            type: "post",
                            url: "course_information_list.php",
                            dataType: 'html',
                            data: {
                                method_delete: "delete_func",
                                course_id: delete_course_id
                            },
                            success: function() {
                                $.ajax({
                                    url: "course_information_list.php",
                                    type: "GET",
                                    dataType: "json",
                                    success: function(abc) {
                                        clean()
                                        show(abc);
                                    },
                                    error: function() {
                                        alert("Error");
                                    }
                                })
                            },
                            error: function() {
                                alert("Error ");
                            }
                        });
                    }
                });
            });
            $("#update").on('click', function() {
                $("#course tbody").find('input[name="record"]').each(function() {
                    if ($(this).is(":checked")) {
                        var old_course_id = $(this).parents("tr").children("td").eq(2).text();
                        var update_semester = $("#semester").val();
                        var update_course = $("#course").val();
                        var update_course_id = $("#course_id").val();
                        var update_credit = $("#credit").val();
                        var update_professor = $("#professor").val();
                        var update_course_type = $("#course_type").val();
                        if (update_course == "") {
                            update_course = $(this).parents("tr").children("td").eq(3).text();
                        }
                        if (update_course_id == "") {
                            update_course_id = $(this).parents("tr").children("td").eq(2).text();
                        }
                        if (update_credit == "") {
                            update_credit = $(this).parents("tr").children("td").eq(4).text();
                        }
                        if (update_professor == "") {
                            update_professor = $(this).parents("tr").children("td").eq(5).text();
                        }
                        $.ajax({
                            type: "post",
                            url: "course_information_list.php",
                            dataType: 'html',
                            data: {
                                method_update: "update_func",
                                semester: update_semester,
                                course: update_course,
                                course_id: old_course_id,
                                credit: update_credit,
                                professor: update_professor,
                                course_type: update_course_type,
                                new_course_id: update_course_id,
                            },
                            success: function() {
                                $.ajax({
                                    url: "course_information_list.php",
                                    type: "GET",
                                    dataType: "json",
                                    success: function(abc) {
                                        clean();
                                        show(abc);
                                    },
                                    error: function() {
                                        alert("Error1");
                                    }
                                })
                            },
                            error: function() {
                                for (var i = 0; i < $("#course tbody").children("tr").length; i++) {
                                    if (update_course_id == $("#course tbody").children("tr").eq(i).children("td").eq(2).text()) {
                                        alert("課程代碼不得重複")
                                    }
                                }
                            }
                        });
                    }
                })
            })
        })
    </script>
</body>

</html>