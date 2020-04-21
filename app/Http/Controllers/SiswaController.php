<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
class SiswaController extends Controller
{
    public function index() {
        $halaman = 'siswa';
        $siswas = Siswa::all()->sortBy('nama_siswa');
        $jumlahsiswa = $siswas->count();
        return view('siswa.index',compact('halaman','siswas','jumlahsiswa'));
    }
    public function create ()
    {
        return view('siswa.create');
    }
    protected $request;
    public function __construct(Request $req)
    {
        $this->request = $req;
    }
    public function store()
    {
        $data = $this->request;
        $siswa = $data->all();
        return $siswa;

    }
}
