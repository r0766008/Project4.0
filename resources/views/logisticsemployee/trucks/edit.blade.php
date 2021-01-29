@extends('layouts.template')

@section('title', 'Edit Truck')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Truck</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('logisticsemployee.trucks.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
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

    <form action="{{ route('logisticsemployee.trucks.update', $truck->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>License plate:</strong>
                    <input type="text" name="license_plate" value="{{ $truck->license_plate }}" class="form-control" placeholder="License plate">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>RFID:</strong>
                    <input type="text" name="rfid" value="{{ $truck->rfid }}" class="form-control" placeholder="RFID">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company:</strong>
                    <input type="text" name="company" value="{{ $truck->company }}" class="form-control" placeholder="Company">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
