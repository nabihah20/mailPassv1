@extends('layouts.app')

@section('title')
    Inbox
@endsection

@section('content')
    <h1>Inbox</h1>
    @if (count($mails)>1)
        @foreach ($mails as $mail)
            <div class="well">
                <h3><a href="/mails/{{$mail->id}}">{{$mail->subject}}</h3>
                <small>Written on {{$mail->created_at}}</small>
            </div>
        @endforeach
            {{$mails ->links()}}
        @else
            <p>No mail found</p>
    @endif
@endsection