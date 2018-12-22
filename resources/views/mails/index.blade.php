@extends('layouts.app')

@section('title')
    Inbox
@endsection

@section('content')
    <h1>Inbox</h1>
    @if (count($sent_emails)>1)
        @foreach ($sent_emails as $sent_email)
            <div class="well">
                <h3><a href="/mails/{{$sent_email->id}}">{{$sent_email->subject}}</h3>
                <small>Written on {{$sent_email->created_at}}</small>
            </div>
        @endforeach
            {{$mails ->links()}}
        @else
            <p>No mail found</p>
    @endif
@endsection