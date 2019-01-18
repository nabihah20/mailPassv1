@extends('layouts.app')

@section('title')
    Upload File
@endsection

@section('content')
<h1>Upload File</h1>
<div class="jumbotron"> 
    {!! Form::open(['action' => 'FileController@storetofile','method' =>'POST','enctype' =>'multipart/form-data']) !!} 
        {{Form::file('file[]', array('multiple'=>true),['span class'=>'btn btn-default btn-file',])}} 
<br/>
        {{Form::submit('Upload',['class'=>'btn btn-success btn-lg'])}}
    {!! Form::close() !!}   
</div>

@endsection