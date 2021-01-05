<?php
function get_pdo(){
    $host        = "127.0.0.1";
    $port        = "5432";
    $dbname      = "postgres";
    $user        ="postgres";
    $password    ="123456";
    $dsn="pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
    $dbh = new PDO($dsn); 
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
  }
function get_source(){
$sql= "SELECT * FROM big_database";
$connect = get_pdo();
$stmt= $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
$show_student_course=json_encode($stmt->fetchAll());
echo($show_student_course);
return $show_student_course;
}
$abc=get_source();
function add_to_big_database($semester,$course_id ,$course,$course_type,$student_id,$student,$professor_id,$professor,$score) {
    $sql = "INSERT INTO big_database(semester,course_id ,course,course_type,student_id,student,professor_id,professor,score)
            VALUES(:semester,:course_id ,:course,:course_type,:student_id,:student,:professor_id,:professor,:score)";
        $connect = get_pdo();
        $stmt = $connect->prepare($sql);
    
        $stmt->bindValue(':semester', $semester);
        $stmt->bindValue(':course_id', $course_id);
        $stmt->bindValue(':course', $course);
        $stmt->bindValue(':course_type',$course_type);
        $stmt->bindValue(':student_id', $student_id);
        $stmt->bindValue(':student', $student);
        $stmt->bindValue(':professor_id', $professor_id);
        $stmt->bindValue(':professor', $professor);
        $stmt->bindValue(':score', $score);
        
        $stmt->execute();
        return;
}

// $abc= add_to_big_database("1092","4","A","必修","410877034","鄭旭晴","510877002","喵喵",100);
// if (isset($_POST["method_add"])){
//     $semester=$_POST["semester"];
//     $course =$_POST["course"];
//     $course_id=$_POST["course_id"];
//     $class=$_POST["class"];
//     $professor=$_POST["professor"];
//     $course_type=$_POST["course_type"];
//     $student_id=$_POST["student_id"];
//     add_to_student_course_list($semester, $course,$course_id,$class,$professor,$course_type,$student_id);
// }
// if (isset($_POST["method_delete"])){
//     $course_id=$_POST["course_id"];
//     $student_id=$_POST["student_id"];
//     delete_student_course_list($course_id,$student_id);
// }
// if (isset($_POST["method_update"])){
//     $semester=$_POST["semester"];
//     $course =$_POST["course"];
//     $course_id=$_POST["course_id"];
//     $class=$_POST["class"];
//     $professor=$_POST["professor"];
//     $course_type=$_POST["course_type"];
//     $student_id=$_POST["student_id"];
//     $new_course_id=$_POST["new_course_id"];
//     update_to_student_course_list($semester, $course,$course_id,$class,$professor,$course_type,$student_id,$new_course_id);
// }
?>