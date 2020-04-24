@if ($errors->any())
    {{-- <ul  class="alert alert-danger">
        @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
        @endforeach
    </ul> --}}
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{$error}}
      </div>
    @endforeach
@endif
