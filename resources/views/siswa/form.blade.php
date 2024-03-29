   {{-- Agar nisn tidak harus diganti ketika proses update --}}
   @if (isset($siswa))
       {!! Form::hidden('id', $siswa->id) !!}
   @endif

   @if ($errors->any())
        <div class="form-group {{$errors->has('nisn') ? 'has-error' : 'has-success'}}">
    @else
        <div class="form-group">
    @endif
    {!!  Form::label('nisn', 'NISN:', ['class'=>'control-label']) !!}
    {!! Form::text('nisn', null, ['class'=>'form-control']) !!}
    @if ($errors->has('nisn'))
    <span class="help-block">{{$errors->first('nisn')}}</span>
    @endif
</div>

    @if ($errors->any())
        <div class="form-group {{$errors->has('nama_siswa') ? 'has-error' : 'has-success'}}">
    @else
        <div class="form-group">
    @endif
    {!! Form::label('nama_siswa', 'Nama Siswa:', ['class'=> 'control-label']) !!}
    {!! Form::text('nama_siswa',null,['class'=>'form-control','id'=>'tanggal_lahir']) !!}
    @if ($errors->has('nama_siswa'))
    <span class="help-block">{{$errors->first('nama_siswa')}}</span>
    @endif
</div>
    @if ($errors->any())
        <div class="form-group {{$errors->has('tanggal_lahir') ? 'has-error' : 'has-success'}}">
    @else
        <div class="form-group">
    @endif
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:', ['class'=> 'control-label']) !!}
    {{-- {!! Form::date('tanggal_lahir',null, ['class'=>'form-control','id'=>'tanggal_lahir']) !!} --}}
    {{-- Tambahannya dikarenakan tanggal lahir sudah termasuk ke dalam instance dari carbon,karena inout date hanya menerima data tanggal dengan format Y-m-d sedang kan format carbon tidak seperti itu  --}}

    {{-- alur proses => jika data siswa tidak kosong maka tanggal lahir dari data base diformat Y-m-d agar dapat dikenali oleh input date ,tetapi jika kosong berikan nilai null untuk tanggal lahir agar tidak muncul error ketika sedang proses insert data--}}
    {!! Form::date('tanggal_lahir',!empty($siswa) ? $siswa->tanggal_lahir->format('Y-m-d'):null ,['class'=>'form-control','id'=>'tanggal_lahir']) !!}
    @if ($errors->has('tanggal_lahir'))
    <span class="help-block">{{$errors->first('tanggal_lahir')}}</span>
    @endif
</div>
    @if ($errors->any())
        <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : 'has-success'}}">
    @else
        <div class="form-group">
    @endif
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'control-label']) !!}
    <div class="radio">
        <label>{!! Form::radio('jenis_kelamin', 'L') !!}Laki - Laki</label>
    </div>
    <div class="radio">
        <label>{!! Form::radio('jenis_kelamin', 'P') !!}Perempuan</label>
    </div>
    @if ($errors->has('jenis_kelamin'))
    <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
    @endif
</div>
    @if ($errors->any())
        <div class="form-group {{$errors->has('nomor_telepon') ? 'has-error' : 'has-success'}}">
    @else
        <div class="form-group">
    @endif
        {!! Form::label('nomor_telepon', 'Telepon :', ['class' =>'control-label']) !!}
        {!! Form::number('nomor_telepon', null, ['class'=>'form-control']) !!}
        @if ($errors->has('nomor_telepon'))
        <span class="help-block">{{$errors->first('nomor_telepon')}}</span>
        @endif
</div>
    @if ($errors->any())
        <div class="form-group {{$errors->has('id_kelas') ? 'has-error' : 'has-success'}}">
    @else
        <div class="form-group">
    @endif
        {!! Form::label('id_kelas', 'Kelas :', ['class' =>'control-label']) !!}
        @if (count($list_kelas) > 0)
        {!! Form::select('id_kelas', $list_kelas, null , ['class'=>'form-control','id' => 'id_kelas','placeholder'=> 'Pilih kelas']) !!}
        @else
            <p>Tidak ada pilihan kelas, buat dulu ya </p>
        @endif

        @if ($errors->has('id_kelas'))
        <span class="help-block">{{$errors->first('id_kelas')}}</span>
        @endif
</div>
<div class="form-group">
    {!! Form::submit($submitbuttontext, ['class'=>'btn btn-primary form-control']) !!}
</div>
