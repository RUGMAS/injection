<?php
$cleardb_server   = "localhost";
$cleardb_username = "root";
$cleardb_password = "";
$cleardb_db       = "sem";
$conn = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['uname']) && isset($_GET['pass'])) {
    $stmt = $conn->prepare("SELECT * FROM login_details WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $uname, $pass);
    $uname = $_GET['uname'];
    session_start();
    $pass = $_GET['pass'];
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $uname;
        header("Location: dashborad.php");
        exit();
    } else {
        $error = "Wrong username or password";
    }
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>
