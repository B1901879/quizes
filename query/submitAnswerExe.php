<?php
// Enable error reporting to display any PHP errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Include database connection
include("../conn.php");

// Extract POST data
extract($_POST);

// Check if exam_id is set
if(isset($exam_id)) {
    // Get examinee ID from session
    $exmne_id = $_SESSION['examineeSession']['exmne_id'];

    // Check if POST data 'answer' is set
    if(isset($_REQUEST['answer'])) {
        // Fetch distinct attempt count
        $atmpCount = $conn->query("SELECT DISTINCT atmpAns FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$exam_id'");
        
        // Check if there are any rows returned
        if($atmpCount->rowCount() > 0) {
            // Calculate new attempt number
            $number = $atmpCount->rowCount() + 1;
        } else {
            $number = 1;
        }

        // Loop through each answer
        foreach ($_REQUEST['answer'] as $key => $value) {
            // Get the value of 'correct'
            $value = $value['correct'];
            
            // Insert answer into database
            $insAns = $conn->query("INSERT INTO exam_answers(axmne_id, exam_id, quest_id, exans_answer, atmpAns) VALUES('$exmne_id', '$exam_id', '$key', '$value', '$number')");
        }

        // Check if answer insertion was successful
        if($insAns) {
            // Insert attempt into database
            $insAttempt = $conn->query("INSERT INTO exam_attempt(exmne_id, exam_id, atmpAns) VALUES('$exmne_id', '$exam_id', '$number')");
            
            // Check if attempt insertion was successful
            if($insAttempt) {
                $res = array("res" => "success");
            } else {
                $res = array("res" => "failed");
            }
        } else {
            $res = array("res" => "failed");
        }
    } else {
        $res = array("res" => "failed");
    }
} else {
    $res = array("res" => "failed");
}

// Encode response as JSON and echo it
echo json_encode($res);
?>