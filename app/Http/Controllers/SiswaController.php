<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use Validator;
class SiswaController extends Controller
{
    public function index() {
        $halaman = 'siswa';
        $siswas = Siswa::orderBy('nama_siswa','asc')->Paginate(10);
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

    // Siswa::create($request->all()); //Cara simpel banget
    //   return redirect('siswa');

    //dengan validator
    $input = $request->all();
    $validator = Validator::make($input,[
        'nisn'          => 'required|string|size:4|unique:siswa,nisn',
        'nama_siswa'    => 'required|string|max:30',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P'
    ]);
    if ($validator->fails()){
        return redirect('siswa/create')->withInput()->withErrors($validator);
    }
    Siswa::create($input);

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
        //tanpa Validator
        // $siswa = Siswa::FindOrFail($id);
        // $siswa->update($request->all());
        // return redirect('siswa');

        //Dengan Validator
        $siswa = Siswa::findorfail($id);
        $input = $request->all();
        $validator = Validator::make($input,[
            'nisn'          => 'required|string|size:4|unique:siswa,nisn,' . $request->input('id'),
            'nama_siswa'    => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P'
        ]);
        if ($validator->fails()){
            return redirect('siswa/'. $id . '/edit')->withInput()->withErrors($validator);
        }
        $siswa->update($request->all());

        return redirect('siswa');
    }
    public function destroy($id)
    {
        $siswa = Siswa::FindOrFail($id);
        $siswa->delete();
        return redirect('siswa');
    }
    //Isi Pembelajaran Eloquent:Collection
    //public function testCollection()
    //{
        //========================== Eloquent : Collection
        // $orang = ['rasmus lerdorf','taylor otwell','brendan eich','john resig'];
        // $collection = collect($orang)->map(function($nama){
        //     return ucwords($nama);
        // });
        //First
            //$collection = Siswa::all()->first();
        //Last
            //$collection = Siswa::all()->last();
        //Count
            //$collection = Siswa::all();
            //$jumlah = $collection->count();
        //Take
            //$collection = Siswa::all()->take(2);
        //Pluck
            //$collection = Siswa::all()->pluck('nama_siswa');
        //Where
            // $collection = Siswa::all();
            // $collection = $collection->where('nisn','1004');
        //WhereIn => Penyeleksian dengan range tertentu
            // $collection = Siswa::all();
            // $collection = $collection->whereIn('nisn',['1001','1003','1009']);
            // return $collection;
        //toArray => Agar data yang kita dapat menjadi array
            // $collection = Siswa::select('nisn','nama_siswa')->take(3)->get();
            // $koleksi = $collection->toarray();
            // foreach ($koleksi as $siswa) {
            //     echo $siswa['nisn'] . '-' . $siswa['nama_siswa'] . "<br>";
            // }
        //toJSON => membuat data membentuk JSON
            // $data = [
            //     ['nisn'=>'1001', 'nama_siswa'=>'Agus Yulianto2'],
            //     ['nisn'=>'1002', 'nama_siswa' => 'Bayu Firmansyah']
            // ];
    //}
    public function dateMutator()
    {
        //Data Created at / Updated_at akan otomatis diubah menjadi instance dari carbon
        // $siswa = Siswa::findOrFail(6);
        // dd($siswa->created_at);

        //Mengubah tanggal lahir menjadi instance carbon
        //$siswa = Siswa::findOrFail(2);
        //age=>salah satu getter dari carbon untuk mendapatkan umur dari suatu tanggal dengan tanggal saat ini
        //return "Umur {$siswa->nama_siswa} adalah {$siswa->tanggal_lahir->age} tahun";

        $siswa = Siswa::findorfail(1);
        $nama = $siswa->nama_siswa;
        $tanggal_lahir = $siswa->tanggal_lahir->format('d-m-Y');
        $ulang_tahun = $siswa->tanggal_lahir->addYears(30)->format('d-m-Y');
        return "Siswa {$nama} lahir pada {$tanggal_lahir}. <br> Ulang tahun ke 30 akan jatuh pada {$ulang_tahun}.";
    }
}
