
<!-- Book Details -->
<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
ob_start();
if ($conn->connect_error) {
  // die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

$sql = "CREATE DATABASE library";
  if ($conn->query($sql) === TRUE) {
    // echo "Database created successfully";
  } else {
    // echo "Error creating database: " . $conn->error;
  }

  $book = "CREATE TABLE library.book (B_name VARCHAR(100), Isbn INTEGER, Title VARCHAR(100),Author VARCHAR(100),Publisher VARCHAR(100),price FLOAT, PRIMARY KEY(Isbn));";
  if ($conn->query($book) === TRUE) {
    // echo "<br/>Table created successfully";
  } else {
    // echo "<br/>Error creating Table: " . $conn->error;
  }

  $register = "CREATE TABLE library.register (id INTEGER NOT NULL AUTO_INCREMENT,Names VARCHAR(100), Contact INTEGER, Mail VARCHAR(100),Passwords VARCHAR(100), PRIMARY KEY(id));";
  if ($conn->query($register) === TRUE) {
    // echo "<br/>Table created successfully";
  } else {
    // echo "<br/>Error creating Table: " . $conn->error;
  }

if (isset($_POST['Isbn'])) {
  $B_name = $_POST['B_name'];
  $Isbn = $_POST['Isbn'];
  $Title = $_POST['Title'];
  $Author = $_POST['Author'];
  $Publisher = $_POST['Publisher'];

  $book_insert = "INSERT INTO library.book (B_name,Isbn,Title,Author,Publisher) VALUES ('$B_name', '$Isbn', '$Title', '$Author', '$Publisher');";

  if ($conn->query($book_insert) == true) {
    //  echo "Success";
  } else {
    //  echo "ERROR: $book_insert <br> $conn->error";
  }

$conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <title>Book Details</title>
  <link rel="stylesheet" href="library.css">
</head>

<body style="background-image: url('books.jpg'); background-attachment: fixed;
  background-size: 100% 100%;">
  <div class="nav">
    <a class="active" href="library_login.php">Home</a>
    <a href="library_login.php">Login</a>
    <a href="library_register.php">Register</a>
    <a href="cart.php"><img src="cart.png" width=30px height=30px alt="Cart"></a>
  </div>
 <div class="container"></div>

  <!-- View Records -->
  <div class="d-flex justify-content-center">
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password,'library');

    if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
    }
    else{
        // echo "success";
    }
    $sql = "SELECT * FROM book";
    if ($conn->query($sql) == true) {
      //  echo "Success";
    } else {
      //  echo "ERROR: $sql <br> $conn->error";
    }
    
    $rs = $conn->query($sql);
    print"<table style = 'background-color:#F0F8FF; border: 1px black solid;'>";
    print"<tr style =  'border: 1px black solid;'>";
    print"  <td style = 'border: 1px black solid; text-align: center;' width=200><b>Book Title</b></td> ";
    print"  <td style = 'border: 1px black solid; text-align: center;' width=150><b>ISBN</b></td> ";
    print"  <td style = 'border: 1px black solid; text-align: center;' width=150><b>Author</b></td>";
    print"  <td style = 'border: 1px black solid; text-align: center;' width=250><b>Publisher</b></td>";
    print"  <td style = 'border: 1px black solid; text-align: center;' width=150><b>Price</b></td>";
    print"  <td style = 'border: 1px black solid; text-align: center;' width=250><b>Do you want to Edit?</b></td>";
    print"  <td style = 'border: 1px black solid; text-align: center;' width=250><b>Do you want to Delete?</b></td>";
    print"  <td style = 'border: 1px black solid; text-align: center;' width=250><b>Add to cart</b></td>";
    print"  </tr> ";
     while($row = $rs->fetch_assoc())
     { 
    print "<tr style = 'border: 1px black solid; text-align: center;'>"; 
    print "<td style = 'border: 1px black solid; text-align: center;'>" . $row['Title'] . "</td>"; 
    print "<td style = 'border: 1px black solid; text-align: center;'>" . $row['Isbn'] . "</td>";
    print "<td style = 'border: 1px black solid; text-align: center;'>" . $row['Author'] . "</td>";
    print "<td style = 'border: 1px black solid; text-align: center;'>" . $row['Publisher'] . "</td>";
    print "<td style = 'border: 1px black solid; text-align: center;'>"."Rs. ". $row['Price'] . "</td>";
    print "<td style = 'border: 1px black solid; text-align: center;'><a class='btn btn-primary' href='library.php?edit=".$row['Isbn']."' >Edit</a></td>";
    print "<td style = 'border: 1px black solid; text-align: center;'> <a onclick='Ondelete()' class='btn btn-danger' href='library.php?delete=".$row['Isbn']."'>Delete</a> </td>";
    print "<td style = 'border: 1px black solid; text-align: center;'><a class='btn btn-success' href='library.php?cart=".$row['Isbn']."' >Add to Cart</a></td>";
    print "</tr>"; 
    } 
    print "</table> <br>"; 
    ?> 
  </div>
  <br> <br>
  <div class="d-flex justify-content-center">
  <button type='button' id="btn" class='btn btn-primary' onclick="toggleview()">Click here to insert book record</button>
  </div> <br> <br>
<!-- Adding Records -->
<div class="d-flex justify-content-center">
<div  id="see" style="display: none;">
    <form name="myform" action="library.php"  method="post" onsubmit="return validateForm()" style="
        display: inline-block;
        width: 500px;
        padding: 20px 20px;
        background-color: hsla(201, 100%, 6%, 0.6);
        color:aliceblue;
        box-shadow: rgba(0, 0, 0, 0.36) 0px 5px 15px;">
      <div class="row mb-3">
        <label for="B_name" class="col-sm-2 col-form-label">Book Name</label>
        <div class="col-sm-10">
          <input name="B_name" type="text" placeholder="Enter Name of the book" class="form-control"/>
          <br>
          <span id="B_name"></span>
        </div>
      </div>

      <div class="row mb-3">
        <label for="Isbn" class="col-sm-2 col-form-label">ISBN No.</label>
        <div class="col-sm-10">
          <input name="Isbn" type="number" placeholder="Enter ISBN No." class="form-control" /> <br>
          <span id="Isbn"></span>
        </div>
      </div>

      <div class="row mb-3">
        <label for="Title" class="col-sm-2 col-form-label">Book Title</label>
        <div class="col-sm-10">
          <input name="Title" type="text" placeholder="Enter Title of the book" class="form-control" /> <br>
          <span id="Title"></span>
        </div>
      </div>

      <div class="row mb-3">
        <label for="Author" class="col-sm-2 col-form-label">Author Name</label>
        <div class="col-sm-10">
          <input name="Author" type="text" placeholder="Enter Author's Name" class="form-control" /> <br>
          <span id="Author"></span>
        </div>
      </div>

      <div class="row mb-3">
        <label for="Publisher" class="col-sm-2 col-form-label">Publisher Name</label>
        <div class="col-sm-10">
          <input name="Publisher" type="text" placeholder="Enter Publisher's Name" class="form-control" /> <br>
          <span id="Publisher"></span>
        </div>
      </div>

      <div class="row mb-3">
        <label for="price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
          <input name="price" type="number" placeholder="Enter Price" class="form-control" /> <br>
          <span id="price"></span>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
          <div class="form-check">
            <input class="form-check-input" name="check" type="checkbox" id="gridCheck1" checked />
            <label class="form-check-label" for="gridCheck1">
              I agree to the Terms of Use
            </label>
          </div>
        </div>
      </div>
      <button style="margin-left: 200px" type="submit" class="btn btn-primary">
        Submit
      </button>
      <a class="btn btn-danger" href="library_login.php">Log Out</a>
    </form>
</div>
  </div> <br> <br>

<!-- Deleting Records -->
<?php
 if (isset($_GET['delete'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        $conn = new mysqli($servername, $username, $password);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

          $Isbn = $_GET['delete'];
          $book_delete = "DELETE FROM library.book WHERE Isbn = '$Isbn';";

          if ($conn->query($book_delete) == true) {
            header("Location: library.php"); 
          } else {
              //  echo "ERROR: $book_delete <br> $conn->error";
          }
        }
  ?>



<!-- Modal For Editing Books -->
<?php

 if (isset($_GET['edit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        $conn = new mysqli($servername, $username, $password);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

          $Isbn = $_GET['edit'];
          $book = "SELECT * FROM library.BOOK WHERE Isbn = '$Isbn';";

          if ($conn->query($book) == true) {
            // header("Location: library.php"); 
          } else {
              //  echo "ERROR: $book <br> $conn->error";
          }
          $rs1 = $conn->query($book) or die($conn->error);
          while($row1 = $rs1->fetch_assoc())
          {
            $B_name = $row1['B_name'];
            $Isbn = $row1['Isbn'];
            $Title = $row1['Title'];
            $Author = $row1['Author'];
            $Publisher = $row1['Publisher'];
            $Price = $row1['Price'];
          }
        

 echo "<div class='modal' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Edit Record</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
      <form name='editform' action='library.php' method='post'>
      <div class='row mb-3'>
        <label for='B_name' class='col-sm-2 col-form-label'>Book Name</label>
        <div class='col-sm-10'>
          <input name='B_name1' type='text' value='$B_name' class='form-control'/>
          <br>
          <span id='B_name'></span>
        </div>
      </div>

      <div class='row mb-3'>
        <label for='Isbn' class='col-sm-2 col-form-label'>ISBN No.</label>
        <div class='col-sm-10'>
          <input name='Isbn1' readonly='readonly' value='$Isbn' class='form-control' /> <br>
          <span id='Isbn'></span>
        </div>
      </div>

      <div class='row mb-3'>
        <label for='Title' class='col-sm-2 col-form-label'>Book Title</label>
        <div class='col-sm-10'>
          <input name='Title1' type='text' value='$Title' class='form-control' /> <br>
          <span id='Title'></span>
        </div>
      </div>

      <div class='row mb-3'>
        <label for='Author' class='col-sm-2 col-form-label'>Author Name</label>
        <div class='col-sm-10'>
          <input name='Author1' type='text' value='$Author' class='form-control' /> <br>
          <span id='Author'></span>
        </div>
      </div>

      <div class='row mb-3'>
        <label for='Publisher' class='col-sm-2 col-form-label'>Publisher Name</label>
        <div class='col-sm-10'>
          <input name='Publisher1' type='text' value='$Publisher' class='form-control' /> <br>
          <span id='Publisher'></span>
        </div>
      </div>

      <div class='row mb-3'>
        <label for='price' class='col-sm-2 col-form-label'>Price</label>
        <div class='col-sm-10'>
          <input name='price1' type='text' value='$Price' class='form-control' /> <br>
          <span id='price'></span>
        </div>
      </div>


      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' name='saveEdit' class='btn btn-primary'>Save changes</button>
      </div>
    </div>
  </div>
</div>";
        }

        echo " <script> 
        $(document).ready(function () {
          $('#exampleModal').modal('show');
        });

        </script>";

        if (isset($_POST['saveEdit'])) {
          $servername = "localhost";
          $username = "root";
          $password = "";
          
          $conn = new mysqli($servername, $username, $password);
          
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
            $B_name = $_POST['B_name1'];
            $Isbn = $_POST['Isbn1'];
            $Title = $_POST['Title1'];
            $Author = $_POST['Author1'];
            $Publisher = $_POST['Publisher1'];
            $Price = $_POST['price1'];
        $saveEdit = "UPDATE library.`book` SET `B_name` = '$B_name',`Title` = '$Title',`Isbn` = '$Isbn',`Author` = '$Author',`Publisher`='$Publisher',`price` = '$Price' WHERE `book`.`Isbn` = $Isbn;";
        if ($conn->query($saveEdit) == true) {
          header("Location: library.php"); 
        } else {
            //  echo "ERROR: $saveEdit <br> $conn->error";
        }
        }
$conn->close();
?>

<!-- Add To cart -->
<?php

 if (isset($_GET['cart'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        $conn = new mysqli($servername, $username, $password);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        session_start();
        $c_id = $_SESSION["id"];
        $isbn = $_GET['cart'];

        $sql ="INSERT INTO library.`cart` (`c_id`, `isbn`) VALUES ('$c_id', '$isbn');";
        if ($conn->query($sql) == true) {
          header("Location: library.php");
        } else {
            //  echo "ERROR: $sql <br> $conn->error";
        }
        $conn->close();
      }
?>


  <script type="text/JavaScript">


     function toggleview(){
    let btn = document.getElementById('btn');
    let see = document.getElementById('see'); 
    if(see.style.display != 'none'){
    see.style.display = 'none';
    }
    else{
    see.style.display = 'block';
    }
  }

  function Ondelete(){
    alert('Are you sure you want to delete the record?');
  }

    function validateForm()
{
    // Book Details
    var B_name=document.forms["myform"]["B_name"].value;  
    if(B_name==null || B_name=="" )
    {
        document.getElementById("B_name").innerHTML="Please Enter the Book's Name" 
        document.getElementById("B_name").style.color="red"
        return false;
    }
    else{
    document.getElementById("B_name").innerHTML="" }

    var Isbn=document.forms["myform"]["Isbn"].value;
    if(Isbn==null || Isbn=="")
    {
        document.getElementById("Isbn").innerHTML="Please Enter ISBN number" 
        document.getElementById("Isbn").style.color="red"
        return false;
    }
    // if(isbn.length!=10){
    //     document.getElementById("Isbn").innerHTML="ISBN number must be of 10 digits" 
    //     document.getElementById("Isbn").style.color="red"
    //     return false;
    // }
    else{
        document.getElementById("Isbn").innerHTML="" }

    var Title=document.forms["myform"]["Title"].value;
    if(Title==null || Title=="")
    {
        document.getElementById("Title").innerHTML="Title is mandatory" 
        document.getElementById("Title").style.color="red"
        return false;
    }
    else{
        document.getElementById("Title").innerHTML="" }

    var Author=document.forms["myform"]["Author"].value;
    if(Author==null || Author=="")
    {
        document.getElementById("Author").innerHTML="Name of author is mandatory" 
        document.getElementById("Author").style.color="red"
        return false;
    }
    else{
        document.getElementById("Author").innerHTML="" }

    var Publisher=document.forms["myform"]["Publisher"].value;
    if(Publisher==null || Publisher=="")
    {
        document.getElementById("Publisher").innerHTML="Name of publisher is mandatory" 
        document.getElementById("Publisher").style.color="red"
        return false;
    }
    else{
        document.getElementById("Publisher").innerHTML="" }
    }

    </script>
</body>

</html>