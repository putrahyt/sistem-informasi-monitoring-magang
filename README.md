# 🎓 Sistem Informasi Monitoring Magang

Sistem informasi untuk memonitor kegiatan peserta magang di instansi, mencakup absensi, laporan aktivitas, bimbingan, hingga penilaian peserta.


## 📸 Screenshot
<table>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/a55fd951-d7df-4887-93d5-ffde66f68176" width="100%"/><br/><p align="center">Halaman Utama</p></td>
    <td><img src="https://github.com/user-attachments/assets/c35f442a-a525-4689-96ce-4fba69dcf66f" width="100%"/><br/><p align="center">Dashboard</p></td>
  </tr>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/c3c6c6fe-ada0-4b24-bffc-46c1b2090735" width="100%"/><br/><p align="center">Absensi</p></td>
    <td><img src="https://github.com/user-attachments/assets/19eeb30b-14f9-4da0-b65d-6d846e70ee39" width="100%"/><br/><p align="center">Laporan Aktivitas</p></td>
  </tr>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/44e6dbc2-edfa-44cb-a86b-903f9b97eb5e" width="100%"/><br/><p align="center">Bimbingan Magang</p></td>
    <td><img src="https://github.com/user-attachments/assets/2e9915ab-895a-4b44-a689-da4b52e747f7" width="100%"/><br/><p align="center">Penilaian Peserta</p></td>
  </tr>
  <tr>
    <td colspan="2"><img src="https://github.com/user-attachments/assets/6852549f-ea32-4ac0-b7d4-c9ba5aef18ff" width="100%"/><br/><p align="center">Profil</p></td>
  </tr>
</table>


## 🛠️ Teknologi
- PHP Native dengan arsitektur MVC
- MySQL
- Bootstrap
- PHPMailer
- jQuery & AJAX
- SweetAlert2

---

## ✨ Fitur
- Manajemen peserta magang
- Absensi peserta
- Laporan aktivitas peserta
- Bimbingan magang
- Penilaian peserta
- Approval / penolakan laporan aktivitas oleh mentor
- Forgot password via email
- Upload dokumentasi (file & URL)
- Filter & pencarian laporan aktivitas dan absensi

---

## 👤 Demo Login

| Role | Username / Email | Password |
|------|-----------------|----------|
| Admin | adminmagang | adminmagang |
| Peserta | peserta@gmail.com | 12345 |
| Mentor | mentor | 12345 |
| Tamu | — | Langsung Login |

---

## ⚙️ Instalasi
1. Clone repo ini
```bash
   git clone https://github.com/putrahyt/sistem-informasi-monitoring-magang.git
```
2. Copy file konfigurasi
```bash
   cp app/config/config.example.php app/config/config.php
```
3. Isi kredensial database dan SMTP di `config.php`
4. Import file SQL ke MySQL
5. Jalankan di localhost / Laragon

---
