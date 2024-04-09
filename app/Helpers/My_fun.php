<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

if (!function_exists('my_encrypt')) {
    function my_encrypt($value)
    {
        $encryption_key = '0SampaI1';
        $encryption_iv  = '09876543211234567890';

        $ciphering      = "AES-256-CBC";
        $options        = 0;
        $key            = hash('sha256', $encryption_key);
        $iv             = substr(hash('sha256', $encryption_iv), 0, 16);
        $encryption     = openssl_encrypt($value, $ciphering, $key, $options, $iv);
        return base64_encode($encryption);
    }
}

if (!function_exists('my_decrypt')) {
    function my_decrypt($encryption)
    {
        $encryption = base64_decode($encryption);

        $encryption_key = '0SampaI1';
        $encryption_iv  = '09876543211234567890';

        $ciphering      = "AES-256-CBC";
        $options        = 0;
        $key            = hash('sha256', $encryption_key);
        $iv             = substr(hash('sha256', $encryption_iv), 0, 16);
        $decryption     = openssl_decrypt($encryption, $ciphering, $key, $options, $iv);
        return $decryption;
    }
}

if (!function_exists('get_acak_id')) {
    function get_acak_id($table = NULL, $pk = NULL)
    {
        $id = 0;
        do {
            $id = rand();
        } while (!empty($table::where($pk, $id)->first()));
        return $id;
    }
}

if (!function_exists('get_kode_urut')) {
    function get_kode_urut($table, $key, $kd)
    {
        $result  = DB::select("SELECT MAX( SUBSTRING( $key,- 4)) AS kd FROM $table WHERE $key LIKE '%$kd%'");
        $kd_urut = $result[0]->kd;

        if ($kd_urut !== null) {
            $kode  = $kd_urut + 1;
            $add_k = str_pad($kode, 4, "0", STR_PAD_LEFT);
            return "{$kd}{$add_k}";
        } else {
            return "{$kd}0001";
        }
    }
}

if (!function_exists('remove_point_space')) {
    function remove_point_space($string)
    {
        return preg_replace('/\.|\s/', '', $string);
    }
}

if (!function_exists('generate_random_name_file')) {
    function generate_random_name_file($file)
    {
        return uniqid() . '-' . date('YmdHi') . '.' . $file->extension();
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tgl)
    {
        if ($tgl == "0000-00-00") {
            return "-";
        } else {
            $tanggal = substr($tgl, 8, 2);
            $bulan   = get_bulan(substr($tgl, 5, 2));
            $tahun   = substr($tgl, 0, 4);

            return $tanggal . ' ' . $bulan . ' ' . $tahun;
        }
    }
}

if (!function_exists('tgl_inggris')) {
    function tgl_inggris($tgl)
    {
        if ($tgl == "0000-00-00") {
            return "-";
        } else {
            $tanggal = substr($tgl, 8, 2);
            $bulan   = get_month(substr($tgl, 5, 2));
            $tahun   = substr($tgl, 0, 4);

            return $bulan . ' ' . $tanggal . ', ' . $tahun;
        }
    }
}

if (!function_exists('sql_date')) {
    function sql_date($date)
    {
        return date("Y-m-d", strtotime($date));
    }
}

if (!function_exists('sql_datetime')) {
    function sql_datetime($date)
    {
        return date("Y-m-d H:i:s", strtotime($date));
    }
}

if (!function_exists('get_bulan')) {
    function get_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}

if (!function_exists('get_month')) {
    function get_month($bln)
    {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Agu";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
}

if (!function_exists('penyebut')) {
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return "{$hasil} rupiah";
    }
}

if (!function_exists('huruf')) {
    function huruf($angka)
    {
        $angka = str_replace("1", " SATU", $angka);
        $angka = str_replace("2", " KEDUA", $angka);
        $angka = str_replace("3", " KETIGA", $angka);
        $angka = str_replace("4", " KEEMPAT", $angka);
        $angka = str_replace("5", " KELIMA", $angka);
        $angka = str_replace("6", " KEENAM", $angka);
        $angka = str_replace("7", " KETUJUH", $angka);
        $angka = str_replace("8", " KEDELAPAN", $angka);
        $angka = str_replace("9", " KESEMBILAN", $angka);
        $angka = str_replace("0", " NOL", $angka);
        $angka = str_replace(".", " koma", $angka);
        return $angka;
    }
}

if (!function_exists('get_waktu')) {
    function get_waktu($tgl)
    {
        return date("H : i : s", strtotime($tgl));
    }
}

if (!function_exists('random_color_part')) {
    function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('random_color')) {
    function random_color()
    {
        return random_color_part() . random_color_part() . random_color_part();
    }
}

if (!function_exists('random_number')) {
    function random_number()
    {
        return sprintf("%06d", mt_rand(1, 999999));
    }
}

if (!function_exists('rupiah')) {
    function rupiah($harga)
    {
        return 'Rp. ' . create_separator($harga) . ',-';
    }
}

if (!function_exists('remove_separator')) {
    function remove_separator($harga)
    {
        return str_replace('.', '', $harga);
    }
}

if (!function_exists('create_separator')) {
    function create_separator($harga)
    {
        return number_format($harga, 0, ',', '.');
    }
}

if (!function_exists('add_picture')) {
    function add_picture($request_img)
    {
        // nama
        $picture = generate_random_name_file($request_img);

        // upload
        $request_img->move(upload_path('picture'), $picture);

        return $picture;
    }
}

if (!function_exists('upd_picture')) {
    function upd_picture($request_img, $picture_name)
    {
        del_picture($picture_name);

        $picture = add_picture($request_img);

        return $picture;
    }
}

if (!function_exists('del_picture')) {
    function del_picture($picture_name)
    {
        $file_gambar = upload_path('picture/' . $picture_name);

        // hapus
        if (File::exists($file_gambar)) {
            File::delete($file_gambar);
        };
    }
}

if (!function_exists('count_array_index')) {
    function count_array_index($array, $index)
    {
        $sum = 0;
        foreach ($array as $row) {
            $count = count($row[$index]);
            $sum += ($count === 0 ? 1 : $count);
        }
        return $sum;
    }
}

if (!function_exists('sum_index')) {
    function sum_index($array, $index)
    {
        $sum = 0;
        foreach ($array as $row) {
            $sum += $row[$index];
        }
        return $sum;
    }
}

if (!function_exists('count_age')) {
    function count_age($date_of_birth)
    {
        $result = Carbon::parse($date_of_birth)->diff(Carbon::now())->y;
        return $result;
    }
}

if (!function_exists('count_mounth')) {
    function count_mounth($to, $from)
    {
        $result = Carbon::parse($to)->diffInMonths(Carbon::parse($from)) + 1;
        return $result;
    }
}

if (!function_exists('paginate')) {
    function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

if (!function_exists('read_more')) {
    function read_more($text)
    {
        return substr_replace($text, "...", 50);
    }
}

if (!function_exists('get_visitor_IP')) {
    function get_visitor_IP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        // Sometimes the `HTTP_CLIENT_IP` can be used by proxy servers
        $ip = @$_SERVER['HTTP_CLIENT_IP'];
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }

        // Sometimes the `HTTP_X_FORWARDED_FOR` can contain more than IPs 
        $forward_ips = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        if ($forward_ips) {
            $all_ips = explode(',', $forward_ips);

            foreach ($all_ips as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'];
    }
}

if (!function_exists('get_all_dates_in_month')) {
    function get_all_dates_in_month($year, $month)
    {
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dates = [];
        for ($i = 1; $i <= $days_in_month; $i++) {
            $dates[] = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i));
        }
        return $dates;
    }
}

if (!function_exists('get_all_months_in_year')) {
    function get_all_months_in_year($year)
    {
        return array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
    }
}
