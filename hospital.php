<? php
// Retrieve form data
$name = $_POST['name'];
$phno = $_POST['phno'];
$mailid = $_POST['mailid'];
$password = $_POST['pass'];
$cpassword = $_POST['cpass'];

// Database connection details
$servername = "localhost";  // Change if your database is hosted elsewhere
$username = "root";         // Database username
$password = "";             // Database password
$dbname = "registrationfrom";     // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
	$stmt=$conn->prepare("INSERT INTO registers(name,phone_number,mailid,password,cpassword) VALUES(?,?,?,?,?)");
	$stmt->blind_param("sisss",$name,$phno,$mailid,$password,$cpassword);
	if($stmt->execute())
	{
		echo "Registration Successful!!;
	}else{
		echo "Error:".$stmt->error;
	}
	
	$stmt->close();
$conn->close();
}