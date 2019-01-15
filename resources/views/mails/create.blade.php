@extends('layouts.app')

@section('title')
    Compose Mail
@endsection

@section('content')
    <h1>Compose Mail</h1>
    {!! Form::open(['action' => 'MailsController@postMail','method' =>'POST','enctype' =>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('sender','From')}}
            {{Form::email('sender','',['readonly','class'=>'form-control','placeholder' => auth()->user()->email])}}
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
        <div class="form-group">
            {{Form::label('','Max. 2MB')}}
            {{Form::file('uploaded_file',['span class'=>'btn btn-default btn-file'])}} 
            {{Form::button('Encrypt',['class'=>'btn btn-warning'])}}
            {{Form::label('','Click to encrypt file before send message')}}
        </div>
        {{Form::submit('Send Message',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection