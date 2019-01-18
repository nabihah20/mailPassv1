@extends('layouts.app')

@section('title')
    Compose Mail
@endsection

@section('content')
    <h1>Compose Mail</h1>
    {!! Form::open(['action' => 'FileController@sentMail','method' =>'POST','enctype' =>'multipart/form-data']) !!}
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
            {{Form::label('file','FILE PROPERTIES')}} <br/>
            {{Form::label('title','File Name')}}
            {{Form::text('title','',['readonly','class'=>'form-control','placeholder' => $title = Session::get( 'title' )])}}
            {{Form::label('id','File Id')}}
            {{Form::text('id','',['readonly','class'=>'form-control','placeholder' => $id = Session::get( 'id' )])}}
            {{Form::label('path','File Path')}}
            {{Form::text('path','',['readonly','class'=>'form-control','placeholder' => $path = Session::get( 'path' )])}}
        </div>
        {{Form::submit('Encrypt & Send Message',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection