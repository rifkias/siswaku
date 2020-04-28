<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Telepon;
use Validator;
class SiswaController extends Controller
{
    public function index() {
        $halaman = 'siswa';
        $siswas = Siswa::orderBy('nama_siswa','asc')->Paginate(10);
        $jumlahsiswa = Siswa::all()->count();
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
        'jenis_kelamin' => 'required|in:L,P',
        'nomor_telepon' => 'sometimes|numeric|nullable|digits_between:10,15|unique:telepon,nomor_telepon',
    ]);
    if ($validator->fails()){
        return redirect('siswa/create')->withInput()->withErrors($validator);
    }

    $siswa = Siswa::create($input);
    if ($request->filled('nomor_telepon')) {
        $telepon = new Telepon;
        $telepon->nomor_telepon = $request->input('nomor_telepon');
        $siswa->telepon()->save($telepon);
    }
    // $telepon = new Telepon();
    // $telepon->nomor_telepon = $request->input('nomor_telepon');
    // $siswa->telepon()->save($telepon);

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
        if (!empty($siswa->telepon->nomor_telepon)) {
            $siswa->nomor_telepon = $siswa->telepon->nomor_telepon;
        }
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
            'jenis_kelamin' => 'required|in:L,P',
            'nomor_telepon' => 'sometimes|numeric|nullable|digits_between:10,15|unique:telepon,nomor_telepon,'. $request->input('id').',id_siswa' ,
        ]);
        if ($validator->fails()){
            return redirect('siswa/'. $id . '/edit')->withInput()->withErrors($validator);
        }
        $siswa->update($request->all());

        //Update nomor telepon jika sudah ada di database
        if ($siswa->telepon) {
            //Jika telepon diisi, Update
            if ($request->filled('nomor_telepon')) {
                $telepon = $siswa->telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $siswa->telepon()->save($telepon);
            } else { # jika telepon tidak diisi, hapus
                $siswa->telepon()->delete();
            }

        } else { //Buat entry baru jika sebelumnya tidak ada telepon
            if ($request->filled('nomor_telepon')) {
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $siswa->telepon()->save($telepon);
            }
        }

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
