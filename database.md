# Database Rules & Guidelines

## 📋 Aturan Umum Database

### 1. **Naming Convention**
- **Table Names**: Gunakan `snake_case` dan bentuk plural
  ```sql
  ✅ users, students, tahun_ajaran, bukti_pembayaran, beasiswa
  ❌ User, student, TahunAjaran, buktiPembayaran, Beasiswa
  ```

- **Column Names**: Gunakan `snake_case`
  ```sql
  ✅ nama_lengkap, tanggal_lahir, created_at
  ❌ namaLengkap, tanggalLahir, createdAt
  ```

- **Foreign Key**: Gunakan format `{table_name}_id`
  ```sql
  ✅ student_id, tahun_ajaran_id, bukti_pembayaran_id, beasiswa_id
  ❌ studentId, tahunAjaranId, buktiPembayaranId, beasiswaId
  ```

### 2. **Primary Key**
- **WAJIB** menggunakan UUID (CHAR 36) untuk semua tabel
  ```php
  'id' => [
      'type'       => 'CHAR',
      'constraint' => 36,
      'null'       => false,
  ],
  ```

### 3. **Timestamps**
- **WAJIB** ada di setiap tabel:
  ```php
  'created_at' => ['type' => 'TIMESTAMP', 'null' => true],
  'updated_at' => ['type' => 'TIMESTAMP', 'null' => true],
  'deleted_at' => ['type' => 'TIMESTAMP', 'null' => true], // untuk soft delete
  ```

## 🔗 Foreign Key Rules

### 1. **Constraint Actions**
- **ON DELETE CASCADE**: Jika parent dihapus, child ikut terhapus
  ```php
  $this->forge->addForeignKey('tahun_ajaran_id', 'tahun_ajaran', 'id', 'CASCADE', 'CASCADE');
  ```

- **ON DELETE SET NULL**: Jika parent dihapus, foreign key jadi NULL
  ```php
  $this->forge->addForeignKey('student_id', 'students', 'id', 'CASCADE', 'SET NULL');
  ```

### 2. **Relasi yang Menggunakan CASCADE**
- `students.tahun_ajaran_id` → `tahun_ajaran.id`
- `students.bukti_pembayaran_id` → `pembayaran.id` (SET NULL)
- `students.beasiswa_id` → `beasiswa.id` (SET NULL)
- `users.student_id` → `students.id` (SET NULL)

## 📊 Model Rules

### 1. **Model Naming**
- File: `PascalCase` + `Model` suffix
- Class: Same as filename
  ```php
  // File: app/Models/StudentModel.php
  class StudentModel extends Model
  ```

### 2. **Model Properties**
```php
class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Karena pakai UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = true; // Untuk soft delete
    protected $protectFields = true;
    protected $allowedFields = [
        'no_registrasi', 'nis', 'nisn', 'nama_lengkap',
        'agama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'tahun_ajaran_id', 'bukti_pembayaran_id', 'beasiswa_id',
        // ... field lainnya
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        // ... rules lainnya
    ];
}
```

### 3. **UUID Generation**
```php
// Dalam model, override beforeInsert
protected function beforeInsert(array $data)
{
    if (!isset($data['data']['id'])) {
        $data['data']['id'] = service('uuid')->uuid4()->toString();
    }
    return $data;
}
```

## 🔍 Query Rules

### 1. **SELECT Queries**
```php
// ✅ Gunakan Query Builder
$students = $this->db->table('students')
    ->select('students.*, tahun_ajaran.nama as tahun_ajaran, beasiswa.nama as beasiswa')
    ->join('tahun_ajaran', 'students.tahun_ajaran_id = tahun_ajaran.id')
    ->join('beasiswa', 'students.beasiswa_id = beasiswa.id', 'left')
    ->where('students.status', 'siswa')
    ->get()->getResultArray();

// ❌ Hindari raw SQL kecuali benar-benar diperlukan
$students = $this->db->query("SELECT * FROM students WHERE status = 'siswa'")->getResultArray();
```

### 2. **INSERT/UPDATE**
```php
// ✅ Gunakan model untuk validasi otomatis
$studentModel = new StudentModel();
$studentModel->insert($data);

// ✅ Atau gunakan Query Builder dengan validation manual
$this->db->table('students')->insert($data);
```

### 3. **Soft Delete**
```php
// ✅ Gunakan model method
$studentModel->delete($id); // Soft delete

// ✅ Hard delete jika diperlukan
$studentModel->delete($id, true);
```

## 📝 Migration Rules

### 1. **File Naming**
```
YYYY-MM-DD-HHMMSS_DescriptiveName.php
2025-09-03-000001_CreateStudentsTable.php
```

### 2. **Migration Structure**
```php
class CreateStudentsTable extends Migration
{
    public function up()
    {
        // Definisi tabel
    }

    public function down()
    {
        $this->forge->dropTable('students');
    }
}
```

### 3. **Column Types**
- **UUID**: `CHAR(36)`
- **String**: `VARCHAR` dengan constraint yang sesuai
- **Text**: `TEXT` untuk content panjang
- **Boolean**: `BOOLEAN` dengan default value
- **Enum**: `ENUM` dengan constraint array
- **Timestamps**: `TIMESTAMP` nullable

## 🌱 Seeder Rules

### 1. **File Naming**
```
{TableName}Seeder.php
StudentsSeeder.php, UsersSeeder.php
```

### 2. **Seeder Structure**
```php
class StudentsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => service('uuid')->uuid4()->toString(),
                'nama_lengkap' => 'John Doe',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('students')->insertBatch($data);
    }
}
```

### 3. **Master Seeder**
```php
// DatabaseSeeder.php
public function run()
{
    // Urutan penting karena foreign key dependency
    $this->call('TahunAjaranSeeder');  // Parent table dulu
    $this->call('PembayaranSeeder');
    $this->call('BeasiswaSeeder');     // Parent table
    $this->call('StudentsSeeder');     // Child table setelahnya
    $this->call('UsersSeeder');
}
```

## 🔒 Security Rules

### 1. **Input Validation**
- **WAJIB** validasi semua input dari user
- Gunakan validation rules di model atau controller
- Escape output untuk mencegah XSS

### 2. **SQL Injection Prevention**
```php
// ✅ Gunakan binding parameter
$this->db->query("SELECT * FROM users WHERE email = ?", [$email]);

// ❌ Jangan concat string langsung
$this->db->query("SELECT * FROM users WHERE email = '$email'");
```

### 3. **Password Handling**
```php
// ✅ Hash password
'password' => password_hash($password, PASSWORD_DEFAULT)

// ✅ Verify password
password_verify($inputPassword, $hashedPassword)
```

## 📈 Performance Rules

### 1. **Indexing**
- Primary key otomatis punya index
- Tambah index untuk foreign key
- Tambah index untuk kolom yang sering di-query

### 2. **Query Optimization**
- Gunakan `select()` untuk limit kolom yang diambil
- Gunakan `limit()` untuk pagination
- Hindari N+1 query problem dengan `join` atau eager loading

### 3. **Caching**
```php
// Cache query result untuk data yang jarang berubah
$tahunAjaran = cache()->remember('tahun_ajaran_aktif', 3600, function() {
    return $this->tahunAjaranModel->where('is_active', true)->first();
});
```

## ⚠️ Yang Harus Dihindari

1. **Jangan** gunakan auto increment untuk primary key
2. **Jangan** hardcode UUID dalam kode
3. **Jangan** lupa foreign key constraint
4. **Jangan** gunakan raw SQL tanpa parameter binding
5. **Jangan** lupa validation
6. **Jangan** expose sensitive data dalam API response
7. **Jangan** query dalam loop (N+1 problem)

## 🧪 Testing

### 1. **Database Testing**
```php
// Setup test database
public function setUp(): void
{
    parent::setUp();
    $this->db = \Config\Database::connect('tests');
    $this->migrate();
}

// Clean up
public function tearDown(): void
{
    $this->db->close();
    parent::tearDown();
}
```

### 2. **Model Testing**
- Test validation rules
- Test relationships
- Test custom methods

---

## 📚 Resources

- [CodeIgniter 4 Database](https://codeigniter.com/user_guide/database/index.html)
- [CodeIgniter 4 Models](https://codeigniter.com/user_guide/models/model.html)
- [CodeIgniter 4 Migrations](https://codeigniter.com/user_guide/dbmgmt/migration.html)
- [CodeIgniter 4 Seeds](https://codeigniter.com/user_guide/dbmgmt/seeds.html)

---

**📝 Last Updated:** September 3, 2025  
**👨‍💻 Author:** Development Team  
**📋 Version:** 1.0
