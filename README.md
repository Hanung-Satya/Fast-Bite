
<div align="center">

# 🍔 Fast-Bite  
**Website Pemesanan Fast Food Sederhana Berbasis PHP**

🚀 *Order your favorite burger fast and easy!*  

[![Made with PHP](https://img.shields.io/badge/Made%20with-PHP-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Frontend-HTML/CSS/JS](https://img.shields.io/badge/Frontend-HTML%2C%20CSS%2C%20JavaScript-orange)]()
[![License](https://img.shields.io/badge/License-MIT-blue)]()
[![Status](https://img.shields.io/badge/Status-Active-success)]()

---

</div>

## 🌟 Tentang Proyek

**Fast-Bite** adalah website restoran cepat saji berbasis **PHP, MySQL, HTML, CSS, dan JavaScript**, yang memungkinkan pengguna:
- Melihat daftar menu makanan
- Menambahkan item ke keranjang belanja
- Melakukan login/logout
- Melihat total pesanan secara dinamis

Website ini dirancang responsif dan bisa dijalankan langsung di server lokal (seperti XAMPP).

---

## 🧩 Fitur Utama

✅ Tampilan menu interaktif  
✅ Sistem login & logout pengguna  
✅ Fitur keranjang belanja (add to cart)  
✅ Responsif di desktop & mobile  
✅ Struktur file modular dan mudah dikembangkan  
✅ (Opsional) Dukungan admin untuk menambah menu  

---

## 🗂️ Struktur Direktori

```

Fast-Bite/
├── assets/           # CSS, JS, dan gambar pendukung
├── auth/             # Halaman login & register
├── config/           # File konfigurasi (koneksi database)
├── partials/         # Header, footer, dan komponen umum
├── uploads/          # File gambar menu yang diupload
├── cart.php          # Halaman keranjang
├── index.php         # Beranda utama
├── menu.php          # Daftar menu makanan
└── README.md         # Dokumentasi proyek ini

---

````

## ⚙️ Cara Instalasi

1. **Clone repository ini**
   ```bash
   git clone https://github.com/Hanung-Satya/Fast-Bite.git
````

2. **Letakkan di server lokal**

   * Pindahkan folder hasil clone ke direktori `htdocs` (jika pakai XAMPP)

3. **Buat database**

   * Buka `phpMyAdmin`
   * Buat database baru, misalnya `fastbite_db`
   * (Opsional) Import file SQL jika sudah tersedia

4. **Konfigurasi koneksi**

   * Buka file di folder `config/`
   * Edit konfigurasi sesuai pengaturan database kamu:

     ```php
     $host = "localhost";
     $user = "root";
     $pass = "";
     $dbname = "fastbite_db";
     ```

5. **Jalankan di browser**

   * Akses: [http://localhost/Fast-Bite](http://localhost/Fast-Bite)

---

## 🧠 Teknologi yang Digunakan

| Komponen | Teknologi                      |
| -------- | ------------------------------ |
| Backend  | PHP 8+                         |
| Database | MySQL / MariaDB                |
| Frontend | HTML5, CSS3, JavaScript        |
| Tools    | XAMPP / Laragon / Local Server |

---

## 🖼️ Preview Tampilan *(Contoh)*

> Tambahkan screenshot proyek kamu di bawah ini agar lebih menarik 👇

<div align="center">
  <img src="assets/preview-home.png" width="600px" alt="Preview Home Page">
  <p><em>Halaman utama Fast-Bite</em></p>
</div>

---

## 🧑‍💻 Cara Menggunakan

1. Register atau login dengan akun pengguna.
2. Jelajahi daftar menu dan klik tombol **Add to Cart**.
3. Buka halaman **Cart** untuk melihat pesananmu.
4. Hapus atau ubah jumlah item sesuai keinginan.
5. (Opsional) Lanjutkan ke checkout.

---

## 🧩 Kontribusi

Ingin ikut mengembangkan Fast-Bite? 🎯
Silakan ikuti langkah berikut:

1. Fork repository ini
2. Buat branch baru (`feature/nama-fitur`)
3. Commit dan push perubahanmu
4. Buat Pull Request ke branch utama

---

## 🪪 Lisensi

Proyek ini dilisensikan di bawah **MIT License** — kamu bebas menggunakannya untuk keperluan pribadi atau pengembangan lanjutan.
Silakan tambahkan file `LICENSE` jika ingin memperjelas penggunaan.

---

## 📞 Kontak

📧 **Hanung Satya**
🔗 [GitHub: Hanung-Satya](https://github.com/Hanung-Satya)
📍 Indonesia

---

<div align="center">

✨ *Built with love, caffeine, and burgers.* ✨

</div>
```

---
