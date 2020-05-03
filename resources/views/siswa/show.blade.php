@extends('template')

@section('main')
    <div id='siswa'>
        <h2>Detail Siswa</h2>
        <table class="table table-striped">
            <tr>
                <th>Nisn</th>
            <td>{{$siswa->nisn}}</td>
            </tr>

            <tr>
                <th>Nama</th>
            <td>{{$siswa->nama_siswa}}</td>
            </tr>

            <tr>
                <th>Kelas</th>
            <td>{{$siswa->kelas->nama_kelas}}</td>
            </tr>

            <tr>
                <th>Tanggal  Lahir</th>
            <td>{{$siswa->tanggal_lahir->format('d-m-Y')}}</td>
            </tr>

            <tr>
                <th>Jenis Kelamin</th>
                {{-- @if ($siswa->jenis_kelamin == "P")
                    <td>Perempuan</td>
                @else
                    <td>Laki Laki</td>
                @endif --}}
            <td>{{$siswa->jenis_kelamin}}</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>{{!empty($siswa->telepon->nomor_telepon) ? $siswa->telepon->nomor_telepon : '-'}}</td>
            </tr>
        </table>
    </div>
@endsection
@section('footer')
    @include('footer')
@endsection

