@extends('layouts.template')

@section('title', 'Create Bay')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Add New Bay</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('loading.bays.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
            </div>
            <br><br>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('loading.bays.store') }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Bay:</strong>
                    <select class="form-control" name="bay_id" id="bay_id">
                        @foreach($bays as $bay)
                            <option value="{{ $bay->id }}">{{ $bay->number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
