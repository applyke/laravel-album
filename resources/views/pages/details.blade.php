@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="form-group">
            {!! Form::open([ 'route' => 'image.store', 'class'=>'pull-left', 'files' => true, 'method' => 'POST']) !!}
            {!! Form::label('Add New Image') !!}
            {!! Form::hidden('album_id', $id) !!}
            {!! Form::file('image', null,['class'=>'form-control']) !!}
            {!! Form::submit() !!}
            {!! Form::close() !!}
        </div>
        <a href="{{ url('/') }}" class="btn btn-warning pull-right">Back</a>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    </div>
    <div class="row row-flex row-flex-wrap">
        @forelse($images as $image)

            <div class="col-md-3 border-block">
                <div class="thumbnail">
                    <img src="{{asset($image->file)}}"/>
                    <div class="caption">
                        <div class="row text-center delete" style="padding-left:1em;">
                            <span class="pull-left">&nbsp;</span>
                            {!! Form::open(['url'=>'/image/'.$image->id, 'class'=>'pull-bottom']) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger ', 'onclick'=>'return confirm(\'Are you sure?\')']) !!}
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        @empty
                <span class="alert alert-danger left-block">No images yet.</span>
        @endforelse
    </div>
@stop