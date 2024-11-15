<?php
session_start();

// Generate a random 6-digit MFA code only if it's not already set
if (!isset($_SESSION['mfa_code'])) {
    $mfa_code = rand(100000, 999999);
    $_SESSION['mfa_code'] = $mfa_code;
} else {
    $mfa_code = $_SESSION['mfa_code'];
}

// Save the MFA code to a text file for demonstration
file_put_contents('mfa_code.txt', "Current MFA Code: $mfa_code");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_mfa_code = $_POST['mfa_code'];

    // Debugging output: Show stored and submitted MFA codes
    echo "Session-stored MFA Code: " . $_SESSION['mfa_code'] . "<br>";
    echo "Submitted MFA Code: " . $user_mfa_code . "<br>";

    // Verify the MFA code
    if ($user_mfa_code == $_SESSION['mfa_code']) {
        echo "Login successful. MFA code verified!";
        unset($_SESSION['mfa_code']); // Clear the MFA code after successful verification
    } else {
        echo "Invalid MFA code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login with MFA</title>
</head>
<body>
    <h2>Login with Multi-Factor Authentication</h2>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <label for="mfa_code">MFA Code:</label>
        <input type="text" id="mfa_code" name="mfa_code" required>
        <br><br>
        <input type="submit" value="Login">
    </form>

    <?php
    // Display the MFA code (simulate sending it via email)
    echo "<p><strong>MFA Code (for demonstration): $mfa_code</strong></p>";
    ?>
</body>
</html>
