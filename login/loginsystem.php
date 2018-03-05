<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
     integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
     crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
    body{
      background:#eee;
    }
    .frm{
      width:50%;
      margin: 100px auto;
      border-radius:5px;

      background: white;
      border:solid gray 1px;
      padding:50px;

    }
    #btn{
      color:#fff;
      padding:5px;
      margin-left:69%;
      background:#337ab7;

    }
    #btn1{
      color:#fff;
      padding:5px;
      margin-left:12px;
      margin-top:10px;

      background:#337ab7;

    }
    </style>
  </head>
  <body>
  <div class="frm">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" >
  <li class="nav-item" >
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" >Log In</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">New User</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
      <p>
      <label>Usename:</label>
      <input type="text" name="user" required value=""></input>
    </p>
    <p>
      <label>Password:</label>
      <input type="password" name="password" required></input>
    </p>
    <input type="submit" value="Login" name="submit" id="btn"></input>
    </form>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">

      <div class="col-md-6">
      <label for="name">Username:</label><br/>
    </div>
    <div class="col-md-6">
      <input type="text" name="username" value="<?php echo $_POST['username'] ?>" required autofocus placeholder="Enter your name" size="30" ></input><br/>
    </div>

    <div class="col-md-6">
      <label for="name">Email:</label>
    </div>
    <div class="col-md-6">
      <input type="text" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
        placeholder="Enter your email address" size="30" value="<?php echo $_POST['email'] ?>"></input><br/>
      </div>


    <div class="col-md-6">
      <label for="password">Password:</label>
    </div>
    <div class="col-md-6">
      <input type="password" name="pass" required placeholder="Enter Password" size="30"></input><br/>
    </div>

        <div class="col-md-6">
      <label for="cnfpassword">Confirm Password:</label>
    </div>
    <div class="col-md-6">
      <input type="password" name="cnfpass" required placeholder="Enter Password"size="30"></input>
    </div>

    <div class="col-md-6">
   <label for="name">Phone:</label>
   </div>
   <div class="col-md-6">
  <input type="tel" name="phone" required maxlength="10" placeholder="Enter your mobile number" size="30"
  value="<?php echo $_POST['phone'] ?>"></input><br/>
   </div>

     <div>
     <input type="submit" name="register" value="Register" id="btn1"></input>
   </div>
    </form>
  </div>
</div>
</div>
<?php

if(isset($_POST['submit'])){
$username=$_POST['user'];
$password=$_POST['password'];

$username=stripcslashes($username);// Removes back slashes
$password=stripcslashes($password);



$dbc=mysqli_connect('localhost','root','','login')
     or die("Unable to connect to database");

 $username=mysqli_real_escape_string($dbc,$username);//Removes special characters
 $password=mysqli_real_escape_string($dbc,$password);

$query="SELECT * FROM userdata where username='$username' and userpassword='$password'";

$result=mysqli_query($dbc,$query)
        or die("Unable to query".mysql_error());

$row=mysqli_fetch_array($result);//get the data from the database in an array
mysqli_close($dbc);

if($row['username']==$username && $row['userpassword']==$password){
  //header('location:book.php'); give ur location where u want to send the file
  echo ' you are logged in';
}
else{
  echo '<script language="javascript">';
  echo 'alert("Incorrect Details")';
  echo '</script>';

}
}

if(isset($_POST['register'])){

  $username=$_POST['username'];
  $email=$_POST['email'];
  $pass=$_POST['pass'];
  $cnfpass=$_POST['cnfpass'];
  $phone=$_POST['phone'];

  if($pass==$cnfpass){

  $password=$pass;
  }
  else{
    $password=0;
    echo '<script language="javascript">';
    echo 'alert("Password Matching Failed")';
    echo '</script>';
  }

  if(!empty($username)&&!empty($email)&&!empty($password)&&!empty($phone)){

  $dbc=mysqli_connect('localhost','root','','login');//Connect to server,Change ur details to connect,login is ur database name
  $query="INSERT INTO userdata VALUES('$username','$email','$password','$phone')";//Insert values into table,userdata is table name
  $result=mysqli_query($dbc,$query)
          or die('Error querying database');//Query
  mysqli_close($dbc);
  echo '<script language="javascript">';
  echo 'alert("Registration Sucessful!!!")';
  echo '</script>';

  }
  else{
    echo '<script language="javascript">';
    echo 'alert("Please enter all the information")';
    echo '</script>';

  }

}
?>
</body>
</html>
