# URL Rewriting Fix for CodeIgniter 4

## Problem
URL masih menampilkan index.php: `http://ppdbsdnu.test/index.php/admin/dashboard`

## Solutions

### 1. Untuk Apache (XAMPP/WAMP/LAMP)

#### A. Update konfigurasi App.php (✅ SUDAH DILAKUKAN)
```php
// app/Config/App.php
public string $indexPage = '';  // Kosongkan
public string $baseURL = 'http://ppdbsdnu.test/';
```

#### B. Pastikan mod_rewrite aktif di Apache
```apache
# Di httpd.conf, pastikan line ini tidak dicomment:
LoadModule rewrite_module modules/mod_rewrite.so
```

#### C. Virtual Host Configuration
```apache
# Tambahkan ke httpd-vhosts.conf
<VirtualHost *:80>
    ServerName ppdbsdnu.test
    DocumentRoot "C:/project/ppdbsdnu/public"
    
    <Directory "C:/project/ppdbsdnu/public">
        AllowOverride All
        Require all granted
        DirectoryIndex index.php
    </Directory>
</VirtualHost>
```

#### D. Update hosts file
```
# C:\Windows\System32\drivers\etc\hosts (Windows)
# /etc/hosts (Linux/Mac)
127.0.0.1 ppdbsdnu.test
```

### 2. Untuk Nginx

```nginx
server {
    listen 80;
    server_name ppdbsdnu.test;
    root C:/project/ppdbsdnu/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 3. Untuk Development Server (Temporary Fix)

Jika menggunakan built-in PHP server:
```bash
# Jalankan dari folder public
cd public
php -S ppdbsdnu.test:8080

# Atau dari root dengan router
php -S ppdbsdnu.test:8080 -t public public/index.php
```

### 4. Alternative .htaccess (jika masih bermasalah)

```apache
# public/.htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L,QSA]
```

### 5. Environment Variables

Pastikan file .env benar:
```env
CI_ENVIRONMENT = development
app.baseURL = 'http://ppdbsdnu.test/'
```

## Testing

1. Restart web server setelah konfigurasi
2. Clear browser cache
3. Test URL: http://ppdbsdnu.test/admin/dashboard (tanpa index.php)

## Troubleshooting

1. **Masih muncul index.php?**
   - Pastikan mod_rewrite aktif
   - Cek AllowOverride All di virtual host
   - Cek .htaccess readable

2. **404 Not Found?**
   - Pastikan DocumentRoot menuju ke folder public
   - Cek file index.php ada di public folder

3. **Permission denied?**
   - Cek permission folder public
   - Pastikan user web server bisa akses folder
