<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function cookieSuccess($kondisi)
    {
        setcookie('pesan', 'Data Berhasil di ' . $kondisi . '!', time() + (3), '/');
        setcookie('warna', 'alert-success', time() + (3), '/');
    }
}
