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
        $halaman = "siswa";
        return view('siswa.create',compact('halaman'));
    }
    protected $request;
    public function __construct(Request $req)
    {
        $this->request = $req;
    }
    public function store(Request $request)
    {
    //   $siswa = new Siswa;
    //   $siswa->nisn              = $request->nisn;
    //   $siswa->nama_siswa        = $request->nama_siswa;      //Cara ribet panjang bener
    //   $siswa->tanggal_lahir     = $request->tanggal_lahir;
    //   $siswa->jenis_kelamin     = $request->jenis_kelamin;
    //   $siswa->save();

    // $input = $request->all();
    // Siswa::create($input);       //Cara 2 lumayan simpel

    Siswa::create($request->all()); //Cara simpel banget
      return redirect('siswa');
    }
    public function show($id)
    {
        $halaman = 'siswa';
        $siswa = siswa::findorfail($id);
        return view('siswa.show',compact('halaman','siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::findorfail($id);
        return view('siswa.edit',compact('siswa'));
    }

    public function update($id, Request $request)
    {
        $siswa = Siswa::FindOrFail($id);
        $siswa->update($request->all());
        return redirect('siswa');
    }
}
