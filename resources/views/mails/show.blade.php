@extends('layouts.app')

@section('title')
    Mail {{$sent_email->id}}
@endsection

@section('content')
    
        <a href="/dashboard" class="btn btn-default">Go Back</a>
        <br/>
        <h1>{{$sent_email->subject}}</h1>
        <br/>
        <h5>To: {{$sent_email->recipient}}</h5>
        <h5>From: {{$sent_email->sender}}</h5>
        <hr>
        <br/><br/>
        <div>
            {!!$sent_email->content!!}    
        </div>
        <br/>
        <hr>
        <small>Written on {{$sent_email->created_at}}</small>
        <hr>
        {!!Form::open(['action'=>['MailsController@destroy',$sent_email->id],'method'=>'POST','class'=>'pull-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
        {!! Form::close() !!}


@endsection

