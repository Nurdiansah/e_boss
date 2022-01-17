<?php


function enkripRambo($data)
{

    return $data = base64_encode(base64_encode(base64_encode($data)));
}

function dekripRambo($data)
{
    return $data = base64_decode(base64_decode(base64_decode($data)));
}

function tanggal($tanggal)
{
    $formatTanggal = date("d F Y", strtotime($tanggal));

    return $formatTanggal;
}

function tanggalHari($tanggal)
{
    $hari = date("D", strtotime($tanggal));
    $hari = getHari($hari);

    $formatTanggal = $hari . ', ' . date("d/m/Y", strtotime($tanggal));

    return $formatTanggal;
}

function tanggalWaktu($tanggal)
{
    $formatTanggal = date("d F Y H:i", strtotime($tanggal));

    return $formatTanggal;
}

function datetimeLocal($tanggal)
{
    $date = date("Y-m-d", strtotime($tanggal));
    $time = date("H:i", strtotime($tanggal));
    $formatTanggal = $date . 'T' . $time;

    return $formatTanggal;
}

function getHari($hari)
{

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return  $hari_ini;
}

function cookieSuccess($kondisi)
{
    setcookie('message', $kondisi, time() + (3), '/');
    setcookie('status', 'success', time() + (3), '/');
}

function apiLokal()
{
    $srv = $_SERVER['SERVER_NAME'];
    $port = ":" .  $_SERVER['SERVER_PORT'];

    $api = 'http://' . $srv .  $port . '/api/';

    return $api;
}
