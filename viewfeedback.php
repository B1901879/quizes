<?php
include('conn.php');
session_start();

// Fetch the logged-in student's ID from the session
$exmne_id = $_SESSION['examineeSession']['exmne_id'];

// Fetch feedback for the logged-in student from admin_feedbacks_tbl
$feedbackQuery = $conn->prepare("SELECT * FROM admin_feedbacks_tbl WHERE exmne_id = ?");
$feedbackQuery->execute([$exmne_id]);
$feedbacks = $feedbackQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #e0f7fa;
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            font-size: 24px;
        }
        .feedback {
            margin: 10px 0;
            padding: 10px;
            background-color: #ffffff;
            border-left: 4px solid #4CAF50;
            border-radius: 5px;
        }
        .no-feedback {
            text-align: center;
            color: #888;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Feedback from Teachers</h2>
        
        <?php if (empty($feedbacks)): ?>
            <p class="no-feedback">There is no feedback from the teacher, please check again later :)</p>
        <?php else: ?>
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="feedback">
                    <p><strong>Feedback:</strong> <?= $feedback['fb_feedbacks'] ?></p>
                    <p><strong>Date:</strong> <?= $feedback['fb_date'] ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
