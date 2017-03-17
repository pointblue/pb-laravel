@extends('layouts.main')

@section('subtitle', 'Feedback')

@section('content')
    <main class="container">
        <div >
            <h1>Feedback For {{env('PB_APP_NAME')}}</h1>
            <p>We'd love to hear what you think! To leave feedback, contact datasolutions@pointblue.org</p>
        </div>
    </main>
@endsection