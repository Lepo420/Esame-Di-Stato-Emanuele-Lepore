<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $welcomeMessage = "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header('Location: login.php');
}
$servername = "localhost";
$username = "emanuele";
$password = "Romanista_66";
$dbname = "MarconiGo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>
<div id="nav">
<ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="CategoriesP.php">Categoria</a> 
        <li><a href="BrandsP.php">Brand</a>
        <li><a href="ProductP.php">Prodotto</a> 
        <li><a href="OrdersP.php">Ordine</a> 
	    	<li><a href="RicercaP.php">Query 1 </a>
        <li><a href="RicercaP2.php">Query 2 </a>
        <li><a href="logout.php">Logout</a></li><br>
    </ul>   
</div>
<div class="bg-text">
<?php

$brands_title= $_POST["brands_title"];

$sql = "SELECT DISTINCT * FROM  product p, brands b WHERE p.brands_id=b.brands_id AND b.brands_title= '$brands_title' GROUP BY p.product_id";
$result = mysqli_query($conn,$sql);

echo "<table>
<tr>
<th>ID Prodotto</th>
<th>ID Categoria</th>
<th>ID Brand</th>
<th>Titolo prodotto</th>
<th>Prezzo prodotto</th>
<th>Quantità prodotto</th>
<th>Descrizione prodotto</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['product_id'] . "</td>";
  echo "<td>" . $row['cat_id'] . "</td>";
  echo "<td>" . $row['brands_id'] . "</td>";
  echo "<td>" . $row['product_title'] . "</td>";
  echo "<td>" . $row['product_price'] . "</td>";
  echo "<td>" . $row['product_qty'] . "</td>";
  echo "<td>" . $row['product_desc'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>
</div>
</body>
</html>
