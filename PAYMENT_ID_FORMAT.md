# Format ID Pembayaran

## Perubahan Format ID

ID pembayaran telah diubah dari format UUID menjadi format sekuensial berdasarkan tanggal untuk memudahkan pengurutan dan tracking.

### Format Baru
```
PAY{YYYYMMDD}{NNNN}
```

**Keterangan:**
- `PAY` = Prefix untuk identifikasi pembayaran
- `YYYYMMDD` = Tanggal pembayaran dibuat (8 digit)
- `NNNN` = Nomor urut 4 digit dengan leading zero (0001, 0002, dst)

### Contoh ID
- Pembayaran pertama pada 12 September 2025: `PAY202509120001`
- Pembayaran kedua pada 12 September 2025: `PAY202509120002`
- Pembayaran pertama pada 13 September 2025: `PAY202509130001`

### Keuntungan Format Baru
1. **Pengurutan yang mudah**: ID otomatis terurut berdasarkan tanggal dan waktu input
2. **Mudah dibaca**: Format yang dapat dipahami manusia
3. **Tracking harian**: Mudah melihat berapa pembayaran per hari
4. **Konsistensi panjang**: Semua ID memiliki panjang yang sama (15 karakter)

### Perubahan Database
- Tipe data `id` diubah dari `CHAR(36)` menjadi `VARCHAR(15)`
- Migration: `2025-09-12-000001_ModifyPembayaranIdFormat.php`

### Perubahan Kode

#### 1. PembayaranModel.php
- Metode `generatePaymentId()` ditambahkan
- Dependency pada `uuid_helper` dihapus dari metode `createPayment()`

#### 2. AdminDaftarUlang.php
- Pengurutan diubah dari `s.created_at DESC` menjadi `p.id ASC`
- Siswa dengan pembayaran paling awal akan tampil di urutan teratas
- Siswa tanpa pembayaran akan tampil di bagian bawah

### Cara Kerja
1. Sistem mengecek pembayaran terakhir untuk hari ini
2. Mengambil nomor urut terakhir dan menambahkan 1
3. Format nomor urut dengan 4 digit (leading zero)
4. Gabungkan prefix, tanggal, dan nomor urut

### Implementasi Pengurutan
Di halaman **Admin Daftar Ulang**, data siswa sekarang diurutkan berdasarkan:
1. Siswa dengan pembayaran ditampilkan dulu (diurutkan berdasarkan ID pembayaran ascending)
2. Siswa tanpa pembayaran ditampilkan terakhir (diurutkan berdasarkan nama)

**Implementasi:**
```php
// Sorting dilakukan di PHP untuk menghindari masalah SQL syntax
usort($rawData, function($a, $b) {
    // Jika keduanya punya pembayaran, urutkan berdasarkan payment ID
    if ($a['bukti_pembayaran_id'] && $b['bukti_pembayaran_id']) {
        return strcmp($a['bukti_pembayaran_id'], $b['bukti_pembayaran_id']);
    }
    // Jika hanya satu yang punya pembayaran, yang ada pembayaran dulu
    if ($a['bukti_pembayaran_id'] && !$b['bukti_pembayaran_id']) {
        return -1;
    }
    if (!$a['bukti_pembayaran_id'] && $b['bukti_pembayaran_id']) {
        return 1;
    }
    // Jika keduanya tidak punya pembayaran, urutkan berdasarkan nama
    return strcmp($a['nama_lengkap'], $b['nama_lengkap']);
});
```

**Keuntungan Pendekatan PHP:**
- ✅ Menghindari masalah kompatibilitas SQL syntax antar versi MySQL
- ✅ Lebih fleksibel untuk logika sorting yang kompleks  
- ✅ Mudah di-debug dan dimodifikasi
- ✅ Tidak mempengaruhi performa karena data sudah di-filter di database
