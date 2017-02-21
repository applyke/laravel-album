@extends('layout.default')
@section('content')
    <div class="container-fluid">
        <h1>Album Gallery</h1>
        <p class="lead">This is list of your albums. <a href="{{ url('/album/create') }}">Add new album</a></p>
        <hr>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    </div>
    @forelse($albums as $album)
        <div class="form-group">
            <div class="thumbnail">
                <div class="caption">
                    <h3>{{$album->title}}</h3>
                    <p>{!! substr($album->description, 0,100) !!}</p>
                    <div class="row text-center" style="padding-left:1em;">
                        <a href="{{ url('/album/'.$album->id) }}"
                           class="btn btn-warning pull-left button-green">Details</a>
                        <a class="btn btn-warning pull-left" href="{{ route('album.edit',$album->id) }}">Edit</a>
                        <span class="pull-left">&nbsp;</span>
                        {!! Form::open(['url'=>'/album/'.$album->id, 'class'=>'pull-left']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick'=>'return confirm(\'Are you sure?\')']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No albums yet, <a href="{{ url('/album/create') }}">add a new one</a>?</p>
    @endforelse
    <div align="center">{!! $albums->render() !!}</div>
@stop