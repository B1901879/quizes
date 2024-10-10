<?php
include '../../conn.php'; // Make sure you have a working PDO connection in conn.php

// Handle add, edit, delete actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $form = $_POST['form'];
        $chapter = $_POST['chapter'];
        $title = $_POST['title'];
        $link = $_POST['link'];

        // Insert new material using PDO
        $sql = "INSERT INTO learning_materials (form, chapter, title, link) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$form, $chapter, $title, $link]);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        // Delete material using PDO
        $sql = "DELETE FROM learning_materials WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    }
}

// Fetch existing learning materials
$sql = "SELECT * FROM learning_materials ORDER BY form, chapter";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Learning Materials</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Pale blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Increased width */
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="text"]:focus {
            border-color: #66afe9;
            outline: none;
        }
        button {
            background-color: #4CAF50; /* Add Material button color */
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 15px; /* Increased margin for spacing */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .title {
            flex-grow: 1; /* Allow the title to grow */
            margin-right: 10px; /* Add space between title and buttons */
            overflow: hidden; /* Hide overflow */
            text-overflow: ellipsis; /* Add ellipsis for overflowed text */
            white-space: nowrap; /* Prevent line breaks */
        }
        a {
            color: #007BFF;
            text-decoration: none;
            margin-right: 10px; /* Add margin to separate from delete button */
        }
        a:hover {
            text-decoration: underline;
        }
        .delete-btn {
            background-color: #ff4c4c; /* Red color for Delete button */
            color: white; /* White text */
            border: none; /* No border */
            cursor: pointer;
            padding: 5px 10px; /* Padding for better appearance */
            border-radius: 5px; /* Rounded corners */
        }
        .delete-btn:hover {
            background-color: #e60000; /* Darker red on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Learning Materials</h1>

    <form action="" method="POST">
        <input type="text" name="form" placeholder="Form (e.g., Form 4)" required>
        <input type="text" name="chapter" placeholder="Chapter (e.g., Chapter 1)" required>
        <input type="text" name="title" placeholder="Title of the chapter" required>
        <input type="text" name="link" placeholder="YouTube or Document Link" required>
        <button type="submit" name="add">Add Material</button>
    </form>

    <h2>Existing Materials</h2>
    <ul>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <li>
                <div class="title">
                    <?php echo $row['form'] . " - " . $row['chapter'] . " - " . $row['title']; ?>
                </div>
                <a href="<?php echo $row['link']; ?>" target="_blank">View</a>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete" class="delete-btn">Delete</button> <!-- Delete button -->
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

</body>
</html>
