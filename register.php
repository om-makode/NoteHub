<!-- <?php include 'includes/connection.php';?>
<?php include 'includes/header.php';?>

<?php include 'includes/navbar.php';?> -->

<?php
if (isset($_POST['signup'])) {
require "gump.class.php";
$gump = new GUMP();
$_POST = $gump->sanitize($_POST); 

$gump->validation_rules(array(
  'username'    => 'required|alpha_numeric|max_len,20|min_len,4',
  'name'        => 'required|alpha_space|max_len,30|min_len,5',
  'email'       => 'required|valid_email',
  'password'    => 'required|max_len,50|min_len,6',
));
$gump->filter_rules(array(
  'username' => 'trim|sanitize_string',
  'name'     => 'trim|sanitize_string',
  'password' => 'trim',
  'email'    => 'trim|sanitize_email',
  ));
$validated_data = $gump->run($_POST);

if($validated_data === false) {
  ?>
  <center><font color="red" > <?php echo $gump->get_readable_errors(true); ?> </font></center>
  <?php
}
else if ($_POST['password'] !== $_POST['repassword']) 
{
  echo  "<center><font color='red'>Passwords do not match </font></center>";
}
else {
      $username = $validated_data['username'];
      $checkusername = "SELECT * FROM users WHERE username = '$username'";
      $run_check = mysqli_query($conn , $checkusername) or die(mysqli_error($conn));
      $countusername = mysqli_num_rows($run_check); 
      if ($countusername > 0 ) {
    echo  "<center><font color='red'>Username is already taken! try a different one</font></center>";
}
$email = $validated_data['email'];
$checkemail = "SELECT * FROM users WHERE email = '$email'";
      $run_check = mysqli_query($conn , $checkemail) or die(mysqli_error($conn));
      $countemail = mysqli_num_rows($run_check); 
      if ($countemail > 0 ) {
    echo  "<center><font color='red'>Email is already taken! try a different one</font></center>";
}

  else {
      $name = $validated_data['name'];
      $email = $validated_data['email'];
      $pass = $validated_data['password'];
      $password = password_hash("$pass" , PASSWORD_DEFAULT);
      $role = $_POST['role'];
      $course = $_POST['course'];
      $gender = $_POST['gender'];
      $joindate = date("F j, Y");
      $query = "INSERT INTO users(username,name,email,password,role,course,gender,joindate,token) VALUES ('$username' , '$name' , '$email', '$password' , '$role', '$course', '$gender' , '$joindate' , '' )";
      $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
      if (mysqli_affected_rows($conn) > 0) { 
        echo "<script>alert('SUCCESSFULLY REGISTERED');
        window.location.href='login.php';</script>";
}
else {
  echo "<script>alert('Error Occured');</script>";
}
}
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
  width: 450px;
  height: 730px;
  border-radius: 20px;
  padding: 25px;
  box-sizing: border-box;
  background: #ecf0f3;
  box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
}

.brand-logo {
  height: 100px;
  width: 100px;
  background: url("C:/Users/ommak/Downloads/png-clipart-white-and-orange-book-logo-symbol-yellow-orange-logo-ibooks-orange-logo.png");
  margin: auto;
  border-radius: 50%;
  box-sizing: border-box;
  box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px white;
}

.brand-title {
  margin-top: 5px;
  font-weight: 900;
  font-size: 1.5rem;
  color: #1DA1F2;
  letter-spacing: 0.5px;
}
.brand-title2 {
  margin-top: 5px;
  font-weight: 900;
  font-size: 1.2rem;
  color: black;
  letter-spacing: 0.5px;
}

.inputs {
  text-align: left;
  margin-top: 30px;
}

.gender{
  margin-top: 10px;
  font-size: 1rem;
  letter-spacing: 0.5px;
  padding: 10px;
   box-sizing: border-box;
  background: #ecf0f3;
/*  box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;*/
  border-radius: 20px;
   position: relative;
    display: block;
  width: 100%;
/*  padding: 0;*/
  border: none;
  outline: none;
  box-sizing: border-box;
   box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
 height: 35px;
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
  height: 35px;
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
  position: relative;
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
  position: relative;
  top: 0;
  left: 0;
}





  </style>


</head>




<body>
 

<div>
<div class="container">
  <form id="contactform" method="POST">
  
  <div class="brand-title">NoteHub</div>
  <div class="brand-title2">Registration Form</div>
  <div class="inputs">



     <p class="contact"><label for="name">Name</label></p> 
    <input id="name" name="name" placeholder="First And Last Name" required="" tabindex="1" type="text" value="<?php if(isset($_POST['signup'])) { echo $_POST['name']; } ?>"> 





    <p class="contact"><label for="username">Create a username</label></p>
    <input id="username" name="username" placeholder="Username"  required="" tabindex="2" type="text" value="<?php if(isset($_POST['signup'])) { echo $_POST['username']; } ?>"> 




     <p class="contact"><label for="email">Email</label></p> 
    <input id="email" name="email" placeholder="abc@gmail.com"  required="" type="email" value="<?php if(isset($_POST['signup'])) { echo $_POST['email']; } ?>"> 


    
    <p class="contact"><label for="password">Create a password</label></p>
    <input type="password" id="password" placeholder="Min 6 charaters" name="password" required=""> 

    <p class="contact"><label for="repassword">Confirm your password</label></p>
   
    <input type="password" placeholder="Min 6 charaters" id="repassword" name="repassword" required="" />



     <p class="contact"><label for="gender">Gender </label></p> 

            <select class="select-style gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>

            <button type="submit" class="buttom" name="signup" id="submit" tabindex="5" value="Sign me up!">REGISTER</button>
            
            
  </div>

</form>
</div>
 
 
</body>
</html>