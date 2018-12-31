@extends('layouts.app')

@section('title')
    Settings
@endsection

@section('content')
    <h1>Settings</h1>

    <h2>Two-Factor Authentication</h2>
    {!! Form::open(['action' => 'DashboardController@settings','method' =>'POST']) !!}
        <div class="form-group">
            {{Form::label('email','Recipient Email')}}
            {{Form::email('email','',['class'=>'form-control','placeholder' => auth()->user()->email])}}
        </div> 
        <div class="form-group">
            {{Form::label('phoneNo','Recipient Phone Number')}}
            {{Form::number('phoneNo','',['class'=>'form-control','placeholder' => auth()->user()->phoneNo])}}
        </div>
        <div class="form-group">
            {{Form::label('type2FA','Type of 2FA')}}
            {{Form::select('size', ['0' => 'SMS', '7' => 'TOTP'], '0')}}
        </div>
        {{Form::submit('Save',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection