@extends('layouts.template')

@section('title', 'Create Schedule')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Add New Schedule</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.schedules.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
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
    <form action="{{ route('admin.schedules.store') }}" method="POST" >
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
                    <select class="form-control" name="user_truck_id" id="user_truck_id">
                        @foreach($trucks as $truck)
                            <option value="{{ $truck->id }}">{{ $truck->truck->license_plate . " (" . $truck->user->name . ")"}}</option>
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
    <hr>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Add Day Schedule</h2>
            </div>
        </div>
    </div>
    <form action="/admin/schedules/dayschedule/create" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date:</strong>
                    <input type="date" value="{{ now()->toDateString() }}" name="date" min="{{ now()->toDateString() }}" class="form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start Time:</strong>
                    <input type="time" value="08:00" name="start_time" class="form-control" placeholder="Start Time">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>End Time:</strong>
                    <input type="time" value="17:00" name="end_time" class="form-control" placeholder="End Time">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Time interval (minutes):</strong>
                    <input type="text" value="60" name="time_interval" class="form-control" placeholder="Interval">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Drivers:</strong>
                    <select class="form-control" multiple name="user_truck_id[]" id="user_truck_id">
                        @foreach($trucks as $truck)
                            <option value="{{ $truck->id }}">{{ $truck->truck->license_plate . " (" . $truck->user->name . ")"}}</option>
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
