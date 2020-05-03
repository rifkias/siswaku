<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [
        'nisn','nama_siswa','tanggal_lahir','jenis_kelamin','id_kelas'
    ];
    //Mengkonversi kolom tanggal_lahir menjadi instance dari Carbon => menambahkan kolom di variabel dates
    protected $dates = ['tanggal_lahir'];
    //Accessor
    public function getNamaSiswaAttribute($nama_siswa)
    {
       return ucwords($nama_siswa);
    }
    //Mutator
    public function setNamaSiswaAttribute($nama_siswa)
    {
        //cara buku
        //Setelah dicoba" sering terjadi masalah makanya yang dipake yang bawaan laravel :) sialan ni buku mana kaga bisa nanya lagi
        //return strtolower($nama_siswa);
        //Cara laravel
        $this->attributes['nama_siswa'] = strtolower($nama_siswa);
    }
    public function telepon()
    {
        return $this->hasOne('App\Telepon','id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas','id_kelas');
    }
}
