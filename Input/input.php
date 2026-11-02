
<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$kecamatan = trim($_POST['kecamatan'] ?? '');
$longitude = $_POST['longitude'] ?? '';
$latitude = $_POST['latitude'] ?? '';
$luas = $_POST['luas'] ?? '';
$jumlah_penduduk = $_POST['jumlah_penduduk'] ?? '';

if (
    $kecamatan === '' ||
    !is_numeric($longitude) ||
    !is_numeric($latitude) ||
    !is_numeric($luas) ||
    (float)$luas <= 0 ||
    !ctype_digit((string)$jumlah_penduduk)
) {
    die("Data tidak lengkap atau format tidak valid.");
}

$conn = new mysqli("localhost", "root", "", "data_sleman");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "INSERT INTO sleman_bersih
        (kecamatan, longitude, latitude, luas, jumlah_penduduk)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sdddi",
    $kecamatan,
    $longitude,
    $latitude,
    $luas,
    $jumlah_penduduk
);

if ($stmt->execute()) {
    header("Location: ../index.php");
    exit;
} else {
    echo "Data gagal disimpan.";
}

$stmt->close();
$conn->close();
?>
