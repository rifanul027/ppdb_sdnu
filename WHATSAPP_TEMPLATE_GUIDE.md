# Template Chat WhatsApp PPDB SD Nahdlatul Ulama

Dokumen ini berisi template chat WhatsApp yang tersedia untuk komunikasi dengan calon siswa dalam proses PPDB.

## Fitur Hubungi Pendaftar

Di halaman detail pendaftar (`/admin/pendaftar/detail/{id}`), tersedia button **"Hubungi Pendaftar"** dengan dropdown menu yang berisi berbagai template chat:

### 1. Validasi Data
Template untuk meminta calon siswa melakukan pengecekan data dan dokumen:

```
Assalamu'alaikum Wr. Wb.

Halo [Nama Lengkap],

Saya dari Admin PPDB SD Nahdlatul Ulama. Terkait pendaftaran Anda dengan nomor registrasi: *[No Registrasi]*

Kami sedang melakukan proses validasi data pendaftaran. Mohon bantuannya untuk:

1. Memastikan kelengkapan dokumen yang telah diupload
2. Mengecek keakuratan data yang telah diisi
3. Memverifikasi informasi kontak dan alamat

Jika ada data yang perlu diperbaiki atau dokumen yang perlu dilengkapi, mohon segera lakukan perbaikan melalui akun pendaftaran Anda.

Terima kasih atas kerjasamanya.

Wassalamu'alaikum Wr. Wb.

*Admin PPDB SD Nahdlatul Ulama*
```

### 2. Follow Up Dokumen
Template untuk memberitahu dokumen yang masih kurang atau perlu diperbaiki:

```
Assalamu'alaikum Wr. Wb.

Halo [Nama Lengkap],

Terkait pendaftaran Anda dengan nomor registrasi: *[No Registrasi]*

Kami telah melakukan pengecekan dan menemukan bahwa masih ada dokumen yang perlu dilengkapi:

• Dokumen yang perlu diperbaiki atau dilengkapi

Mohon untuk segera melengkapi dokumen tersebut melalui akun pendaftaran Anda agar proses validasi dapat dilanjutkan.

Batas waktu perbaikan: *3 hari* dari sekarang.

Jika ada kendala, silakan hubungi kami kembali.

Terima kasih atas kerjasamanya.

Wassalamu'alaikum Wr. Wb.

*Admin PPDB SD Nahdlatul Ulama*
```

### 3. Pemberitahuan Diterima
Template untuk memberitahu bahwa calon siswa diterima:

```
Assalamu'alaikum Wr. Wb.

Selamat! [Nama Lengkap]

Kami dengan senang hati mengabarkan bahwa pendaftaran Anda dengan nomor registrasi *[No Registrasi]* telah *DITERIMA* di SD Nahdlatul Ulama.

Selanjutnya, mohon untuk:
1. Melakukan daftar ulang sesuai jadwal yang telah ditentukan
2. Menyiapkan dokumen asli untuk verifikasi
3. Mengikuti orientasi siswa baru

Informasi lengkap akan kami sampaikan melalui pengumuman resmi.

Terima kasih dan selamat bergabung di keluarga besar SD Nahdlatul Ulama!

Wassalamu'alaikum Wr. Wb.

*Admin PPDB SD Nahdlatul Ulama*
```

### 4. Chat Langsung
Opsi untuk membuka WhatsApp langsung tanpa template pesan.

## Penggunaan

1. Buka halaman detail pendaftar
2. Pastikan pendaftar memiliki nomor telepon
3. Klik dropdown button "Hubungi Pendaftar"
4. Pilih template yang sesuai
5. WhatsApp akan terbuka dengan pesan yang sudah disiapkan
6. Admin dapat mengedit pesan sebelum mengirim jika diperlukan

## Fitur Teknis

- **Otomatis format nomor telepon**: Sistem akan otomatis menambahkan kode negara Indonesia (+62)
- **Template dinamis**: Nama, nomor registrasi, dan data lain akan otomatis diisi
- **Responsive design**: Dropdown dapat bekerja dengan baik di desktop dan mobile
- **Helper functions**: Tersedia helper PHP untuk template custom

## Helper Functions

Beberapa helper yang tersedia di `app/Helpers/whatsapp_helper.php`:

- `formatPhoneNumber($phone)` - Format nomor telepon untuk WhatsApp
- `getWhatsAppUrl($phone, $message)` - Generate URL WhatsApp dengan pesan
- `getValidationTemplate($nama, $noReg, $customMessage)` - Template validasi
- `getAcceptanceTemplate($nama, $noReg)` - Template penerimaan
- `getRejectionTemplate($nama, $noReg, $reason)` - Template penolakan
- `getFollowUpTemplate($nama, $noReg, $dokumenKurang)` - Template follow up

## Kustomisasi

Untuk menambah template baru atau memodifikasi yang ada:

1. Edit file `app/Views/admin/pendaftar/pendaftar_detail.php`
2. Tambahkan item dropdown baru
3. Buat fungsi JavaScript baru untuk template
4. Atau gunakan helper PHP untuk template yang lebih kompleks

## Troubleshooting

### Dropdown tidak berfungsi
- Pastikan Bootstrap 4 sudah ter-load
- Periksa console browser untuk error JavaScript

### WhatsApp tidak terbuka
- Pastikan nomor telepon valid
- Periksa browser settings untuk popup/redirect

### Template tidak sesuai
- Edit template di JavaScript function atau helper PHP
- Gunakan encode URL yang sesuai untuk karakter khusus

## Keamanan

- Semua data di-escape untuk mencegah XSS
- Nomor telepon hanya diformat, tidak disimpan
- Template menggunakan data yang sudah tervalidasi dari database
