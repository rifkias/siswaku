<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RahasiaController extends Controller
{
    public function halamanRahasia(){
        return 'Anda Sedang melihat <strong>Halaman Rahasia.</strong>';
    }
    public function showMeSecret(){
        $url = route('secret');
        $link = '<a href="' . $url . '">Ke halaman Rahasia</a>';
        return $link;
        // return redirect()->route('secret');
    }
}
