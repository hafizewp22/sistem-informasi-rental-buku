@extends('layouts.mainlayout')

@section('title', 'Profile')

@section('content')
    <h1>Your Rent Log</h1>

    <div class="mt-5">

        <x-rent-log-table :rentlog='$rentLogs' />
    </div>
@endsection
