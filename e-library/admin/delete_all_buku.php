<?php
// Include file koneksi database
include 'connection.php';

// Query untuk menghapus semua data dari tabel data_siswa
$query = "DELETE FROM data_buku";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    // Redirect kembali ke halaman utama setelah penghapusan berhasil
    header("Location: databuku.php");
} else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . mysqli_error($conn);
}

// Tutup koneksi database
mysqli_close($conn);
?>
