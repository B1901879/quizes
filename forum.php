<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
$conn = mysqli_connect("localhost", "root", "", "cee_db");

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $date = date('F d Y, h:i:s A');
  $reply_id = $_POST["reply_id"];

  $query = "INSERT INTO tb_data VALUES('', '$name', '$comment', '$date', '$reply_id')";
  mysqli_query($conn, $query);

  // Redirect to the same page after form submission to prevent duplication on refresh
  header("Location: " . $_SERVER['PHP_SELF']);
  exit(); // Ensure no further code is executed after the redirect
}
?>

<html>
  <head></head>
  <style>
    /* Your existing CSS styles */
    /* Styles for the minimize button */
    .minimize-button {
      background: #f44336;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 3px;
      cursor: pointer;
      font-size: 0.8em;
      margin-bottom: 5px;
      display: inline-block;
    }
    .preview-text {
      display: inline;
      color: #555;
      margin-left: 10px;
      font-size: 0.9em;
    }
    .minimize-button:hover {
      background: #d32f2f;
    }

    /* Hidden class to hide elements */
    .hidden {
      display: none;
    }

    .back-button {
      background: #555;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-bottom: 15px;
      display: inline-block;
      text-decoration: none;
      font-size: 0.9em;
    }

    .back-button:hover {
      background: #333;
    }

    .container {
      background: #fff;
      width: 1200px;
      margin: 30px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .comments-container {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  justify-content: flex-start;
}

.comment, .reply {
  background: #fafafa;
  margin-top: 10px;
  padding: 15px;
  border-radius: 8px;
  border: 1px solid #ddd;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  flex: 1 1 calc(33.33% - 30px); /* Adjust to 3 columns by default */
  min-width: 250px; /* Set a minimum width for the boxes */
  box-sizing: border-box;
  transition: all 0.3s ease;
}

    .comment:hover, .reply:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h4 {
      font-size: 1.1em;
      margin-bottom: 5px;
      color: #333;
    }

    p {
      font-size: 0.9em;
      color: #555;
      margin-bottom: 10px;
    }

    button.reply {
      background: #ff9800;
      color: white;
      border: none;
      cursor: pointer;
      padding: 8px 12px;
      border-radius: 5px;
      transition: background 0.3s;
    }

    button.reply:hover {
      background: #e68900;
    }

    form {
      margin: 20px 0;
    }

    form h3 {
      margin-bottom: 10px;
      font-size: 1.2em;
      color: #333;
    }

    form input, form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 0.9em;
    }

    form button.submit {
      background: #4caf50;
      color: white;
      border: none;
      cursor: pointer;
      padding: 12px;
      border-radius: 5px;
      font-size: 1em;
      transition: background 0.3s;
    }

    form button.submit:hover {
      background: #45a049;
    }
  </style>
    <body>
    <div class="container">
      <a href="index.php" class="back-button">Back</a>
      <div class="comments-container">
      <div class="comments-container">
    <?php
    $datas = mysqli_query($conn, "SELECT * FROM tb_data WHERE reply_id = 0");
    foreach ($datas as $data) {
        ?>
        <div class="comment" id="comment-<?php echo $data['id']; ?>">
            <button class="minimize-button" onclick="toggleVisibility(<?php echo $data['id']; ?>)">Minimize</button>
            <span class="preview-text" id="preview-<?php echo $data['id']; ?>"><?php echo substr($data['comment'], 0, 50); ?>...</span>
            <div class="comment-content hidden"> <!-- Add the hidden class here -->
                <?php require 'comment.php'; ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
      <form action="" method="post">
        <h3 id="title">Leave a Topic</h3>
        <input type="hidden" name="reply_id" id="reply_id">
        <input type="text" name="name" placeholder="Your name" required>
        <textarea name="comment" placeholder="Your comment" rows="4" required></textarea>
        <button class="submit" type="submit" name="submit">Submit</button>
      </form>
    </div>

    <script>
      function reply(id, name) {
        const title = document.getElementById('title');
        title.innerHTML = "Comment on " + name;
        document.getElementById('reply_id').value = id;
      }

      function toggleVisibility(commentId) {
        const commentContent = document.querySelector(`#comment-${commentId} .comment-content`);
        const minimizeButton = document.querySelector(`#comment-${commentId} .minimize-button`);
        const previewText = document.getElementById(`preview-${commentId}`);

        if (commentContent.classList.contains('hidden')) {
          commentContent.classList.remove('hidden');
          minimizeButton.textContent = "Minimize";
          previewText.classList.add('hidden');
        } else {
          commentContent.classList.add('hidden');
          minimizeButton.textContent = "Show";
          previewText.classList.remove('hidden');
        }
      }
    </script>
  </body>
</html>
