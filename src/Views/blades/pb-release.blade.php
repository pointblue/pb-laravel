@extends('layouts.main')

@section('subtitle', 'Release Notes')

@section('content')
    <main class="container">
        <div >
            <h1>Release Notes For {{env('PB_APP_NAME')}}</h1>
            <p>not implemented</p>
            {{-- Can we set up something to automatically pull notes from GH tags?? --}}
        </div>
    </main>
@endsection
