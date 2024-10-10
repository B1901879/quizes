<?php
// Include your database connection file
include 'conn.php';

// Initialize an error array to store any registration errors
$errors = [];

// Success message variable
$success_msg = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign the form data to variables and sanitize them
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $course = '84'; // Set course as a constant value
    $year_level = 'SEJARAH YEAR2'; // Set year level as a constant value
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the fields are not empty
    if (empty($fullname) || empty($birthdate) || empty($gender) || empty($email) || empty($password)) {
        array_push($errors, "All fields are required.");
    }

    // Check if username or email already exists
    $user_check_query = "SELECT * FROM examinee_tbl WHERE exmne_email='$email' LIMIT 1";
    $stmt = $conn->prepare($user_check_query);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) { // if user exists
        array_push($errors, "Email already exists");
    }

    // If no errors, proceed with user registration
    if (count($errors) == 0) {
        // Insert user into database
        $query = "INSERT INTO examinee_tbl (exmne_fullname, exmne_birthdate, exmne_gender, exmne_course, exmne_year_level, exmne_email, exmne_password) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt->execute([$fullname, $birthdate, $gender, $course, $year_level, $email, $password])) {
            $success_msg = "Registration successful! You can now log in.";
        } else {
            array_push($errors, "Failed to register user: " . $stmt->errorInfo()[2]);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration System</title>
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
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .input-group {
            margin-bottom: 15px;
        }
        input[type="text"], input[type="date"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .success, .error {
            color: green; /* Change to red for errors */
            text-align: center;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Register</h2>

    <?php if (!empty($success_msg)): ?>
        <p class="success"><?php echo $success_msg; ?></p>
        <p class="login-link"><a href="index.php">Login Here</a></p>
    <?php endif; ?>

    <?php if (count($errors) > 0): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="signup.php">
        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="fullname" required>
        </div>
        <div class="input-group">
            <label>Birthdate</label>
            <input type="date" name="birthdate" required>
        </div>
        <div class="input-group">
            <label>Gender</label>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="input-group" style="margin-top: 10px;">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
    </form>
    <p class="login-link">
        Already a member? <a href="index.php">Sign in</a>
    </p>
</div>
</body>
</html>
