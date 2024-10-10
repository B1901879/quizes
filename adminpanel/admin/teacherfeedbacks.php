<?php
include('../../conn.php');
session_start();

// Fetch all students for the dropdown
$studentsQuery = $conn->query("SELECT exmne_id, exmne_fullname FROM examinee_tbl");
$students = $studentsQuery->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exmne_id = $_POST['student_id'];
    $feedback = $_POST['feedback'];
    
    // Insert feedback into the admin_feedbacks_tbl
    $stmt = $conn->prepare("INSERT INTO admin_feedbacks_tbl (exmne_id, fb_admin_as, fb_feedbacks, fb_date) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$exmne_id, 'Teacher', $feedback]);
    
    // Alert the user and redirect to the home page after submission
    echo "<script>alert('Feedback submitted successfully!'); window.location.href='home.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #e6f7ff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 14px;
            color: #333;
        }
        select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        select {
            margin-bottom: 20px; /* Adding margin between select and textarea */
        }
        textarea {
            resize: none;
            height: 100px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Feedback for a Student</h2>
        <form method="POST" action="">
            <label for="student_id">Select Student:</label>
            <select name="student_id" required>
                <option value="">Select a student</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student['exmne_id'] ?>"><?= $student['exmne_fullname'] ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            
            <label for="feedback">Feedback:</label>
            <textarea name="feedback" required placeholder="Enter feedback here..."></textarea>
            <br>
            
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
