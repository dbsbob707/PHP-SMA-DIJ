@extends('layout')

@section('content')
    <div class="flex justify-center">
        <div class="bg-white p-2 rounded-lg">
            <div class="mb-5">
                @if (session('status'))
                    <div class="bg-danger p-2 rounded-lg mb-4 text-white text-center">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="staticKey">Key</label>
                        <input type="text" readonly name="key" id="staticKey" placeholder="key" value="{{ $page_id }}"
                            class="form-control @error('key') border-red-500 @enderror">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="form-control @error('password') border-red-500 @enderror">

                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">
                            Let's decrypt!
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
