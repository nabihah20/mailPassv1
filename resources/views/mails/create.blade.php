@extends('layouts.app')

@section('title')
    Compose Mail
@endsection

@section('content')
    <h1>Compose Mail</h1>
    {!! Form::open(['action' => 'MailsController@postMail','method' =>'POST']) !!}
        <div class="form-group">
            {{Form::label('email','From')}}
            {{Form::email('email','',['readonly','class'=>'form-control','placeholder' => auth()->user()->email])}}
        </div>
        <div class="form-group">
            {{Form::label('recipientEmail','To')}}
            {{Form::email('recipientEmail','',['class'=>'form-control','placeholder' => 'Recipient Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('subject','Subject')}}
            {{Form::text('subject','',['class'=>'form-control','placeholder' => 'Subject'])}}
        </div>
        <div class="form-group">
            {{Form::label('bodyMessage','Message')}}
            {{Form::textarea('bodyMessage','',['id'=>'article-ckeditor','class'=>'form-control','placeholder' => 'Body Message'])}}
        </div>
        <div class="form-group">
            {{Form::label('','Max. 32MB')}}
            {{Form::file('a_file',['span class'=>'btn btn-default btn-file'])}} 
        </div>
        {{Form::submit('Send Message',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection