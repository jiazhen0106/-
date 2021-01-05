<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>管理員 學生選課紀錄</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
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

        table {
            border: 1px solid;
            margin: auto;
            width: 800px;
        }

        th,
        td {
            text-align: center;
            border: 1px solid;
        }
    </style>
</head>

<body>
    <div class="container" id="container1">
        <div class="container" id="container2">
            <h2>學生選課紀錄</h2>
            <select id="semester">
                <option value="1081">108_1</option>
                <option value="1082">108_2</option>
                <option value="1091">109_1</option>
                <option value="1092">109_2</option>
            </select>
            <input type="text" id="course_id" placeholder="課程代碼">
            <input type="text" id="course" placeholder="課程名稱">
            <select id="course_type">
                <option value="必修"> 必修</option>
                <option value="選修"> 選修</option>
            </select>
            <input type="text" id="student_id" placeholder="學號">
            <input type="text" id="student" placeholder="學生">
            <input type="text" id="professor_id" placeholder="教授編號">
            <input type="text" id="professor" placeholder="課程教授">



            <input class="btn btn-primary" type="button" name="add" id="add" value="新增">
            <input class="btn btn-primary" type="button" name="delete" id="delete" value="刪除">
            <p></p>
            <h4>請勾選欲修改的資料:</h4>
                <p><select id="update_semester">
                    <option value="1081">108_1</option>
                    <option value="1082">108_2</option>
                    <option value="1091">109_1</option>
                    <option value="1092">109_2</option>
                </select>
                <input type="text" id="update_course_id" placeholder="課程代碼">
                <input type="text" id="update_course" placeholder="課程名稱">
                <select id="update_course_type">
                    <option value="必修"> 必修</option>
                    <option value="選修"> 選修</option>
                </select>
                <input type="text" id="update_professor_id" placeholder="教授編號">
                <input type="text" id="update_professor" placeholder="課程教授">
                <input class="btn btn-primary" type="button"" name="update" id="update" value="修改">
            </p>
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
            <!-- <table id=student_course>
                <thead>
                    <tr>
                        <th>選取</th>
                        <th>學期</th>
                        <th>課程代碼</th>
                        <th>課程名稱</th>
                        <th>課程類型</th>
                        <th>學生學號</th>
                        <th>學生姓名</th>
                        <th>教授編號</th>
                        <th>教授</th>


                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table> -->
            <table id="student_course" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">選取</th>
                        <th scope="col">學期</th>
                        <th scope="col">課程代碼</th>
                        <th scope="col">課程名稱</th>
                        <th scope="col">課程類型</th>
                        <th scope="col">學生學號</th>
                        <th scope="col">學生姓名</th>
                        <th scope="col">教授編號</th>
                        <th scope="col">教授</th>
                    </tr>
                </thead>>
                <tbody>
                </tbody>
            </table>
            <input class="btn btn-primary" type="button" name="back" id="back" value="返回上一頁" onclick="back()">
        </div>
    </div>
</body>
<script>
    function show(a) {
        $.each(a, function(key, value) {
            $("#student_course tbody").append(
                "<tr>" +
                "<td>" + "<input type='checkbox' name='record'>" + "</td>" +
                "<td>" + value.semester + "</td>" +
                "<td>" + value.course_id + "</td>" +
                "<td>" + value.course + "</td>" +
                "<td>" + value.course_type + "</td>" +
                "<td>" + value.student_id + "</td>" +
                "<td>" + value.student + "</td>" +
                "<td>" + value.professor_id + "</td>" +
                "<td>" + value.professor + "</td>" +
                "</tr>");
        });
    }

    function show_semester(c) {
        $.each(c, function(key, value) {
            if (value.semester == $("#search_semester").val()) {
                $("#student_course tbody").append(
                    "<tr>" +
                    "<td>" + "<input type='checkbox' name='record'>" + "</td>" +
                    "<td>" + value.semester + "</td>" +
                    "<td>" + value.course_id + "</td>" +
                    "<td>" + value.course + "</td>" +
                    "<td>" + value.course_type + "</td>" +
                    "<td>" + value.student_id + "</td>" +
                    "<td>" + value.student + "</td>" +
                    "<td>" + value.professor_id + "</td>" +
                    "<td>" + value.professor + "</td>" +
                    "</tr>");
            }
        });
    }

    function show_course_id(c) {
        $.each(c, function(key, value) {
            if (value.course_id == $("#search_course_id").val()) {
                $("#student_course tbody").append(
                    "<tr>" +
                    "<td>" + "<input type='checkbox' name='record'>" + "</td>" +
                    "<td>" + value.semester + "</td>" +
                    "<td>" + value.course_id + "</td>" +
                    "<td>" + value.course + "</td>" +
                    "<td>" + value.course_type + "</td>" +
                    "<td>" + value.student_id + "</td>" +
                    "<td>" + value.student + "</td>" +
                    "<td>" + value.professor_id + "</td>" +
                    "<td>" + value.professor + "</td>" +
                    "</tr>");
            }
        });
    }

    function clean() {
        $('#student_course tbody tr').remove();
    }

    function back() {
        window.location.href = 'controller.php';
    }
    $(function() {
        $.ajax({
            url: "student_course_list.php",
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
                url: "student_course_list.php",
                type: "GET",
                dataType: "json",
                success: function(abc) {
                    clean();
                    show_semester(abc);
                    if (searched_semester == "*") {
                        show(abc)
                    }
                },
                error: function() {
                    alert("Error");
                }
            })
        })
        $('#add').on('click', function() {
            var new_semester = $("#semester").val();
            var new_course_id = $("#course_id").val();
            var new_course = $("#course").val();
            var new_course_type = $("#course_type").val();
            var new_student_id = $("#student_id").val();
            var new_student = $("#student").val();
            var new_professor_id = $("#professor_id").val();
            var new_professor = $("#professor").val();
            $.ajax({
                type: "post",
                url: "student_course_list.php",
                dataType: 'html',
                data: {
                    method_add: "add_func",
                    semester: new_semester,
                    course_id: new_course_id,
                    course: new_course,
                    course_type: new_course_type,
                    student_id: new_student_id,
                    student: new_student,
                    professor_id: new_professor_id,
                    professor: new_professor
                },
                success: function() {
                    $.ajax({
                        url: "student_course_list.php",
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
                    alert("學生" + new_student_id + "已選擇" + new_course_id + new_course + "該課堂");
                }
            });
        });
        $("#delete").on('click', function() {
            $("#student_course tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    var delete_course_id = $(this).parents("tr").children("td").eq(2).text();
                    var delete_student_id = $(this).parents("tr").children("td").eq(5).text();
                    $.ajax({
                        type: "post",
                        url: "student_course_list.php",
                        dataType: 'html',
                        data: {
                            method_delete: "delete_func",
                            course_id: delete_course_id,
                            student_id: delete_student_id
                        },
                        success: function() {
                            $.ajax({
                                url: "student_course_list.php",
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
            $("#student_course tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    var old_course_id = $(this).parents("tr").children("td").eq(2).text();
                    var old_student_id = $(this).parents("tr").children("td").eq(5).text();
                    var update_semester = $("#update_semester").val();
                    var update_course = $("#update_course").val();
                    var update_course_id = $("#update_course_id").val();
                    var update_course_type = $("#update_course_type").val();
                    var update_professor_id = $("#update_professor_id").val();
                    var update_professor = $("#update_professor").val();

                    if (update_course == "") {
                        update_course = $(this).parents("tr").children("td").eq(3).text();
                    }
                    if (update_course_id == "") {
                        update_course_id = $(this).parents("tr").children("td").eq(2).text();
                    }
                    if (update_professor_id == "") {
                        update_professor_id = $(this).parents("tr").children("td").eq(7).text();
                    }
                    if (update_professor == "") {
                        update_professor = $(this).parents("tr").children("td").eq(8).text();
                    }
                    $.ajax({
                        type: "post",
                        url: "student_course_list.php",
                        dataType: 'html',
                        data: {
                            method_update: "update_func",
                            semester: update_semester,
                            course: update_course,
                            course_id: old_course_id,
                            professor_id: update_professor_id,
                            professor: update_professor,
                            course_type: update_course_type,
                            new_course_id: update_course_id,
                            student_id: old_student_id
                        },
                        success: function() {
                            $.ajax({
                                url: "student_course_list.php",
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
                            alert("Error2");
                        }
                    });
                }
            })
        })
    })
</script>
</body>

</html>