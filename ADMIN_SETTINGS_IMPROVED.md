# Admin Settings - Dokumentasi

## Overview
Halaman Admin Settings adalah bagian dari sistem PPDB yang memungkinkan administrator untuk mengelola pengaturan dasar sistem, meliputi:

1. **Tahun Ajaran** - Pengaturan periode akademik
2. **Kategori** - Klasifikasi siswa berdasarkan jenis dan biaya SPP
3. **Gelombang Pendaftaran** - Periode waktu pendaftaran siswa

## Fitur yang Telah Diperbaiki

### 1. Tampilan UI/UX
- **Bootstrap Layout**: Menggunakan Bootstrap 4 dengan desain yang responsive
- **Tab Navigation**: Navigasi tab yang smooth dengan icon yang sesuai
- **Card Layout**: Tampilan data dalam bentuk kartu yang menarik
- **Loading States**: Indikator loading yang jelas saat memuat data
- **Empty States**: Tampilan kosong yang informatif ketika belum ada data

### 2. Controller Improvements
- **Validasi Input**: Validasi yang lebih ketat untuk semua input
- **Error Handling**: Penanganan error yang lebih baik dengan logging
- **Response Format**: Format response JSON yang konsisten
- **Security**: Validasi duplikasi data dan constraint checking

### 3. Model Enhancements
- **UUID Generation**: Konsistensi penggunaan helper generateUUID()
- **Soft Deletes**: Implementasi soft delete untuk data safety
- **Validation Rules**: Aturan validasi yang komprehensif
- **Helper Methods**: Method tambahan untuk statistics dan utility

### 4. JavaScript Functionality
- **AJAX Operations**: Operasi CRUD via AJAX yang smooth
- **Form Validation**: Validasi form di frontend sebelum submit
- **User Feedback**: Toast notifications dan alerts yang informatif
- **Auto-generation**: Auto-generate nama tahun ajaran dari tahun mulai/selesai

## Struktur File

```
app/
├── Controllers/
│   └── AdminSettings.php (Diperbaiki)
├── Models/
│   ├── TahunAjaranModel.php (Diperbaiki)
│   ├── KategoriModel.php (Diperbaiki)
│   └── GelombangPendaftaranModel.php (Sudah ada)
└── Views/
    └── admin/
        └── settings/
            └── index.php (Diperbaiki)

public/
└── assets/
    ├── js/
    │   └── admin-settings.js (Baru)
    └── css/
        └── admin-settings.css (Baru)
```

## API Endpoints

### Tahun Ajaran
- `GET /admin/settings/getTahunAjaran` - Mengambil semua data tahun ajaran
- `POST /admin/settings/storeTahunAjaran` - Menambah tahun ajaran baru
- `POST /admin/settings/updateTahunAjaran/{id}` - Update tahun ajaran
- `DELETE /admin/settings/deleteTahunAjaran/{id}` - Hapus tahun ajaran
- `POST /admin/settings/activateTahunAjaran/{id}` - Aktivasi/deaktivasi tahun ajaran

### Kategori
- `GET /admin/settings/getKategori` - Mengambil semua data kategori
- `POST /admin/settings/storeKategori` - Menambah kategori baru
- `POST /admin/settings/updateKategori/{id}` - Update kategori
- `DELETE /admin/settings/deleteKategori/{id}` - Hapus kategori

### Gelombang Pendaftaran
- `GET /admin/settings/getGelombang` - Mengambil semua data gelombang
- `POST /admin/settings/storeGelombang` - Menambah gelombang baru
- `POST /admin/settings/updateGelombang/{id}` - Update gelombang
- `DELETE /admin/settings/deleteGelombang/{id}` - Hapus gelombang

## Fitur Validasi

### Tahun Ajaran
- Nama harus diisi (3-100 karakter)
- Tahun mulai/selesai harus 4 digit
- Tahun selesai > tahun mulai
- Tidak boleh ada periode yang sama
- Hanya satu tahun ajaran yang bisa aktif

### Kategori
- Nama kategori harus unik (3-100 karakter)
- SPP harus angka non-negatif
- Catatan opsional (max 500 karakter)

### Gelombang Pendaftaran
- Nama gelombang harus diisi (3-100 karakter)
- Tanggal selesai > tanggal mulai
- Tidak boleh ada periode yang overlap

## Cara Penggunaan

### 1. Mengelola Tahun Ajaran
1. Klik tab "Tahun Ajaran"
2. Klik tombol "Tambah Tahun Ajaran"
3. Isi form dengan data yang valid
4. Klik "Simpan"

**Tips**: Nama tahun ajaran akan otomatis ter-generate saat mengisi tahun mulai dan selesai.

### 2. Mengaktifkan Tahun Ajaran
1. Pada card tahun ajaran, klik icon toggle
2. Konfirmasi aksi
3. Sistem akan otomatis menonaktifkan tahun ajaran lain

### 3. Mengelola Kategori
1. Klik tab "Kategori"
2. Tambah kategori baru dengan nama dan biaya SPP
3. Tambahkan catatan jika diperlukan

### 4. Mengelola Gelombang Pendaftaran
1. Klik tab "Gelombang Pendaftaran"
2. Tentukan periode pendaftaran yang tidak overlap
3. Sistem akan otomatis menampilkan status gelombang:
   - **Belum Dimulai**: Tanggal mulai masih di masa depan
   - **Sedang Berjalan**: Dalam periode aktif
   - **Selesai**: Melewati tanggal selesai

## Keamanan dan Error Handling

### Validasi Server-Side
- Semua input divalidasi di controller
- Constraint database dicek sebelum insert/update
- Error logging untuk debugging

### Validasi Client-Side
- Form validation sebelum submit
- User feedback melalui toast notifications
- Loading states untuk mencegah double submit

### Soft Delete
- Data yang dihapus tidak benar-benar dihilang dari database
- Memungkinkan recovery data jika diperlukan

## Troubleshooting

### Masalah Umum
1. **Data tidak muncul**: Cek console browser untuk error AJAX
2. **Form tidak bisa submit**: Pastikan validasi client-side terpenuhi
3. **Error 500**: Cek log aplikasi di writable/logs/

### Log Error
Error akan tercatat di file log dengan format:
```
ERROR - 2024-XX-XX --> Error storing tahun ajaran: [detail error]
```

## Pengembangan Lanjutan

### Fitur yang Bisa Ditambahkan
1. **Import/Export**: Import data dari Excel/CSV
2. **Bulk Operations**: Operasi massal untuk multiple records
3. **Audit Trail**: History perubahan data
4. **Advanced Filtering**: Filter dan pencarian data
5. **Report Generation**: Generate laporan pengaturan sistem

### Optimisasi Performance
1. **Pagination**: Untuk dataset yang besar
2. **Caching**: Cache data yang sering diakses
3. **Lazy Loading**: Load data sesuai kebutuhan

## Catatan Pengembang

File yang telah dibuat/diperbaiki:
- ✅ AdminSettings Controller - Validasi dan error handling
- ✅ Model improvements - UUID consistency dan validation
- ✅ View redesign - Bootstrap layout dengan UX yang lebih baik  
- ✅ JavaScript functionality - AJAX operations dan user feedback
- ✅ CSS styling - Custom styles untuk tampilan yang menarik

Semua perubahan telah mengikuti best practices CodeIgniter 4 dan standar keamanan web.
