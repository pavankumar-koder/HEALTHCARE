<?php
// Database configuration
$servername = "localhost";  // Hostname (use 'localhost' if you're running XAMPP locally)
$username = "root";         // MySQL Username (default in XAMPP is 'root')
$password = "";             // MySQL Password (default in XAMPP is an empty string)
$dbname = "login & registration";    // Your Database Name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate inputs
    if (empty($firstname) || empty($lastname) || empty($username) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        // Check if username already exists
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>alert('Username already exists. Please choose another.');</script>";
        } else {
            // Hash password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database
            $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES ('$firstname', '$lastname', '$username', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registration successful!'); window.location.href='login1.html';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css">

    <script type="text/javascript">
        function msg2() {
            alert("Example: abc@gmail.com");
        }
    </script>
</head>
<body style="background-image:url('bg5.jpeg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
    <center>
        <form method="POST" action="registration.php" style="background-image:url('bg2.jpeg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;width:70%; margin:8px 0px; padding:12px 20px; display:inline-block; border:2px solid #00FFFF; box-sizing:border-box;">
            <h1><font color="#00FFFF">REGISTER FORM <i class="fa-regular fa-address-card"></i></font></h1>
            <br><br>

            <label><font color="#00FFFF"><i class="fa-solid fa-user"></i> FIRST NAME :</font></label>
            <input type="text" id="firstname" name="firstname" value="" placeholder="First Name" required style="width:40%; margin:8px 0px; padding:12px 20px; display:inline-block; border:2px solid #00FFFF; box-sizing:border-box;">
            <br><br>

            <label><font color="#00FFFF"><i class="fa-solid fa-user"></i> LAST NAME :</font></label>
            <input type="text" id="lastname" name="lastname" value="" placeholder="Last Name" required style="width:40%; margin:8px 0px; padding:12px 20px; display:inline-block; border:2px solid #00FFFF; box-sizing:border-box;">
            <br><br>

            <label><font color="#00FFFF"><i class="fa-regular fa-circle-user"></i> USERNAME (Email or Phone):</font></label>
            <input type="text" id="username" name="username" value="" placeholder="Email or Phone" required onclick="msg2()" style="width:40%; margin:8px 0px; padding:12px 20px; display:inline-block; border:2px solid #00FFFF; box-sizing:border-box;">
            <br><br>

            <label><font color="#00FFFF"><i class="fa-solid fa-key"></i> PASSWORD :</font></label>
            <input type="password" id="password" name="password" value="" placeholder="Enter Password" required style="width:40%; margin:8px 0px; padding:12px 20px; display:inline-block; border:2px solid #00FFFF; box-sizing:border-box;">
            <br><br>

            <input type="submit" value="REGISTER" style="background-color:#00FFFF; width:20%; color:black; padding:15px; margin:10px 0px; cursor:pointer;border:solid 4px #7DF9FF;border-radius:30px;">
            <br><br>

            <a href="login1.html"><input type="button" value="Already have an account? Log In" style="background-color:#00FFFF; width:25%; color:black; padding:10px; margin:10px 0px; cursor:pointer;border:solid 4px #7DF9FF;border-radius:30px;"></a>
        </form>
    </center>
</body>
</html>
