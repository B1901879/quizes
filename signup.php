<?php
// Include your database connection file
include 'conn.php';

// Initialize an error array to store any registration errors
$errors = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign the form data to variables and sanitize them
    $username = $mysqli->real_escape_string($_POST['username']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);

    // Validate the inputs...

    // Check if username or email already exists
    $user_check_query = "SELECT * FROM your_users_table WHERE username='$username' OR email='$email' LIMIT 1";
    $result = $mysqli->query($user_check_query);
    $user = $result->fetch_assoc();

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    // If no errors, proceed with user registration
    if (count($errors) == 0) {
        // Encrypt the password before saving in the database
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO your_users_table (username, email, password) VALUES('$username', '$email', '$password_hashed')";
        if ($mysqli->query($query)) {
            // Redirect to login page or wherever you like
            header('Location: index.php');
        } else {
            array_push($errors, "Failed to register user: " . $mysqli->error);
        }
    }
}

// Close the connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <!-- Your styles and scripts here -->
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>
    
    <form method="post" action="signup.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
            <!-- Other content, possibly registration form or confirmation message -->
            <a href="/CEE/" class="btn">Continue</a>
        </div>

        
        <p>
            Already a member? <a href="index.php">Sign in</a>
        </p>
    </form>
</body>
</html>
<div class="login-signup-prompt" style="text-align: center; margin-top: 20px;">
    					Don't have an account yet? <a href="/CEE/signup.php" class="signup-link">Sign Up</a>
					</div>