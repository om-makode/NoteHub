  <?php include 'includes/connection.php';?>
                          <!-- <?php include 'includes/header.php';?>
                          <?php include 'includes/navbar.php';?>
 -->
<?php
session_start();
if (isset($_POST['login'])) {
  $username  = $_POST['user'];
  $password = $_POST['pass'];
  mysqli_real_escape_string($conn, $username);
  mysqli_real_escape_string($conn, $password);
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn , $query) or die (mysqli_error($conn));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $user = $row['username'];
    $pass = $row['password'];
    $name = $row['name'];
    $email = $row['email'];
    $role= $row['role'];
    $course = $row['course'];
    if (password_verify($password, $pass )) {
      $_SESSION['id'] = $id;
      $_SESSION['username'] = $username;
      $_SESSION['name'] = $name;
      $_SESSION['email']  = $email;
      $_SESSION['role'] = $role;
      $_SESSION['course'] = $course;
      header('location: dashboard/');
    }
    else {
      echo "<script>alert('invalid username/password');
      window.location.href= 'login.php';</script>";

    }
  }
}
else {
      echo "<script>alert('invalid username/password');
      window.location.href= 'login.php';</script>";

    }
}
?>







<html>



<head>
  <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap');

input {
  caret-color: red;
}

body {
  margin: 0;
  width: 100vw;
  height: 100vh;
  background: #ecf0f3;
  display: flex;
  align-items: center;
  text-align: center;
  justify-content: center;
  place-items: center;
  overflow: hidden;
  font-family: poppins;
}

.container {
  position: relative;
  width: 350px;
  height: 500px;
  border-radius: 20px;
  padding: 40px;
  box-sizing: border-box;
  background: #ecf0f3;
  box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
}

.brand-logo {
  height: 100px;
  width: 100px;
  background: url("images/pic2.png");
  margin: auto;
  border-radius: 50%;
  box-sizing: border-box;
  box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px white;
}

.brand-title {
  margin-top: 10px;
  font-weight: 900;
  font-size: 1.8rem;
  color: #1DA1F2;
  letter-spacing: 1px;
}

.inputs {
  text-align: left;
  margin-top: 30px;
}

label, input, button {
  display: block;
  width: 100%;
  padding: 0;
  border: none;
  outline: none;
  box-sizing: border-box;
}

label {
  margin-bottom: 4px;
}

label:nth-of-type(2) {
  margin-top: 12px;
}

input::placeholder {
  color: gray;
}

input {
  background: #ecf0f3;
  padding: 10px;
  padding-left: 20px;
  height: 50px;
  font-size: 14px;
  border-radius: 50px;
  box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
}

button {
  color: white;
  margin-top: 20px;
  background: #1DA1F2;
  height: 40px;
  border-radius: 20px;
  cursor: pointer;
  font-weight: 900;
  box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
  transition: 0.5s;
}

button:hover {
  box-shadow: none;
}

a {
  position: absolute;
  font-size: 8px;
  bottom: 4px;
  right: 4px;
  text-decoration: none;
  color: black;
  background: yellow;
  border-radius: 10px;
  padding: 2px;
}

h1 {
  position: absolute;
  top: 0;
  left: 0;
}




  </style>


</head>




<body>

  <form method="POST">
<div class="container">
  <div class="brand-logo"></div>
  <div class="brand-title">NOTEHUB</div>
  <div class="inputs">


    <label>Username</label>
    <input type="text" name="user" placeholder="Username" required="">


    <label>Password</label>
    <input type="password"  name="pass" placeholder="Password" required="">


    <button type="submit" name="login" class="login login-submit" value="login">Login</button>
  </form>
  
   <script src='css/jquery.min.js'></script>
<script src='css/jquery-ui.min.js'></script>

 
</body>
</html>