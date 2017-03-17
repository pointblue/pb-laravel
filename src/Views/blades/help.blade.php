@extends('layouts.main')

@section('subtitle', 'Help')

@section('content')
    <main class="container">
        <div >
            <h1>Help For {{env('PB_APP_NAME')}}</h1>
            <p>For assistance, please email datasolutions@pointblue.org</p>
        </div>
    </main>
@endsection