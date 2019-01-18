@extends('layouts.app')

@section('title')
    Encrypt File
@endsection

@section('content')
<h1>Please choose one file or upload new file to send an email </h1>
<br/>
    <p>
    <a class="btn btn-info btn-lg" href="/uploadtofile" role="button">Upload File</a>
    </p> 
    @if (count($files)>0)
    <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Created on</th>
                <th>Action</th>
            </tr>
                @foreach ($files as $file)
                    <tr>
                        <td>
                            <a href="/file/{{$file->id}}/">{{$file->title}}</a>
                        </td>
                        <td>
                            <p>{{$file->created_at->diffForHumans() }}</p>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('encryptFile', $file->id) }}" role="button">Encrypt</a>
                        </td>
                    </tr>
                @endforeach
    </table>
    @else
    <br/>
        <h4>No file found</h4>
    @endif
@endsection