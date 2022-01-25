@extends('layout.main')

@push('title')
  <title>Home Page</title>
@endpush

@push('heads')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
  <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>  
  <script src="{{asset('js/jquery.dad.js')}}" type="text/javascript"></script>  
@endpush

@push('styles')
<style type="text/css">
  .gridly {
    position: relative;
    width: 960px;
  }
  .brick {
    width: 140px;
    height: 140px;
    border: 1px solid black;
  }
  form {
    border: 1px solid #dee2e6;
  }
  .card {
    height: 100%;
  }
</style>
@endpush

@section('content')
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h3>Home Page</h3>
      <a href="{{url('edit')}}" class="btn btn-outline-dark btn-lg" tabindex="-1" role="button" aria-disabled="true">Edit</a>
    </div>
    <div class="row tbl-edit p-2" data-dad-active="true" style="position: relative; user-select: none;">
      @foreach($data as $k=>$v)
        <div class="col-md-3 col-6 px-1 my-1">
          <div class="card" style="@if(!empty($v->colour)){{'background-color:'.$v->colour.';'}}@endif">
            <div class="my-3 mx-3 text-center">
              {{$v->title}}
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div id="alert" class="mt-3"></div>
  </div>
@stop
