@extends('template')

@section('main')
<div id="siswa">
    <h2>siswa</h2><hr>
    @if (!empty($siswas))
      <table class="table">
        <thead>
            <tr>
                <th>Nisn</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>JK</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $list)
                <tr>
                <td>{{$list->nisn}}</td>
                <td>{{$list->nama_siswa}}</td>
                <td>{{$list->tanggal_lahir}}</td>
                <td>{{$list->jenis_kelamin}}</td>
                <td><a href="siswa/{{$list->id}}" class="btn btn-success btn-sm">Detail</a></td>
                </tr>
            @endforeach
        </tbody>

      </table>
    @else
        <P>tidak ada data siswa</P>
    @endif
    <div class="table-bottom">
        <div class="pull-left">
        <strong>jumlah siswa : {{$jumlahsiswa}}</strong>
        </div>
        <div class="pull-right">
            pagination
        </div>
    </div>

    <div class="bottom-nav">
        <div>
            <a href="siswa/create" class="btn btn-primary">Tambah Siswa</a>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('footer')
@endsection
