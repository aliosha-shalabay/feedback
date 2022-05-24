@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{route('feedback.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="theme">{{__('Theme')}}</label>
                                <input type="text" name="theme" class="form-control" value="{{old('theme')}}" id="theme"
                                       placeholder="{{__('Theme')}}">
                                @error('theme')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea placeholder="{{__('Message')}}" class="form-control" name="message"
                                          id="message" rows="3">{{old('message')}}</textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file" class="form-label">File</label>
                                <input class="form-control" name="file" type="file" id="file">
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-2">{{__('Send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
