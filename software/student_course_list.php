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

function add_to_big_database($semester,$course_id ,$course,$course_type,$student_id,$student,$professor_id,$professor) {
    $sql = "INSERT INTO big_database(semester,course_id ,course,course_type,student_id,student,professor_id,professor)
            VALUES(:semester,:course_id ,:course,:course_type,:student_id,:student,:professor_id,:professor)";
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
        
        $stmt->execute();
        return;
}
function delete_big_database($course_id,$student_id){
    $sql="DELETE FROM big_database WHERE  course_id = :course_id AND student_id=:student_id";
    $connect = get_pdo();
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(":course_id", $course_id);
    $stmt->bindValue(":student_id", $student_id);
    $stmt->execute();
    
    return $stmt->rowCount();
    }
function update_to_big_database($semester,$course_id ,$course,$course_type,$student_id,$professor_id,$professor,$new_course_id){
    $sql="UPDATE big_database SET semester=:semester,course=:course,course_id=:new_course_id,course_type=:course_type,professor_id=:professor_id,professor=:professor
    WHERE (course_id = :course_id AND student_id=:student_id)";
    $connect = get_pdo();
    $stmt = $connect->prepare($sql);
    
    $stmt->bindValue(':new_course_id', $new_course_id);
    $stmt->bindValue(':semester', $semester);
    $stmt->bindValue(':course_id', $course_id);
    $stmt->bindValue(':course', $course);
    $stmt->bindValue(':course_type',$course_type);
    $stmt->bindValue(':student_id', $student_id);
    $stmt->bindValue(':professor_id', $professor_id);
    $stmt->bindValue(':professor', $professor);
    
    $stmt->execute();
    return;
}
$abc= get_source();
if (isset($_POST["method_add"])){
    $semester=$_POST["semester"];
    $course_id=$_POST["course_id"];
    $course =$_POST["course"];
    $course_type=$_POST["course_type"];
    $student_id=$_POST["student_id"];
    $student=$_POST["student"];
    $professor_id=$_POST["professor_id"];
    $professor=$_POST["professor"];
    add_to_big_database($semester,$course_id ,$course,$course_type,$student_id,$student,$professor_id,$professor);
}
if (isset($_POST["method_delete"])){
    $course_id=$_POST["course_id"];
    $student_id=$_POST["student_id"];
    delete_big_database($course_id,$student_id);
}
if (isset($_POST["method_update"])){
    $semester=$_POST["semester"];
    $course =$_POST["course"];
    $course_id=$_POST["course_id"];
    $professor_id=$_POST["professor_id"];
    $professor=$_POST["professor"];
    $course_type=$_POST["course_type"];
    $student_id=$_POST["student_id"];
    $new_course_id=$_POST["new_course_id"];
    update_to_big_database($semester,$course_id ,$course,$course_type,$student_id,$professor_id,$professor,$new_course_id);
}
?>