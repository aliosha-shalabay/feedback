@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('List') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('Theme')}}</th>
                                <th scope="col">{{__('Message')}}</th>
                                <th scope="col">{{__('User name')}}</th>
                                <th scope="col">{{__('User e-mail')}}</th>
                                <th scope="col">{{__('File')}}</th>
                                <th scope="col">{{__('Done')}}</th>
                                <th scope="col">{{__('Created')}}</th>
                                <th scope="col">{{__('Note')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feedbacks as $feedback)
                                <tr>
                                    <th scope="row">{{$feedback->id}}</th>
                                    <td>{{$feedback->theme}}</td>
                                    <td>{{$feedback->message}}</td>
                                    <td>{{$feedback->user->name}}</td>
                                    <td>{{$feedback->user->email}}</td>
                                    <td>
                                        @if(!empty($feedback->file))
                                            <a target="_blank" href="{{asset('storage/' . $feedback->file)}}">{{_('File')}}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$feedback->done ? __('Yes') : __('No')}}</td>
                                    <td>{{$feedback->created_at }}</td>
                                    <td>
                                        @if(!$feedback->done)
                                            <a href="{{route('manager.update', ['id' => $feedback->id])}}">{{_('Note')}}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $feedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
