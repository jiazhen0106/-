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
$sql= "SELECT * FROM course_information";
$connect = get_pdo();
$stmt= $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
$show_student_course=json_encode($stmt->fetchAll());
echo($show_student_course);
return $show_student_course;
}
// $a=add_to_course_information("1081","3","軟體工程",3,"葉道明","必修");
function add_to_course_information($semester, $course_id,$course,$credit,$professor,$course_type) {
    $sql = "INSERT INTO course_information(semester,course_id,course,credit,professor,course_type)
            VALUES(:semester,:course_id,:course,:credit,:professor,:course_type)";
        $connect = get_pdo();
        $stmt = $connect->prepare($sql);
    
        $stmt->bindValue(':semester', $semester);
        $stmt->bindValue(':course', $course);
        $stmt->bindValue(':course_id', $course_id);
        $stmt->bindValue(':credit', $credit);
        $stmt->bindValue(':professor', $professor);
        $stmt->bindValue(':course_type', $course_type);
        
        $stmt->execute();
        return;
}
// $b=delete_course_information("1");
function delete_course_information($course_id){
    $sql="DELETE FROM course_information WHERE  course_id = :course_id";
    $connect = get_pdo();
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(":course_id", $course_id);
    $stmt->execute();
    
    return $stmt->rowCount();
    }
// $c=update_to_course_information("1081","2","多媒體概論",2,"郭家旭","選修","1");
function update_to_course_information($semester,$course_id,$course,$credit,$professor,$course_type,$new_course_id){
    $sql="UPDATE course_information SET semester=:semester,course=:course,course_id=:new_course_id,credit=:credit,professor=:professor,course_type=:course_type
    WHERE course_id = :course_id";
    $connect = get_pdo();
    $stmt = $connect->prepare($sql);
    
    $stmt->bindValue(':semester', $semester);
    $stmt->bindValue(':course', $course);
    $stmt->bindValue(':course_id', $course_id);
    $stmt->bindValue(':credit', $credit);
    $stmt->bindValue(':professor', $professor);
    $stmt->bindValue(':course_type', $course_type);  
    $stmt->bindValue(':new_course_id', $new_course_id);
    
    $stmt->execute();
    return;
}
$abc= get_source();
if (isset($_POST["method_add"])){
    $semester=$_POST["semester"];
    $course =$_POST["course"];
    $course_id=$_POST["course_id"];
    $credit=$_POST["credit"];
    $professor=$_POST["professor"];
    $course_type=$_POST["course_type"];
    add_to_course_information($semester, $course_id,$course,$credit,$professor,$course_type);
}
if (isset($_POST["method_delete"])){
    $course_id=$_POST["course_id"];
    delete_course_information($course_id);
}
if (isset($_POST["method_update"])){
    $semester=$_POST["semester"];
    $course =$_POST["course"];
    $course_id=$_POST["course_id"];
    $credit=$_POST["credit"];
    $professor=$_POST["professor"];
    $course_type=$_POST["course_type"];
    $new_course_id=$_POST["new_course_id"];
    update_to_course_information($semester,$course_id,$course,$credit,$professor,$course_type,$new_course_id);
}
?>