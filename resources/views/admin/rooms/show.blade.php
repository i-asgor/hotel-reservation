@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Display available rooms -->
        <div id="calendar"></div>



    </div>
@endsection
@section('javascript')
<script src="{{ asset('admin_assets/js/calendar.js') }}"></script>
@endsection
