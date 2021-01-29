@extends('layouts.template')

@section('title', 'Edit Bay')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Bay</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.bays.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
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

    <form action="{{ route('admin.bays.update', $bay->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Number:</strong>
                    <input type="text" name="number" value="{{ $bay->number }}" class="form-control" placeholder="Number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="form-control" name="bay_status_id" id="bay_status_id">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}"{{ ($bay->bay_status_id ==  $status->id ? 'selected' : '') }}>{{ $status->name }}</option>
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
