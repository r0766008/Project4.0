@extends('layouts.template')

@section('title', 'Truck Details')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Truck Details</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('logisticsemployee.trucks.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
            </div>
            <br><br>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>License plate:</strong>
                {{ $truck->license_plate }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>RFID:</strong>
                {{ $truck->rfid }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company:</strong>
                {{ $truck->company }}
            </div>
        </div>
    </div>
@endsection
