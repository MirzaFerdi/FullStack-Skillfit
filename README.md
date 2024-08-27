# FullStack Skillfit PT. Beon Intermedia Full Stack Developer
Proyek ini adalah aplikasi yang dikembangkan sebagai bagian dari tes keterampilan untuk posisi Full Stack Developer di PT Beon Intermedia.

# Informasi Projek
1. Laravel v10.48.20
2. PHP 8.1

# Tutorial Instalasi 
 1. Clone Repositori.
 2. Setelah clone berhasil, buka hasil clone di teks editor.
 3. Buka terminal pada teks editor, kemudian kita menuju ke folder Skillfit-Beon dengan perintah 'cd Skillfit-Beon' pada terminal.
 4. Setelah kita berada pada folder Skillfit-Beon, kita ketikkan perintah 'composer install' pada terminal.
 5. Setalah itu kita copy file .env.example, dengan perintah 'cp .env.example .env' pada terminal.
 6. Setelah melakukan installasi, kita dapat mengkonfigurasi database pada file .env
 7. Pada .env terdapat DB_DATABASE=laravel, ubah nama database sesuai yang akan anda gunakan.
 8. Buka dan jalankan aplikasi lokal server seperti xampp atau laragon.
 9. Setelah itu pada terminal jalankan perintah 'php artisan key:generate' yang digunakan untuk menghasilkan dan mengatur kunci enkripsi aplikasi.
 10. Setelah memastikan nama database sudah sama dengan yang kita buat, kita dapat melakukan migrasi dengan perintah pada terminal 'php artisan migrate'.
 11. Setelah migrasi berhasil, kita dapat melakukan seeding data kedalam database dengan perintah 'php artisan db:seed' pada terminal.
 12. Setelah proses migrasi dan seeding berhasil, kita dapat menjalankan server dengan perintah 'php artisan serve' pada terminal.
 13. Setelah server berjalan, sekarang kita jalankan front end dengan buka terminal baru dengan direktori yang sama.
 14. Setelah itu kita jalankan perintah 'npm install' untuk menginstall dependensi front end pada terminal yang baru.
 15. Setelah dependensi front end berhasil diinstall, sekarang ketikkan perintah 'npm run dev' pada terminal.
 16. Pastikan Server dan Front end berjalan, kita dapat mengakses halaman pada http://127.0.0.1:8000/ 
 17. Email: admin@mail.com  Password: password123

## ERD dan Screenshot Per Fitur
1. ERD
![Alt text](/Image/ERD%20Perumahan.png)

2. Halaman Login
![Alt text](/Image/halaman-login.png)

3. Halaman Dashboard
![Alt text](/Image/halaman-dashboard.png)

4. Halaman Menu Rumah
![Alt text](/Image/menu-rumah.png)

5. Halaman Detil Rumah
![Alt text](/Image/detil-rumah.png)

6. Halaman Tambah Rumah
![Alt text](/Image/tambah-rumah.png)

7. Halaman Menu Penghuni
![Alt text](/Image/menu-penghuni.png)

8. Halaman Tambah Penghuni
![Alt text](/Image/tambah-penghuni.png)

9. Halaman Menu Riwayat Penghuni
![Alt text](/Image/menu-riwayatpenghuni.png)

10. Halaman Menu Menu Pembayaran
![Alt text](/Image/menu-pembayaran.png)

11. Halaman Tambah Pembayaran
![Alt text](/Image/tambah-pembayaran.png)

12. Halaman Menu Pengeluaran
![Alt text](/Image/menu-pengeluaran.png)

13. Halaman Tambah Pengeluaran
![Alt text](/Image/tambah-pengeluaran.png)


# Kesimpulan
Kesimpulan dari website manajemen perumahan, yaitu RT sebagai admin dapat melakukan pengelolaan perumahan, dari menambahkan penghuni, mencatat penghuni yang keluar, mengelola pemasukan dan pengeluaran, dll.