
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
    <title>Library Management System</title>
    
</head>
<body style="background-image: url('books.jpg'); background-attachment: fixed;
  background-size: 100% 100%;">

<div class="nav">
  <a class="active" style="float: left;" href="library_login.php">Home</a>
  <a href="library_login.php">Login</a>
  <a href="library_register.php">Register</a>
</div>
    
<div class="container">

<!-- <div > -->
<form  name="registerform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" onsubmit="return validateForm1()" 
  style="
    display: inline-block;
    width: 500px;
    padding: 20px 20px;
    background-color: hsla(201, 100%, 6%, 0.6);
    color:aliceblue;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;      " 
>
  <div class="row mb-3">
    <label for="Names" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input
        name="Names"
        type="text"
        placeholder="Enter Your Name"
        class="form-control"
      />
      <br>
      <span id="Names"></span>
    </div>
  </div>

  <div class="row mb-3">
        <label for="Contact" class="col-sm-2 col-form-label">Contact No</label>
        <div class="col-sm-10">
          <input
            name="Contact"
            type="number"
            placeholder="Enter Contact No."
            class="form-control"
          /> <br>
          <span  id="Contact"></span>
        </div>
      </div>

  <div class="row mb-3">
        <label for="Mail" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
          <input
            name="Mail"
            type="text"
            placeholder="Enter E-mail"
            class="form-control"
          /> <br>
          <span id="Mail"></span>
        </div>
      </div>

      <div class="row mb-3">
        <label for="Passwords" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input
            name="Passwords"
            type="password"
            placeholder="Enter Password"
            class="form-control"
          /> <br>
          <span id="Passwords"></span>
        </div>
      </div>

      <div class="row mb-3">
        <label for="cpass" class="col-sm-2 col-form-label"
          >Confirm Password</label
        >
        <div class="col-sm-10">
          <input
            name="cpass"
            type="password"
            placeholder="Confirm Password"
            class="form-control"
          /><br>
          <span id="cpass"></span>
        </div>
      </div>
<div id="error"></div>
      <button name="register"  type="submit" class="btn btn-danger">
        Submit
      </button>
</div>

<!-- Form Registration -->
<?php

$serverNames = "localhost";
$userNames = "root";
$password = "";

$conn = new mysqli($serverNames, $userNames, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

if (isset($_POST['register']) && !empty($_POST['Names']) && !empty($_POST['Contact']) && !empty($_POST['Mail']) && !empty($_POST['Passwords'])) {
  $Mail = $_POST['Mail'];
  $Names = $_POST['Names'];
  $Contact = $_POST['Contact'];
  $Passwords = $_POST['Passwords'];

  $sql = "SELECT* FROM library.`register` WHERE Mail='$Mail';";
  $rs = $conn->query($sql);
   $row = $rs->fetch_assoc();
  //  echo $row["Mail"];

  if($row == null){

    echo "<script>document.getElementById('error').innerHTML=''</script>";
    $register_insert = "INSERT INTO library.register (Names,Contact,Mail,Passwords) VALUES ('$Names', '$Contact', '$Mail', '$Passwords');";

    if ($conn->query($register_insert) == true) {
      //  echo "Success";
    } else {
      //  echo "ERROR: $register_insert <br> $conn->error";
    }
    header("Location: library.php"); 
  }
  else {
    echo "<script>document.getElementById('error').innerHTML='Account Already Exists!!'</script>";
    echo "<script>document.getElementById('error').style.color='red'</script>";
}
}
$conn->close();
?>


<script type="text/JavaScript">
  function validateForm1()
        {

    // Form Registration

    var Names=document.forms["registerform"]["Names"].value;  
    if(Names==null || Names=="" )
    {
        document.getElementById("Names").innerHTML="Name is mandatory" 
        document.getElementById("Names").style.color="red"
        return false;
    }
    else{
    document.getElementById("Names").innerHTML="" }

    var Contact=document.forms["registerform"]["Contact"].value;
    if(Contact==null || Contact=="")
    {
        document.getElementById("Contact").innerHTML="Contact Number is mandatory" 
        document.getElementById("Contact").style.color="red"
        return false;
    }
    if(Contact.length!=10){
        document.getElementById("Contact").innerHTML="Contact number must be of 10 digits" 
        document.getElementById("Contact").style.color="red"
        return false;
    }
    else{
        document.getElementById("Contact").innerHTML="" }

    var Mail=document.forms["registerform"]["Mail"].value;
    var regx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/
    if(Mail==null || Mail==""){
        document.getElementById("Mail").innerHTML="Please Enter E-mail" 
        document.getElementById("Mail").style.color="red"
        return false;
    }
    else if(!Mail.match(regx))
    {
        document.getElementById("Mail").innerHTML="Invalid E-mail" 
        document.getElementById("Mail").style.color="red"
        return false;
    }
    else{
    document.getElementById("Mail").innerHTML="" }

    var pass=document.forms["registerform"]["Passwords"].value;
    var cpass=document.forms["registerform"]["cpass"].value;    
    var pass_regx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
    if(pass == "" || pass==null){
        document.getElementById("Passwords").innerHTML="Please Enter Password" 
        document.getElementById("Passwords").style.color="red"
        return false;
    }
    if(!pass.match(pass_regx))
    {
        document.getElementById("Passwords").innerHTML="Password must contain 7 to 15 characters with at least one lowercase letter, one uppercase letter, one numeric digit, and one special character" 
        document.getElementById("Passwords").style.color="red"   
        return false;
    }
    else{
        document.getElementById("Passwords").innerHTML="" }
    if(cpass == "" || cpass == null)
    {
        document.getElementById("cpass").innerHTML="Please Enter password to confirm" 
        document.getElementById("cpass").style.color="red"
        return false;
    }
    if(pass!=cpass){
        document.getElementById("cpass").innerHTML="Password not matched" 
        document.getElementById("cpass").style.color="red"
        return false;
    }
    else{
        document.getElementById("cpass").innerHTML="" 
    }

}
</script>

</body>
</html>