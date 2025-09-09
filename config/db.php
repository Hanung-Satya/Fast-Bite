<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'fastbite';

$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn -> connect_error) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>