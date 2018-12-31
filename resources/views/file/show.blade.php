@extends('layouts.app')

@section('title')
    Mail {{$file->id}}
@endsection

@section('content')

<div>
  
</div>

<small>Written on {{$file->created_at}}</small>

<hr>
{!!Form::open(['action'=>['FileController@destroy',$file->id],'method'=>'POST'])!!}
{{Form::hidden('_method','DELETE')}}
{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
{!! Form::close() !!}


@endsection