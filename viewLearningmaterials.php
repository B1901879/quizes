<!DOCTYPE html>
<html>
<head>
    <title>Learning Materials</title>
    <style>
        body {
            background-color: #f0f8ff; /* Pale blue background */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        h1 {
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
            text-align: left;
        }
        h3 {
            color: #555;
            margin: 10px 0;
            text-align: left;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
            text-align: left;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Learning Materials</h1>

    <?php
    include 'conn.php';

    // Fetch learning materials grouped by form and chapter
    $sql = "SELECT * FROM learning_materials ORDER BY form, chapter";
    $stmt = $conn->query($sql);

    $current_form = '';
    $current_chapter = '';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Display Form title (Form 4, Form 5) only once
        if ($current_form != $row['form']) {
            if ($current_form != '') echo "</ul>"; // Close previous form's list
            $current_form = $row['form'];
            echo "<h2>$current_form</h2><ul>"; // Big title for form (Form 4 or Form 5)
        }

        // Display Chapter title once under each form
        if ($current_chapter != $row['chapter']) {
            if ($current_chapter != '') echo "</ul>"; // Close previous chapter's list
            $current_chapter = $row['chapter'];
            echo "<h3>Chapter $current_chapter</h3><ul>"; // Chapter title
        }

        // Display the learning material
        echo "<li><a href='" . $row['link'] . "' target='_blank'>" . $row['title'] . "</a></li>";
    }

    if ($current_chapter != '') echo "</ul>"; // Close last chapter's list
    if ($current_form != '') echo "</ul>"; // Close last form's list
    ?>

</div>

</body>
</html>

