@extends('layouts.template')

@section('title', 'Schedule Details')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Schedule Details</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('logisticsemployee.schedules.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
            </div>
            <br><br>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                {{ $schedule->date }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ETA:</strong>
                {{ $schedule->eta }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Arrival:</strong>
                {{ $schedule->ata }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Departure:</strong>
                {{ $schedule->atd }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Truck:</strong>
                {{ $schedule->truck->truck->license_plate }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Bay:</strong>
                {{ $schedule->bay->number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                <form action="{{$schedule->id}}/change" method="POST">
                    @csrf
                    <div class="row" style="margin-left: 0px;">
                        <div class="col-xs-6" style="margin-right: 10px;">
                            <select class="form-control" name="schedule_status_id" id="schedule_status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"{{ ($schedule->schedule_status_id == $status->id ? 'selected' : '') }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-success">
                                <span>Change Status</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
