<?php 
date_default_timezone_set('Asia/Kuala_Lumpur');
$conn = mysqli_connect("localhost", "root", "", "cee_db");

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $date = date('F d Y, h:i:s A');
  $reply_id = $_POST["reply_id"];

  // Insert comment or reply into the database
  $query = "INSERT INTO tb_data (name, comment, date, reply_id) VALUES('$name', '$comment', '$date', '$reply_id')";
  mysqli_query($conn, $query);

  // Redirect to the same page after form submission to prevent duplication on refresh
  header("Location: " . $_SERVER['PHP_SELF']);
  exit(); // Ensure no further code is executed after the redirect
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Community Forum</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      width: 80%;
      max-width: 1200px;
      background: #fff;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
      overflow: hidden;
    }

    .back-button {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      display: inline-block;
      margin-bottom: 20px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .back-button:hover {
      background-color: #0056b3;
    }

    h3 {
      text-align: center;
      font-size: 2em;
      color: #343a40;
      margin-bottom: 40px;
    }

    .comments-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 30px;
    }

    .comment, .reply {
      background: #ffffff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: auto; /* Allow flexibility in height */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .comment:hover, .reply:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .comment .author, .reply .author {
      font-weight: bold;
      color: #007bff;
      font-size: 1.1em;
    }

    .comment .date, .reply .date {
      font-size: 0.9em;
      color: #aaa;
    }

    .comment .text, .reply .text {
      margin-top: 10px;
      font-size: 1em;
      color: #333;
      flex-grow: 1;
      overflow-y: auto; /* Allow scrolling if the content exceeds max-height */
    }

    /* Add max-height to prevent overly large replies */
    .comment .text, .reply .text {
      max-height: 150px;
      overflow-y: auto;
    }

    .minimize-button {
      background-color: #ff5722;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 0.9em;
      transition: background-color 0.3s;
    }

    .minimize-button:hover {
      background-color: #e64a19;
    }

    .hidden {
      display: none;
    }

    .form-container {
      margin-top: 40px;
      background-color: #f1f1f1;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-container input, .form-container textarea {
      width: 100%;
      padding: 12px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1em;
      box-sizing: border-box;
    }

    .form-container button {
      background-color: #4caf50;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 6px;
      font-size: 1.1em;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-container button:hover {
      background-color: #45a049;
    }

    .form-container button:active {
      transform: scale(0.98);
    }

    @media (max-width: 768px) {
      .container {
        width: 90%;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <a href="index.php" class="back-button">Back</a>

    <h3>Community Forum</h3>

    <!-- Comments Section -->
    <div class="comments-container">
      <?php
      $datas = mysqli_query($conn, "SELECT * FROM tb_data WHERE reply_id = 0 ORDER BY date DESC");
      while ($data = mysqli_fetch_assoc($datas)) {
          ?>
          <div class="comment" id="comment-<?php echo $data['id']; ?>">
              <div class="author"><?php echo $data['name']; ?> <span class="date"><?php echo $data['date']; ?></span></div>
              <div class="text">
                  <p><?php echo $data['comment']; ?></p>
              </div>

              <button class="minimize-button" onclick="toggleVisibility(<?php echo $data['id']; ?>)">Show Replies</button>

              <div class="comment-content hidden">
                  <?php
                  $replies = mysqli_query($conn, "SELECT * FROM tb_data WHERE reply_id = {$data['id']} ORDER BY date DESC");
                  while ($reply = mysqli_fetch_assoc($replies)) {
                      ?>
                      <div class="reply">
                          <div class="author"><?php echo $reply['name']; ?> <span class="date"><?php echo $reply['date']; ?></span></div>
                          <div class="text"><?php echo $reply['comment']; ?></div>
                      </div>
                      <?php
                  }
                  ?>

                  <!-- Reply Form for this comment -->
                  <form action="" method="post">
                    <input type="hidden" name="reply_id" value="<?php echo $data['id']; ?>">
                    <input type="text" name="name" placeholder="Your name" required>
                    <textarea name="comment" placeholder="Your reply" rows="4" required></textarea>
                    <button type="submit" name="submit">Submit Reply</button>
                  </form>
              </div>
          </div>
          <?php
      }
      ?>
    </div>

    <!-- Main Comment Form -->
    <div class="form-container">
      <h4>Leave a Comment</h4>
      <form action="" method="post">
        <input type="hidden" name="reply_id" value="0"> <!-- 0 indicates it's a main comment -->
        <input type="text" name="name" placeholder="Your name" required>
        <textarea name="comment" placeholder="Your comment" rows="4" required></textarea>
        <button type="submit" name="submit">Submit Comment</button>
      </form>
    </div>
  </div>

  <script>
    function toggleVisibility(commentId) {
      const commentContent = document.querySelector(`#comment-${commentId} .comment-content`);
      const minimizeButton = document.querySelector(`#comment-${commentId} .minimize-button`);

      if (commentContent.classList.contains('hidden')) {
        commentContent.classList.remove('hidden');
        minimizeButton.textContent = "Hide Replies";
      } else {
        commentContent.classList.add('hidden');
        minimizeButton.textContent = "Show Replies";
      }
    }
  </script>

</body>
</html>
