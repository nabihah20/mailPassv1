@extends('layouts.app')

@section('title')
    Send Email
@endsection

@section('content')
    <h1>Send Email</h1>
    {!! Form::open(['action' => 'MailController@post','method' =>'POST']) !!}
    {{csrf_field()}}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control','placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder' => 'Body Text'])}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection