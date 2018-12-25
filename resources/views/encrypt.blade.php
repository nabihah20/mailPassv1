@extends('layouts.app')

@section('title')
    Encrypt File
@endsection

@section('content')
<h1>File Encryption</h1>
<div class="jumbotron"> 
<p class="mb-4">Upload any image. The encrypted version will be stored in <code>/storage/app/file.dat</code></p>
    {!! Form::open(['action' => 'PagesController@upload','method' =>'POST','enctype' =>'multipart/form-data']) !!}
        {{Form::file('attachment',['span class'=>'btn btn-default btn-file'])}} 
<br/>
        {{Form::submit('Upload and encrypt',['class'=>'btn btn-success btn-lg'])}}
    {!! Form::close() !!}   
</div>

@endsection