<?php
// Include database connection (make sure this uses PDO)
include('../../conn.php');

// Query to get all replies, including student name and teacher feedback
$query = "SELECT fr.reply_content, fr.reply_date, ef.exmne_fullname, af.fb_feedbacks 
          FROM feedback_replies_tbl fr 
          JOIN admin_feedbacks_tbl af ON fr.fb_id = af.fb_id
          JOIN examinee_tbl ef ON fr.exmne_id = ef.exmne_id
          ORDER BY fr.reply_date DESC";

// Use PDO to execute the query
$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Replies from Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .feedback-reply {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .feedback-reply p {
            margin: 5px 0;
        }
        .feedback-reply hr {
            margin: 10px 0;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Replies from Students</h1>

    <div class="replies-container">
        <?php
        // Check if there are any replies
        if (!empty($results)) {
            // Display all feedback replies
            foreach ($results as $row) {
                echo "<div class='feedback-reply'>";
                echo "<p><strong>Student: </strong>" . htmlspecialchars($row['exmne_fullname']) . "</p>"; // Student's name
                echo "<p><strong>Teacher's Original Feedback: </strong>" . htmlspecialchars($row['fb_feedbacks']) . "</p>"; // Teacher's feedback
                echo "<p><strong>Student's Reply: </strong>" . htmlspecialchars($row['reply_content']) . "</p>"; // Student's reply (reply_content)
                echo "<p><em>Reply Date: </em>" . htmlspecialchars($row['reply_date']) . "</p><hr>"; // Date of the reply (reply_date)
                echo "</div>";
            }
        } else {
            echo "<p>No replies found.</p>";
        }
        ?>
    </div>

</body>
</html>



