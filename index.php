<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<title>Tabel kecamatan</title>
<body>

<h2>Data tabel Jumlah Penduduk per Kecamatan sebagian Kab. Sleman</h2>

</body>
</html>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_sleman"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM sleman_bersih";
$result = $conn->query($sql);

echo "<a href='input/index.html'>Input</a><br><br>";

if ($result->num_rows > 0) {
    echo 
    "<table border='1px'><tr>
    <th>id</th>
    <th>Kecamatan</th>
    <th>Longitude</th>
    <th>Latitude</th>
    <th>Luas</th>
    <th>Jumlah Penduduk</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["id"]."</td>
        <td>".$row["kecamatan"]."</td>
        <td>".$row["longitude"]."</td>
        <td>".$row["latitude"]."</td>
        <td>".$row["luas"]."</td>
        <td align='right'>".$row["jumlah_penduduk"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>