@extends('template')

@section('main')
<div id="siswa">
    <h2>Tambah Siswa</h2>
{{-- cara 1 --}}
    {{-- <div id="siswa">

    <form action="{{url('siswa')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="nisn" class="control-label">NISN</label>
        <input type="text" name="nisn" id="nisn" class="form-control">
    </div>

    <div class="form-group">
        <label for="nama_siswa" class="control-label">Nama</label>
        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control">
    </div>

    <div class="form-group">
        <label for="tanggal_lahir" class="control-label">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
    </div>

    <div class="form-group">
        <label for="jenis_kelamin" class="control-label">Jenis Kelamin :</label>
        <div class="radio">
            <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L">Laki-Laki</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P">Perempuan</label>
        </div>
    </div>

        <div class="form-group">
        <input type="submit" value="Simpan" class="btn btn-primary form-control">
    </div>
    </form>
    </div> --}}
{{-- Cara 2 --}}

        {{-- {!! Form::open(['url'=>'siswa']) !!}
    @csrf
    <div class="form-group">
        {!!  Form::label('nisn', 'NISN:', ['class'=>'control-label']) !!}
        {!! Form::text('nisn', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('nama_siswa', 'Nama Siswa:', ['class'=> 'control-label']) !!}
        {!! Form::text('nama_siswa',null,['class'=>'form-control','id'=>'tanggal_lahir']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tanggal_lahir', 'Tanggal Lahir:', ['class'=> 'control-label']) !!}
        {!! Form::date('tanggal_lahir',null, ['class'=>'form-control','id'=>'tanggal_lahir']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'control-label']) !!}
        <div class="radio">
            <label>{!! Form::radio('jenis_kelamin', 'L') !!}Laki - Laki</label>
        </div>
        <div class="radio">
            <label>{!! Form::radio('jenis_kelamin', 'P') !!}Perempuan</label>
        </div>
    </div>
    <div class="form-group">
        {!! Form::submit('Tambah Siswa', ['class'=>'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!} --}}

    {{-- Cara Simpel --}}

    {!! Form::open(['url'=>'siswa']) !!}
    @csrf
    @include('siswa.form',['submitbuttontext'=>'Simpan'])
    {!! Form::close() !!}
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
