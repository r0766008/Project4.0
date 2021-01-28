@extends('layouts.template')

@section('title', 'Create Schedule')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Add New Schedule</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('schedules.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
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
    <form action="{{ route('schedules.store') }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date:</strong>
                    <input type="date" name="date" class="form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ETA:</strong>
                    <input type="time" name="eta" class="form-control" placeholder="ETA">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Truck:</strong>
                    <select class="form-control" name="truck_id" id="truck_id">
                        @foreach($trucks as $truck)
                            <option value="{{ $truck->id }}">{{ $truck->license_plate . " (" . $truck->company . ")" }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
