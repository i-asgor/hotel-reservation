@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Dormitory Update</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <a href="{{route('dormitory')}}" class="btn btn-primary">All Dormitory</a>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('dormitory.update',$dormitories->id)}}" enctype="multipart/form-data">
                {{method_field('PUT')}}
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="dor_name" class="">{{ __('Dormitory Name') }}</label>
                            <input id="dor_name" type="text" class="form-control @error('dor_name') is-invalid @enderror" name="dor_name" value="{{ $dormitories->name }}" required autocomplete="dor_name" autofocus>
                            @error('dor_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="venu_condition">{{ __('Venu Condition') }}</label>
                            <select name="venu_condition" id="venu_condition" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Select Venu Condition</option>
                                @foreach($venu_conditions as $venu_condition)
                                  <option value="{{$venu_condition->id}}" {{(@$dormitories->venu_conditions->id == $venu_condition->id)?'selected':null}}>{{$venu_condition->venu_condition_name}}</option>
                                @endforeach
                            </select>
                            @error('venu_condition')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="dor_type">{{ __('Dormitory Type Name') }}</label>
                            <select name="dor_type" id="dor_type" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Select Dormitory Type</option>
                              @foreach($dormitory_types as $dormitory_type)
                                <option value="{{$dormitory_type->id}}" {{(@$dormitories->dormitory_types->id == $dormitory_type->id)?'selected':null}}>{{@$dormitory_type->dor_name}}</option>
                              @endforeach
                            </select>
                            @error('dor_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="dormitory_number" class="">{{ __('Dormitory Number') }}</label>
                            <input id="dormitory_number" min="1" step="1" type="number" class="form-control @error('dormitory_number') is-invalid @enderror" name="dormitory_number" value="{{ $dormitories->dor_number }}" required autocomplete="dormitory_number" autofocus placeholder="1">
                            @error('dormitory_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="dormitory_price" class="">{{ __('Dormitory Price') }}</label>
                            <input id="dormitory_price" min="1" step="1" type="number" class="form-control @error('dormitory_price') is-invalid @enderror" name="dormitory_price" value="{{ $dormitories->dor_price }}" required autocomplete="dormitory_price" autofocus placeholder="1">
                            @error('dormitory_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="dormitory_bed_count" class="">{{ __('Dormitory Bed Count') }}</label>
                            <input id="dormitory_bed_count"  min="1" step="1" type="number" class="form-control @error('dormitory_bed_count') is-invalid @enderror" name="dormitory_bed_count" value="{{ $dormitories->dor_bed_count }}" required autocomplete="dormitory_bed_count" autofocus placeholder="1">
                            @error('dormitory_bed_count')
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