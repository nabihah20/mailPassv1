@extends('layouts.app')

@section('title')
    Mails {{$mail->id}}
@endsection

@section('content')
    
        <a href="/mails" class="btn btn-default">Go Back</a>
        <h1>{{$mail->subject}}</h1>
        <h5>To: {{$mail->senderEmail}}</h5>
        <h5>From: {{$mail->email}}</h5>
        <div>
            {!!$mail->message!!}    
        </div>
        <hr>
        <small>Written on {{$mail->created_at}}</small>
        <hr>
        <a href="/posts/{{$mail->id}}/edit" class="btn btn-default">Edit</a>
        {!!Form::open(['action'=>['MailsController@destroy',$mail->id],'method'=>'POST','class'=>'pull-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
    {!! Form::close() !!}


@endsection

