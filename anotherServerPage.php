<?php
$servername = "localhost";
$user = "root";
$password = "";
$databaseName = "chatroom";

$conn = new mysqli($servername,$user,$password,$databaseName);

if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT * FROM  `users`";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $username, $email);
$stmt->fetch();
$stmt->close();

echo "<table>";
echo "<tr>";
echo "<th>CustomerID</th>";
echo "<td>" . $id . "</td>";
echo "<th>CompanyName</th>";
echo "<td>" . $username . "</td>";
echo "<th>ContactName</th>";
echo "<td>" . $email . "</td>";
echo "</tr>";
echo "</table>";
?>
?>