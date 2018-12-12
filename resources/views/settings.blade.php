@extends('layouts.app')

@section('title')
    Settings
@endsection

@section('content')
    <h1>Settings</h1>

    <h2>Two-Factor Authentication</h2>
    {!! Form::open(['action' => 'DashboardController@settings','method' =>'POST']) !!}
        <div class="form-group">
            {{Form::label('recipientEmail','Recipient Name')}}
            {{Form::email('recipientEmail','',['class'=>'form-control','placeholder' => 'Recipient Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('recipientPhone','Receiver Phone Number')}}
            {{Form::email('recipientPhone','',['class'=>'form-control','placeholder' => 'Recipient Phone'])}}
        </div>
        <div class="form-group">
            {{Form::label('type','Type of 2FA')}}
            {{Form::text('type','',['class'=>'form-control','placeholder' => 'Type'])}}
        </div>
        {{Form::submit('Save',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection