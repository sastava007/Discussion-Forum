<?php
/*Connect*/
$conn=mysqli_connect("localhost","root","","mydb");
if(!$conn)
	echo "<script>window.alert('Connection Faliled');</script>";
mysqli_connect_error();

$error="";
if(isset($_POST["usr"], $_POST["password"])) 
    {     

        $username = $_POST["usr"]; 
        $password = $_POST["password"];
        $username = stripslashes($_POST["usr"]); 
		$username = mysqli_real_escape_string($conn,$_POST["usr"]);
		$password = stripslashes($_POST["password"]); 
		$password = mysqli_real_escape_string($conn,$_POST["password"]);
        $password =hash('sha256', $_POST['password']);
        $admin="Admin";
        $query=mysqli_query($conn,"SELECT username, password FROM users WHERE username='".$admin."' AND password= '".$password."' ");
        if(mysqli_num_rows($query)>0)
        {
            session_start();
            $_SESSION["logged_in"] = true; 
            $_SESSION["username"] = $username; 
            header('Location: admin.php');
        }
        else
        {
            $result1 = mysqli_query($conn,"SELECT username, password FROM users WHERE username = '".$username."' AND  password = '".$password."' AND verified=1 ");
            if(mysqli_num_rows($result1) > 0 )
            { 
            session_start();
            $_SESSION["logged_in"] = true; 
            $_SESSION["username"] = $username; 
            header('Location: home.php');
            }
            else
            {
            $error="* Username OR Password is Incorrect";
            }
        }    

        
    }
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="login.js"></script>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Tangerine">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="welcome.css">
</head>
<body background="login_bg.jpeg" style="height: 95vh; width: 100vh; background-repeat:round;" class="container">
    <div class="text">
        <p class="item1">
            A place to<br> gain and share knowledge
        </p>
        <p class="item2">
            The Open Intelligence <br>Platform
        </p>
        <p class="item3">
            You've  got questions,<br> We've got answers
        </p>    
    </div>
        <div class="loginbox">
        <img src="user.png" id="user" top="250px" left="510">
        <br>
        <h2>Login Here</h2>
        <form name="myform" method="post" action="Welcome.php">
            
            <p>Username</p>
            <input type="text" name="usr" id="username" placeholder=" Enter Username" required>
            <p>Password</p>
            <input type="Password" name="password" id="password" placeholder=" Enter Password" required><br>
            <input type="submit" name="submit" id="submit" value="Login" onclick="validate()">
            <br>
            <p id="error" style="color:red; font-family:'Ubuntu'; font-size: 1.1vw;"> <?php echo $error; ?></p>
            <br>
            <p>New user?</p>
        </form>
        <button class="registration"><a href="Registration.php">Sign Up</a></button> 
        </div>


</div>

</body>
</html>                                                        