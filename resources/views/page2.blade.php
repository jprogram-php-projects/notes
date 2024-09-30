@extends('layouts.main_layouts')

@section('content')
    <h1>Welcome View and Blade!</h1>
    <hr>
    <!-- <h3>The value is: <?= $value ?> </h3> -->
    <h3>Page 2</h3>
    <h3>The value is: {{ $value }} </h3>
@endsection