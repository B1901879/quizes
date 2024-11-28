<?php
include('conn.php');
session_start();

// Fetch the logged-in student's ID from the session
$exmne_id = $_SESSION['examineeSession']['exmne_id'];

// Fetch feedback for the logged-in student from admin_feedbacks_tbl
$feedbackQuery = $conn->prepare("SELECT * FROM admin_feedbacks_tbl WHERE exmne_id = ?");
$feedbackQuery->execute([$exmne_id]);
$feedbacks = $feedbackQuery->fetchAll(PDO::FETCH_ASSOC);

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_content'])) {
    $fb_id = $_POST['fb_id'];
    $reply_content = $_POST['reply_content'];

    $insertReply = $conn->prepare("INSERT INTO feedback_replies_tbl (fb_id, exmne_id, reply_content) VALUES (?, ?, ?)");
    $insertReply->execute([$fb_id, $exmne_id, $reply_content]);

    // Redirect to prevent form resubmission
    header("Location: viewfeedback.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <!-- Include Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #e0f7fa;
            border-radius: 10px;
            box-sizing: border-box; /* Ensure padding doesn't cause overflow */
        }
        h2 {
            text-align: center;
            font-size: 24px;
        }
        .back-button {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            margin-bottom: 20px; /* Adds space below the button */
        }
        .back-button:hover {
            background-color: #0d8bf2;
        }
        .back-button i {
            margin-right: 8px; /* Adds space between icon and text */
        }
        .feedback {
            margin: 10px 0;
            padding: 10px;
            background-color: #ffffff;
            border-left: 4px solid #4CAF50;
            border-radius: 5px;
            box-sizing: border-box; /* Ensures padding is included in width calculation */
        }
        .reply {
            margin: 5px 0 10px 20px;
            padding: 8px;
            background-color: #f9f9f9;
            border-left: 3px solid #2196F3;
            border-radius: 5px;
            box-sizing: border-box; /* Ensures padding is included in width calculation */
        }
        .reply-form {
            margin: 10px 0;
        }
        .reply-form textarea {
            width: 100%;
            padding: 10px;
            height: 60px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Prevents overflow */
            font-size: 16px;
        }
        .reply-form button {
            background-color: #2196F3;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        .reply-form button:hover {
            background-color: #0d8bf2;
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
        <!-- Back Button with Font Awesome Icon -->
        <a href="home.php" class="back-button"><i class="fas fa-arrow-left"></i>Back</a>
        
        <h2>Feedbacks from Teacher</h2>
        
        <?php if (empty($feedbacks)): ?>
            <p class="no-feedback">There is no feedback from teacher, please check again later :)</p>
        <?php else: ?>
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="feedback">
                    <p><strong>Feedback:</strong> <?= htmlspecialchars($feedback['fb_feedbacks']) ?></p>
                    <p><strong>Date:</strong> <?= htmlspecialchars($feedback['fb_date']) ?></p>
                    
                    <!-- Display replies for this feedback -->
                    <?php
                    $replyQuery = $conn->prepare("SELECT * FROM feedback_replies_tbl WHERE fb_id = ?");
                    $replyQuery->execute([$feedback['fb_id']]);
                    $replies = $replyQuery->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($replies as $reply): ?>
                        <div class="reply">
                            <p><strong>Reply:</strong> <?= htmlspecialchars($reply['reply_content']) ?></p>
                            <p><em>On: <?= htmlspecialchars($reply['reply_date']) ?></em></p>
                        </div>
                    <?php endforeach; ?>
                    
                    <!-- Reply form -->
                    <form method="POST" class="reply-form">
                        <textarea name="reply_content" placeholder="Write your reply here..." required></textarea>
                        <input type="hidden" name="fb_id" value="<?= $feedback['fb_id'] ?>">
                        <button type="submit">Reply</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
