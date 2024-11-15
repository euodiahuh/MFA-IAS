<!DOCTYPE html>
<html>
<head>
    <title>Registration with Strong Password</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <input type="submit" value="Register">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Define strong password criteria
        $password_pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        // Debugging: Output the password being tested
        echo "Testing password: $password<br>";

        // Validate password
        if (!preg_match($password_pattern, $password)) {
            echo "Password does not meet security requirements.";
            echo "<br>Requirements: Minimum 8 characters, 1 uppercase, 1 lowercase, 1 number, 1 special character.";
        } else {
            echo "Registration successful. Password meets security requirements.";
            // Here, you would normally store the user data securely.
        }
    }
    ?>
</body>
</html>
