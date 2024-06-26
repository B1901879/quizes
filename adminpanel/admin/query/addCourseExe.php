<?php
include("../../../conn.php");

extract($_POST);

$course_name = strtoupper(trim($course_name)); // Normalize case and remove leading/trailing whitespace

$selCourse = $conn->query("SELECT * FROM course_tbl WHERE UPPER(TRIM(cou_name))='$course_name'"); // Case-insensitive and whitespace-insensitive comparison

if ($selCourse->rowCount() > 0) {
    $res = array("res" => "exist", "course_name" => $course_name);
} else {
    $insCourse = $conn->query("INSERT INTO course_tbl(cou_name) VALUES('$course_name') ");
    if ($insCourse) {
        $res = array("res" => "success", "course_name" => $course_name);
    } else {
        $res = array("res" => "failed", "course_name" => $course_name);
    }
}

echo json_encode($res);
?>