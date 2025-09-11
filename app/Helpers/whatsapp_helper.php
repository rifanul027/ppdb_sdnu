<?php

if (!function_exists('formatPhoneNumber')) {
    /**
     * Format nomor telepon untuk WhatsApp
     */
    function formatPhoneNumber($phone)
    {
        // Bersihkan nomor telepon (hapus karakter non-digit)
        $cleanNumber = preg_replace('/\D/', '', $phone);
        
        // Tambahkan kode negara Indonesia jika belum ada
        if (substr($cleanNumber, 0, 1) === '0') {
            $cleanNumber = '62' . substr($cleanNumber, 1);
        } elseif (substr($cleanNumber, 0, 2) !== '62') {
            $cleanNumber = '62' . $cleanNumber;
        }
        
        return $cleanNumber;
    }
}

if (!function_exists('getWhatsAppUrl')) {
    /**
     * Generate URL WhatsApp dengan pesan
     */
    function getWhatsAppUrl($phone, $message = '')
    {
        $formattedPhone = formatPhoneNumber($phone);
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$formattedPhone}?text={$encodedMessage}";
    }
}

if (!function_exists('getValidationTemplate')) {
    /**
     * Template pesan untuk validasi data PPDB
     */
    function getValidationTemplate($namaLengkap, $noRegistrasi, $customMessage = '')
    {
        $template = "Assalamu'alaikum Wr. Wb.\n\n";
        $template .= "Halo {$namaLengkap},\n\n";
        $template .= "Saya dari Admin PPDB SD Nahdlatul Ulama. Terkait pendaftaran Anda dengan nomor registrasi: *{$noRegistrasi}*\n\n";
        
        if (!empty($customMessage)) {
            $template .= "{$customMessage}\n\n";
        } else {
            $template .= "Kami sedang melakukan proses validasi data pendaftaran. Mohon bantuannya untuk:\n\n";
            $template .= "1. Memastikan kelengkapan dokumen yang telah diupload\n";
            $template .= "2. Mengecek keakuratan data yang telah diisi\n";
            $template .= "3. Memverifikasi informasi kontak dan alamat\n\n";
            $template .= "Jika ada data yang perlu diperbaiki atau dokumen yang perlu dilengkapi, mohon segera lakukan perbaikan melalui akun pendaftaran Anda.\n\n";
        }
        
        $template .= "Terima kasih atas kerjasamanya.\n\n";
        $template .= "Wassalamu'alaikum Wr. Wb.\n\n";
        $template .= "*Admin PPDB SD Nahdlatul Ulama*";
        
        return $template;
    }
}

if (!function_exists('getAcceptanceTemplate')) {
    /**
     * Template pesan untuk penerimaan siswa
     */
    function getAcceptanceTemplate($namaLengkap, $noRegistrasi)
    {
        $template = "Assalamu'alaikum Wr. Wb.\n\n";
        $template .= "Selamat! {$namaLengkap}\n\n";
        $template .= "Kami dengan senang hati mengabarkan bahwa pendaftaran Anda dengan nomor registrasi *{$noRegistrasi}* telah *DITERIMA* di SD Nahdlatul Ulama.\n\n";
        $template .= "Selanjutnya, mohon untuk:\n";
        $template .= "1. Melakukan daftar ulang sesuai jadwal yang telah ditentukan\n";
        $template .= "2. Menyiapkan dokumen asli untuk verifikasi\n";
        $template .= "3. Mengikuti orientasi siswa baru\n\n";
        $template .= "Informasi lengkap akan kami sampaikan melalui pengumuman resmi.\n\n";
        $template .= "Terima kasih dan selamat bergabung di keluarga besar SD Nahdlatul Ulama!\n\n";
        $template .= "Wassalamu'alaikum Wr. Wb.\n\n";
        $template .= "*Admin PPDB SD Nahdlatul Ulama*";
        
        return $template;
    }
}

if (!function_exists('getRejectionTemplate')) {
    /**
     * Template pesan untuk penolakan siswa
     */
    function getRejectionTemplate($namaLengkap, $noRegistrasi, $reason = '')
    {
        $template = "Assalamu'alaikum Wr. Wb.\n\n";
        $template .= "Halo {$namaLengkap},\n\n";
        $template .= "Terima kasih atas minat Anda untuk mendaftar di SD Nahdlatul Ulama dengan nomor registrasi *{$noRegistrasi}*.\n\n";
        
        if (!empty($reason)) {
            $template .= "Setelah melalui proses seleksi, kami menyampaikan bahwa pendaftaran Anda belum dapat kami terima karena: {$reason}\n\n";
        } else {
            $template .= "Setelah melalui proses seleksi, kami menyampaikan bahwa kuota pendaftaran telah terpenuhi.\n\n";
        }
        
        $template .= "Kami mengapresiasi antusiasme Anda dan berharap dapat bekerjasama di kesempatan yang akan datang.\n\n";
        $template .= "Terima kasih atas pengertiannya.\n\n";
        $template .= "Wassalamu'alaikum Wr. Wb.\n\n";
        $template .= "*Admin PPDB SD Nahdlatul Ulama*";
        
        return $template;
    }
}

if (!function_exists('getFollowUpTemplate')) {
    /**
     * Template pesan untuk follow up dokumen
     */
    function getFollowUpTemplate($namaLengkap, $noRegistrasi, $dokumenKurang = [])
    {
        $template = "Assalamu'alaikum Wr. Wb.\n\n";
        $template .= "Halo {$namaLengkap},\n\n";
        $template .= "Terkait pendaftaran Anda dengan nomor registrasi: *{$noRegistrasi}*\n\n";
        $template .= "Kami telah melakukan pengecekan dan menemukan bahwa masih ada dokumen yang perlu dilengkapi:\n\n";
        
        if (!empty($dokumenKurang)) {
            foreach ($dokumenKurang as $index => $dokumen) {
                $template .= ($index + 1) . ". {$dokumen}\n";
            }
        } else {
            $template .= "• Dokumen yang perlu diperbaiki atau dilengkapi\n";
        }
        
        $template .= "\nMohon untuk segera melengkapi dokumen tersebut melalui akun pendaftaran Anda agar proses validasi dapat dilanjutkan.\n\n";
        $template .= "Batas waktu perbaikan: *3 hari* dari sekarang.\n\n";
        $template .= "Jika ada kendala, silakan hubungi kami kembali.\n\n";
        $template .= "Terima kasih atas kerjasamanya.\n\n";
        $template .= "Wassalamu'alaikum Wr. Wb.\n\n";
        $template .= "*Admin PPDB SD Nahdlatul Ulama*";
        
        return $template;
    }
}
