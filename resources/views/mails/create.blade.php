@extends('layouts.app')

@section('title')
    Compose Mail
@endsection

@section('content')
    <h1>Compose Mail</h1>
    {!! Form::open(['action' => 'MailsController@store','method' =>'POST']) !!}
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
            {{Form::label('message','Message')}}
            {{Form::textarea('message','',['id'=>'article-ckeditor','class'=>'form-control','placeholder' => 'Body Message'])}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection