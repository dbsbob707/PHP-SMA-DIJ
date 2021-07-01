@extends('layout')

@section('content')
    <div class="flex justify-center">
        <div class="bg-white p-2 rounded-lg">
            <div class="mb-5">
                @isset($key)
                    <div class="mb-2 bg-primary p-2 text-white rounded-lg">
                        <p>
                            Url: localhost:8000/{{ $key }}
                            <br>
                            Password: {{ $password }}
                        </p>
                    </div>
                @endisset

                
                

                <form action="{{ route('store') }}" method="post">
                    @csrf
                    <div class="mb-2">
                        <select name="colleague_email" class="form-control mb-2">
                            @if (count($colleague_emails))
                    @foreach ($colleague_emails as $colleague_email)
                        <p> {{$colleague_email['name']}}</p>
                        <option value="{{ $colleague_email['email'] }}">{{ $colleague_email['name'] }}</option>
                    @endforeach
                @endif
                        </select>
                        @error('colleague_email')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror

                        <textarea required name="messagecontent" class="form-control" rows="5"
                            value="{{ old('messagecontent') }}" placeholder="Plaats hier je bericht*"></textarea>
                        @error('messagecontent')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Versleutel bericht</button>
                </form>
            </div>
        </div>
    </div>
@endsection
