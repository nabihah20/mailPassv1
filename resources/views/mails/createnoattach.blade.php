@extends('layouts.app')

@section('title')
    Compose Mail
@endsection

@section('content')
    <h1>Compose Mail</h1>
    {!! Form::open(['action' => 'MailsController@postMailNoAttach','method' =>'POST']) !!}
        <div class="form-group">
            {{Form::label('sender','From')}}
            {{Form::email('email','',['readonly','class'=>'form-control','placeholder' => auth()->user()->email])}}
        </div>
        <div class="form-group">
            {{Form::label('recipient','To')}}
            {{Form::email('recipient','',['class'=>'form-control','placeholder' => 'Recipient Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('subject','Subject')}}
            {{Form::text('subject','',['class'=>'form-control','placeholder' => 'Subject'])}}
        </div>
        <div class="form-group">
            {{Form::label('content','Message')}}
            {{Form::textarea('content','',['class'=>'form-control','placeholder' => 'Body Message'])}}
        </div>
        {{Form::submit('Send Message',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection