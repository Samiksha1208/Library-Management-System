<!-- Book Details -->
<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

  $cart = "CREATE TABLE library.cart (c_id INTEGER,isbn INTEGER, PRIMARY KEY(c_id,isbn),FOREIGN KEY (c_id) REFERENCES register(id),FOREIGN KEY (isbn) REFERENCES book(isbn));";
  if ($conn->query($cart) === TRUE) {
    // echo "<br/>Table created successfully";
  } else {
    // echo "<br/>Error creating Table: " . $conn->error;
  }

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="library.css">
    <script src="https://kit.fontawesome.com/e84ad2eea8.js" crossorigin="anonymous"></script>
    <title>Your Cart</title>
</head>
<body style="background-image: url('books.jpg'); background-attachment: fixed;
  background-size: 100% 100%;">
  <div class="nav">
    <a class="active" href="library_login.php">Home</a>
    <a href="library_login.php">Login</a>
    <a href="library_register.php">Register</a>
    <a href="cart.php"><img src="cart.png" width=30px height=30px alt="Cart"></a>
  </div>
  <div class="d-flex justify-content-center">
    <h2 style="color: #3d0202;">Shopping Cart</h2>
  </div>
  <div style=" background-color: #cfbdbb; display: inline-block; padding: 29px 69px 22px 45px; margin-left: 49px; border: 2px solid black;">
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
    session_start();
    $c_id = $_SESSION["id"];
    $sql = "SELECT book.* FROM book INNER JOIN cart ON book.Isbn=cart.isbn WHERE c_id='$c_id';";
    $total ="SELECT SUM(Price) AS total FROM book INNER JOIN cart ON book.Isbn=cart.isbn GROUP BY c_id HAVING c_id='$c_id';";
    if ($conn->query($sql) == true) {
      //  echo "Success";
    } else {
      //  echo "ERROR: $sql <br> $conn->error";
    }
    if ($conn->query($total) == true) {
      //  echo "Success";
    } else {
      //  echo "ERROR: $total <br> $conn->error";
    }
    
    $rs = $conn->query($sql);
    $rs1 = $conn->query($total);
    $row1 = $rs1->fetch_assoc();
     while($row = $rs->fetch_assoc())
     { 
      print "<div class='d-flex bd-highlight'>
      <h4 class='me-auto p-2 bd-highlight' style='color: #3d0808;'>".$row['Title']."</h4>
      <a href='cart.php?isbn=".$row['Isbn']."&c_id=".$c_id."' style='color:black;'><i style ='cursor: pointer;' class = 'far fa-trash-alt mx-2 p-2 bd-highlight'></i></a>
    </div>";
    
    // print "<h4>".$row['Title']."</h4> </br>" ;
    print "<b>Author: </b>".$row['Author']."</br>";
    print "<b>Publisher: </b>".$row['Publisher']."</br>";
    print "<b>Price: </b>Rs. ".$row['Price']."</br>";
    // print "<i class = 'far fa-trash-alt mx-2'></i>";
    print "<br>";
    } 
    print "<b>Subtotal: </b>Rs. ".$row1["total"];

    ?> 
  </div> <br> <br>
  <button type="button" class="btn btn-info mx-5">Proceed To Buy</button> <br> <br>


  <!-- Deleting from cart -->
  <?php
 if (isset($_GET['isbn'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        $conn = new mysqli($servername, $username, $password);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

          $Isbn = $_GET['isbn'];
          $c_id = $_GET['c_id'];
          $cart_delete = "DELETE FROM library.`cart` WHERE `cart`.`c_id` = '$c_id' AND `cart`.`isbn` = '$Isbn'";
          if ($conn->query($cart_delete) == true) {
            header("Location: cart.php"); 
          }
          else {
               echo "Error";
          }
        }
  ?>
</body>
</html>