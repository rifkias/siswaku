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
                <th>Kelas</th>
                <th>Tgl Lahir</th>
                <th>JK</th>
                <th>Telepon</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $list)
                <tr>
                <td>{{$list->nisn}}</td>
                <td>{{$list->nama_siswa}}</td>
                <td>{{$list->kelas->nama_kelas}}</td>
                <td>{{$list->tanggal_lahir->format('d-m-Y')}}</td>
                <td>{{$list->jenis_kelamin}}</td>
                <td>{{ !empty($list->telepon->nomor_telepon) ? $list->telepon->nomor_telepon : '-'}}</td>
                <td>
                    <div class="box-button">
                        <a href="siswa/{{$list->id}}" class="btn btn-success btn-sm">Detail</a>
                    </div>
                    <div class="box-button">
                        {!! link_to('siswa/'. $list->id . '/edit','Edit', ['class' => 'btn btn-success btn-sm']) !!}
                    </div>
                    <div class="box-button">
                        {!! Form::open(['method'=>'DELETE','action'=>['SiswaController@destroy',$list->id]]) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                </td>

                </tr>
            @endforeach
        </tbody>

      </table>
    @else
        <P>tidak ada data siswa</P>
    @endif
    <div class=" {{--table-bottom--}} table-nav">
        <div class="{{--pull-left--}} jumlah-data">
            <strong>jumlah siswa : {{$jumlahsiswa}}</strong>
        </div>
        <div class="{{--pull-right--}} paging">
            {{$siswas->links()}}
        </div>
    </div>

    <div class="{{--bottom-nav--}}tombol-nav">
        <div>
            <a href="siswa/create" class="btn btn-primary">Tambah Siswa</a>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('footer')
@endsection
