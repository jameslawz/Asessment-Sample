@extends('layout.main')

@push('title')
  <title>Management Page</title>
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
  form .card {
    cursor: -webkit-grabbing; cursor: grabbing;
  }
</style>
@endpush

@section('content')
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>Management Page</h3>
      <a href="{{url('/')}}" class="btn btn-outline-dark btn-lg" tabindex="-1" role="button" aria-disabled="true">Home</a>
    </div>
    <form class="p-3 bg-light" method="POST" action="{{url('/store')}}" autocomplete="off">
      <div class="row tbl-edit p-2" data-dad-active="true" style="position: relative; user-select: none;">
        @if(!empty($data))
          @foreach($data as $k=>$v)
            <div class="col-md-3 col-6 px-1 my-1">
              <div class="card" style="@if(!empty($v->colour)){{'background-color:'.$v->colour.';'}}@endif">
                <div class="input-group my-3 mx-3">
                  <div class="col col-md-9">
                    <input type="text" class="form-control" name="title" value="{{$v->title}}">
                  </div>
                  <div class="col col-md-3">
                    <input type="color" class="form-control form-control-color" name="colour" value="{{$v->colour}}" title="Choose your color">
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <div id="alert" class="mt-3"></div>
    </form>
  </div>
@stop

@push('scripts')
<script>
$('.tbl-edit').dad();

function outputMessage(alertType, alertMsg) {
  $('#alert').append('<div class="alert '+ alertType +' alert-dismissible fade show" role="alert">'+ alertMsg +'</div>');
  $('#alert').children().fadeTo(2000, 500).slideUp(500, function(){
    $('#alert').children().slideUp(500);
  });
}

function submitPost(form, data) {
  $.ajax({
    type: 'POST',
    url: form.attr('action'),
    data: {
      _token: '{{csrf_token()}}',
      data: data,
    },
    beforeSend: function() {
      $('#alert').children().remove();
    },
    success: function(response, text) {
      if (response.status) {
        outputMessage('alert-success', response.message);
      } else {
        outputMessage('alert-warning', response.message);
      }
    },
    error: function(request, status, error) {
      outputMessage('alert-danger', response.message);
    }
  });
}

$(document).on("change" , ".card .form-control-color" , function(){
  $(this).parent().parent().parent().css('background-color', $(this).val());
});

$(document).ready(function() {
  $('form').on('submit', function(e){
    e.preventDefault();
    var postdata = [];
    $('.tbl-edit').children('div').each(function () {
      var title, colour = null;
      $(this).find(':input').each(function () {
        switch($(this).attr("name")) {
          case "title":
            title = $(this).val();
            break;
          case "colour":
            colour = $(this).val();
            break;
        }
      }); 
      if (title !== null && colour !== null) {
        postdata.push({'title':title,'colour':colour});
      }
    });
    return submitPost($('form'), postdata);
  });
});
</script>
@endpush
