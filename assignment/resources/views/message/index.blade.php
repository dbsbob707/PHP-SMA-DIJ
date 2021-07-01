@extends('layout')

@section('content')
    <div class="flex justify-center">
        <div class="bg-white p-2 rounded-lg">


            <div class="mb-2">
                @if ($message->colleague_email)
                    <p class="mb-2"> <u> To: {{ $message->colleague_email }} </u></p>
                @endif
                <p class="mb-2">{{ $message->messagecontent }}</p>
                <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
@endsection
