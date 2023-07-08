<?php

namespace App\Helpers;

// namespace App\Http\Helpers\Helper;


class Helpers
{
    public static function penjumlahan($angka_1, $angka_2)
    {
        $hasil = $angka_1 + $angka_2;
        return $hasil;
    }

    public static function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        echo $hasil_rupiah;
    }

    public static function Create_Qrcode($string)
    {
        // $string = "Hello world";
        $google_chart_api_url = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . $string . "&choe=UTF-8";
        // $data = $url . $string . "&choe=UTF-8";
        echo "<img src='" . $google_chart_api_url . "' alt='" . $string . "'>";
        // return $google_chart_api_url;
    }
}
