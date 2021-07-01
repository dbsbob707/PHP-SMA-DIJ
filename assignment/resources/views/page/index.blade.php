@extends('layout')

@section('content')
    <div class="flex justify-center">
        <div class="bg-white p-2 rounded-lg">
            <div class="mb-5">
                <p>
                    url: {{ $url }}
                    Password: {{ $password }}
                    Expires at: {{ $expires_at }}
                </p>
            </div>
        </div>
    </div>
@endsection
