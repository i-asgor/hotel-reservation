@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Seat Update</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                {{-- <a href="{{ route('seats.create', $room->id) }}" class="btn btn-primary">All Seat</a> --}}
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('seats.update',$seats->id)}}" enctype="multipart/form-data">
                {{method_field('PUT')}}
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="">{{ __('Seat Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $seats->name }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="">{{ __('Seats Description') }}</label>
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $seats->description }}" required autocomplete="description" autofocus placeholder="1">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="price" class="">{{ __('Seat Price') }}</label>
                            <input id="price" min="1" step="1" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $seats->price }}" required autocomplete="price" autofocus placeholder="1">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>                                
                        
                    </div>                    
                </div>
        
        
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Updated') }}
                        </button>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    
</div>
@endsection

@section('javascript')

<script>
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    function validatePassword() {
        if (password.value != confirm_password.value) {
            $('#error_confirm_password').show();
            $('#error_confirm_password strong').html('Passsword don\'t match');
        } else if (password.value == '' || password.value == undefined || password.value == null) {
            //password.setCustomValidity("Passwords must not be empty");
            $('#error_confirm_password').show();
            $('#error_confirm_password strong').html('Passwords must not be empty');
        } else {
            $('#error_confirm_password').hide();
            $('#error_confirm_password strong').html('');
        }
    }
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();
    $('#imageupload-disable').on('click', function() {
        $imageupload.imageupload('disable');
        $(this).blur();
    })
    $('#imageupload-enable').on('click', function() {
        $imageupload.imageupload('enable');
        $(this).blur();
    })
    $('#imageupload-reset').on('click', function() {
        $imageupload.imageupload('reset');
        $(this).blur();
    });
</script>
@endsection