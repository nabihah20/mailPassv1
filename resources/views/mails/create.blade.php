@extends('layouts.app')

@section('title')
    Create New Email
@endsection

@section('content')
    <h1>Create New Email</h1>
    {!! Form::open(['action' => 'MailsController@store','method' =>'POST']) !!}
        <div class="form-group">

            {{Form::text('email','',['class'=>'form-control','placeholder' => 'Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('senderEmail','Sender Email')}}
            {{Form::text('senderEmail','',['class'=>'form-control','placeholder' => 'Sender Email'])}}
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