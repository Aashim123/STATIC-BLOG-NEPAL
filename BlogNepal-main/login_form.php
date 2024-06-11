<?php
session_start();

if(isset($_POST['login'])) {
    //including database connection
    require_once "db_connect.php";

    //get username and password from the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    //sql injection
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    //fetch user data from form data
    $sql = "SELECT * FROM users WHERE user_name ='$username'";

    $result = mysqli_query($con, $sql);

    if($row = mysqli_fetch_assoc($result)) {
        //verify password
        $password = md5($password);
        if($password == $row['user_password']) {
            //password is correct
            //setting value in session
            $_SESSION['username'] = $row['user_name'];

            //redirecting to index
            header("Location: index.php");
            exit();
        }
    }

    // If the login fails, display an error message
   
     echo '<script>alert("Sorry, the username or password you entered is incorrect. Please try again.");</script>';
}
   
?>

<html>
<head>
    <title> Log in </title>
    <style>
        /* CSS code for styling the login form */

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

h1 {
    text-align: center;
    color: #333;
}

.log_in {
    width: 300px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.log_in label {
    display: block;
    margin-bottom: 10px;
    color: #666;
}

.log_in input[type="text"],
.log_in input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.log_in button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.log_in button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
<!-- login form-->
<h1> Login Form</h1>
<form class="log_in" action="login_form.php" method="post">
    <label for="username"> Username: </label>
    <input type="text" name="username" id="username"></br>

    <label for="password"> Password </label>
    <input type="password" name="password" id="password"></br>
    <button type="submit" name="login"> Login </button>

</form>
</body>
</html>
