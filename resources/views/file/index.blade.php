@extends('layouts.app')

@section('title')
    Files
@endsection

@section('content')
<h1>Files</h1>
<br/>
    <p>
    <a class="btn btn-info btn-lg" href="/upload" role="button">Upload File</a>
    </p>  
    @if (count($files)>0)
    <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Created on</th>
                <th></th>
                <th>Action</th>
                <th></th>
                <th></th>
            </tr>
                @foreach ($files as $file)
                    <tr>
                        <td>
                            <a href="/file/{{$file->id}}">{{$file->title}}</a>
                        </td>
                        <td>
                            <p>{{$file->created_at->diffForHumans() }}</p>
                        </td>
                        <td>
                                {!!Form::open(['action'=>['FileController@destroy',$file->id],'method'=>'POST'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}
                        </td>
                        <td>
                                <a class="btn btn-primary" href="{{ route('downloadFile', $file->id) }}" role="button">Download</a>
                        </td>
                        <td>
                                <a class="btn btn-info" href="{{ route('emailFile', $file->id) }}" role="button">Encrypt</a>
                        </td>
                        <td>
                                <a class="btn btn-success" href="{{ route('emailFile', $file->id) }}" role="button">Email</a>
                        </td>
                    </tr>
                @endforeach
    </table>
    @else
    <br/>
        <h4>No file found</h4>
    @endif
@endsection