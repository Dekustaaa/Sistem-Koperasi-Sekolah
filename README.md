# Sistem Informasi Koperasi Sekolah

Aplikasi CRUD PHP Native + MySQL untuk studi kasus **Sistem Informasi Koperasi Sekolah**
(LKS SMK Kristen Immanuel Pontianak).

Fitur yang sudah jadi:

- Autentikasi: **register, login, logout** (password disimpan sebagai teks biasa sesuai permintaan).
- Otorisasi sederhana: **admin** boleh CRUD, **member** hanya melihat data.
- CRUD **Produk**, **Supplier**, dan **Pegawai**.
- Validasi server-side + pesan error per kolom.
- **Prepared statement** dan **database transaction** (`beginTransaction`, `commit`, `rollBack`) pada proses tambah, ubah, dan hapus.
- Data checkbox supplier disimpan sebagai **JSON** di kolom `product_types`.
- Form edit otomatis menampilkan data lama (radio, checkbox, dropdown, dan input lain).

> Catatan: sesuai permintaan, file `middleware/auth.php` **tidak diubah**. Pengecekan
> login/role dipusatkan di `config/auth.php` (helper) agar halaman tetap aman.

---

## 1. Cara Menjalankan

1. Jalankan **MySQL** dari Laragon (Start All).
2. Import database:

   ```bash
   mysql -u root < database.sql
   ```

   Atau buka `database.sql` di HeidiSQL/phpMyAdmin lalu jalankan.
3. Jalankan PHP dari dalam folder project:

   ```bash
   cd C:\laragon\www\SKS
   php -S localhost:8080
   ```

4. Buka `http://localhost:8080`.

### Akun untuk mencoba

| Role   | Email             | Password   |
| ------ | ----------------- | ---------- |
| Admin  | `admin@sks.test`  | `admin123` |
| Member | `siswa@sks.test`  | `admin123` |

Akun member juga bisa dibuat sendiri lewat halaman **Daftar**.

---

## 2. Struktur Folder Penting

```
SKS/
├── database.sql                  -> export database + data contoh
├── index.php                     -> landing page
├── config/
│   ├── database.php              -> koneksi PDO
│   └── auth.php                  -> helper login/role/flash (middleware tetap dibiarkan)
├── middleware/auth.php           -> tidak diubah
├── repositories/
│   ├── user-repository.php
│   ├── product-repository.php
│   ├── supplier-repository.php
│   └── employee-repository.php
├── validations/
│   ├── auth-validation.php
│   ├── product-validation.php
│   ├── supplier-validation.php
│   └── employee-validation.php
├── actions/
│   ├── auth/                     -> register, login, logout
│   ├── products/                 -> store, update, destroy
│   ├── suppliers/                -> store, update, destroy
│   └── employees/                -> store, update, destroy
├── pages/
│   ├── auth/                     -> login, register
│   ├── products/                 -> index, create, edit
│   ├── suppliers/                -> index, create, edit
│   ├── employees/                -> index, create, edit
│   └── errors/403.php
├── components/
│   ├── admin/                    -> sidebar, topbar
│   └── landing/                  -> header, footer
└── styles/                       -> CSS semua halaman
```

---

## 3. Alur Kerja Aplikasi

### Autentikasi

```
Register  -> validasi -> cek email unik -> insert users (role = member) -> login
Login     -> validasi -> getUserByEmail -> password_verify -> simpan $_SESSION['user']
Logout    -> kosongkan $_SESSION -> session_destroy -> halaman login
```

- Password disimpan sebagai **teks biasa** sesuai permintaan (tanpa hash/enkripsi).
- Role **tidak** diambil dari form register, tetapi ditulis di kode (`member`).
- Halaman login/register memakai `requireGuest()`, halaman CRUD memakai `requireLogin()`.
- Aksi tambah/ubah/hapus memakai `requireAdmin()`.

### Pola CRUD

```
Form (pages/.../create.php)
  -> actions/.../store.php
     -> getXxxRequest()  : bersihkan input
     -> validateXxx()    : kumpulkan error
     -> jika error       : simpan ke $_SESSION, balik ke form
     -> beginTransaction -> INSERT -> commit
  -> redirect ke index.php
```

- `index.php` menampilkan data dari repository.
- `edit.php` mengambil data lama; `$data = $old ?: $rowDariDatabase` sehingga input
  pengguna tidak hilang saat validasi gagal.
- `destroy.php` menghapus berdasarkan `id` dengan konfirmasi `confirm()` di tombol hapus.

### Aturan validasi utama

| Tabel     | Aturan                                                                                       |
| --------- | -------------------------------------------------------------------------------------------- |
| Users     | Nama wajib; email valid & unik; password minimal 8 karakter dan harus sama dengan konfirmasi  |
| Products  | Kode wajib, maks 10, unik; nama wajib; kategori/unit harus sesuai ENUM; harga & stok >= 0     |
| Suppliers | Nama/email/alamat wajib; email valid; telepon maks 15; minimal 1 jenis produk; tanggal valid |
| Employees | Nomor wajib, maks 10, unik; nama wajib; gender M/F; jabatan sesuai ENUM; gaji >= 0            |

### Penyimpanan checkbox supplier

Input: `product_types[]` (array) -> divalidasi -> `json_encode()` -> kolom `product_types`.

Contoh isi database:

```json
["Food", "Drink"]
```

Saat edit, JSON di-`json_decode()` kembali menjadi array lalu dicentang sesuai data lama.

---

## 4. Pemetaan ke Soal

| Komponen soal             | Implementasi                                              |
| ------------------------- | --------------------------------------------------------- |
| Tabel `products`          | `database.sql`, `pages/products`, `actions/products`      |
| Tabel `suppliers`         | `database.sql`, `pages/suppliers`, `actions/suppliers`    |
| Tabel `employees`         | `database.sql`, `pages/employees`, `actions/employees`    |
| Read                      | `pages/*/index.php`                                       |
| Create                    | `pages/*/create.php` + `actions/*/store.php`              |
| Update                    | `pages/*/edit.php` + `actions/*/update.php`               |
| Delete + konfirmasi       | `actions/*/destroy.php` + `onclick="return confirm()"`    |
| Validasi                  | Folder `validations/`                                     |
| Prepared statement        | Semua query di `repositories/` dan `actions/`             |
| Transaction (Kelas 11)    | `beginTransaction` / `commit` / `rollBack` di setiap aksi |
| Checkbox disimpan JSON    | `suppliers.product_types`                                 |
| Login/Register            | `pages/auth`, `actions/auth`, `repositories/user-*`       |

---

## 5. Kebutuhan

- PHP 8.0+ (PDO MySQL, mbstring)
- MySQL 8.x
- Laragon (disarankan)
