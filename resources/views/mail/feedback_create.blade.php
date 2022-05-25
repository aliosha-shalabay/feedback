<p>{{__('Theme')}}: {{$data->theme}}</p>
<p>{{__('Message')}}: {{$data->message}}</p>
@if(!empty($data->file))
    <a href="{{asset('storage/' . $data->file)}}">{{__('File')}}</a>
@endif
