
<!DOCTYPE html>
<html lang="en">
<head>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="library.css">
    <title>Login</title>
</head>
<body style="background-image: url('books.jpg'); background-attachment: fixed;
  background-size: 100% 100%;">

<div class="nav">
  <a class="active" style="float: left;" href="library_login.php">Home</a>
  <a href="library_login.php">Login</a>
  <a href="library_register.php">Register</a>
</div>

<div class="container">

    <form  name="loginform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post" onsubmit="validateForm()"
      style="
             display: inline-block;
             padding: 30px 65px;
             background-color: hsla(201, 100%, 6%, 0.6);
             color: aliceblue;
             box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;     " 
    >
    <div class="row mb-3">
        <div class="col-sm-10">
          <input
            name="uname"
            type="text"
            placeholder="Username"
            class="form-control"
          />
          <br>
          <span id="uname"></span>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-sm-10">
          <input
            name="pass"
            type="password"
            placeholder="Enter Password"
            class="form-control"
          /> <br>
          <span id="pass"></span>
        </div>
      </div>
<p id="error"></p>
     
      
     <button name="login" type="submit" class="btn btn-danger" >Log in</button>
    

    
       <br> <br>
       Don't have an Account? <a style="color: red; text-decoration: none;" href="library_register.php">Register</a>
<br> 
<!--  Username password validation-->
<?php
$serverNames = "localhost";
$userNames = "root";
$password = "";

$conn = new mysqli($serverNames, $userNames, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

if (isset($_POST['login']) && !empty($_POST['uname']) && !empty($_POST['pass'])) {
  $uname = $_POST['uname'];
  $pass = $_POST['pass'];


  $sql = "SELECT Passwords,id FROM library.`register` WHERE Mail='$uname';";
  $rs = $conn->query($sql);
   $row = $rs->fetch_assoc();
  //  echo $row;
  if ($row == null) {
        echo "<script>document.getElementById('error').innerHTML='Username does not exist'</script>";
        echo "<script>document.getElementById('error').style.color='red'</script>";
  }
  else if($pass == $row["Passwords"]){
    echo "<script>document.getElementById('error').innerHTML=''</script>";
    session_start();
    $_SESSION["id"] = $row["id"];
    header("Location: library.php"); /* Redirect browser */
  exit();
      // echo "Password matched";
      //  return true;
  }
  else{
        echo "<script>document.getElementById('error').innerHTML='Invalid username/password'</script>";
        echo "<script>document.getElementById('error').style.color='red'</script>";
    return false;
  }

}

?> 

      <script type="text/javascript">
function validateForm()
{

  var uname=document.forms["loginform"]["uname"].value;
    var regx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/
    if(uname==null || uname==""){
        document.getElementById("uname").innerHTML="Please Enter Username" 
        document.getElementById("uname").style.color="red"
        return false;
    }
    else if(!uname.match(regx))
    {
        document.getElementById("uname").innerHTML="Invalid Username" 
        document.getElementById("uname").style.color="red"
        return false;
    }
    else{
    document.getElementById("uname").innerHTML="" 
  }


var pass=document.forms["loginform"]["pass"].value;  
    if(pass==null || pass=="")
    {
        document.getElementById("pass").innerHTML="Please Enter password" 
        document.getElementById("pass").style.color="red"
        return false;
    }
    else{
      document.getElementById("pass").innerHTML=""
        }
  
}

      </script>
</body>
</html>