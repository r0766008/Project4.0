@extends('layouts.template')

@section('title', 'Edit Schedule')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Schedule</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('logisticsemployee.schedules.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
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

    <form action="{{ route('logisticsemployee.schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date:</strong>
                    <input type="date" name="date" value="{{ $schedule->date }}" class="form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ETA:</strong>
                    <input type="time" name="eta" value="{{ $schedule->eta }}" class="form-control" placeholder="ETA">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Arrival:</strong>
                    <input type="time" name="ata" value="{{ $schedule->ata }}" class="form-control" placeholder="ATA">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Departure:</strong>
                    <input type="time" name="atd" value="{{ $schedule->atd }}" class="form-control" placeholder="ATD">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Truck:</strong>
                    <select class="form-control" name="user_truck_id" id="user_truck_id">
                        @foreach($trucks as $truck)
                            <option value="{{ $truck->id }}"{{ ($schedule->user_truck_id ==  $truck->id ? 'selected' : '') }}>{{ $truck->truck->license_plate . " (" . $truck->user->name . ")"}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Bay:</strong>
                    <select class="form-control" name="bay_id" id="bay_id">
                        @foreach($bays as $bay)
                            <option value="{{ $bay->id }}"{{ ($schedule->bay_id ==  $bay->id ? 'selected' : '') }}>{{ $bay->number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="form-control" name="schedule_status_id" id="schedule_status_id">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}"{{ ($schedule->schedule_status_id ==  $status->id ? 'selected' : '') }}>{{ $status->name }}</option>
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
