@extends('layout.default')

@section('content')
    <div class="container-fluid">
    <div class="form-group">
        {!! Form::open(['url'=>'/image/'.$id, 'class'=>'pull-left', 'files' => true, 'method' => 'POST']) !!}
        {!! Form::label('Add New Image') !!}
        {!! Form::file('image', null,['class'=>'form-control']) !!}
        {!! Form::submit() !!}
        {!! Form::close() !!}
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        </div>
    <div class="row">
        @forelse($images as $image)
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="{{asset($image->file)}}"/>
                    <div class="caption">
                            <div class="row text-center" style="padding-left:1em;">
                            <span class="pull-left">&nbsp;</span>
                            {!! Form::open(['url'=>'/image/'.$image->id, 'class'=>'pull-left']) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick'=>'return confirm(\'Are you sure?\')']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>


    @empty
            <div class="row text-center">
                <span class="alert alert-danger">No images yet.</span>
            </div>
    @endforelse
    </div>
@stop