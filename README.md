# 📋 Laporanku
Website laporan harian dan akhir peserta magang di DISKOMINFO Medan.


## 📸 Screenshot

<table>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/e8757de7-d016-4d9e-ab7c-b648b5acc137" width="100%"/><br/><p align="center">Halaman Utama</p></td>
    <td><img src="https://github.com/user-attachments/assets/7d234eca-751d-4a52-8c86-01dc4a8c9481" width="100%"/><br/><p align="center">Login</p></td>
  </tr>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/10a19b92-3b38-47b0-a752-c43d0501cfdd" width="100%"/><br/><p align="center">Dashboard</p></td>
    <td><img src="https://github.com/user-attachments/assets/d278108a-445b-47dd-a96b-100e486ca782" width="100%"/><br/><p align="center">Laporan Harian</p></td>
  </tr>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/e2bd6633-6ad8-4e9f-8a6f-9cf3bc21a60d" width="100%"/><br/><p align="center">Laporan Akhir</p></td>
    <td><img src="https://github.com/user-attachments/assets/ba6fbd24-6256-4a1d-8c0a-ca3b527e02e3" width="100%"/><br/><p align="center">Profil</p></td>
  </tr>
</table>

---

## 🛠️ Teknologi
- PHP Native dengan arsitektur MVC
- MySQL
- Bootstrap 4
- PHPMailer
- jQuery & AJAX
- SweetAlert2

---

## ✨ Fitur
- Manajemen peserta magang
- Laporan harian & laporan akhir
- Approval / penolakan laporan oleh mentor
- Forget Password dengan email
- Upload dokumentasi (file & URL)
- Filter & pencarian laporan

---

## 👤 Demo Login

| Role | Username | Password |
|------|----------|----------|
| Admin | adminlaporanku | 12345678 |
| Peserta | peserta | 12345678 |
| Mentor | mentorti | 12345678 |

---

## ⚙️ Instalasi
1. Clone repo ini
```bash
   git clone https://github.com/putrahyt/laporanku.git
```
2. Copy file konfigurasi
```bash
   cp app/config/config.example.php app/config/config.php
```
3. Isi kredensial database dan SMTP di `config.php`
4. Import `laporanku.sql` ke MySQL
5. Jalankan di localhost / Laragon
