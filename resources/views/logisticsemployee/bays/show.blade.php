@extends('layouts.template')

@section('title', 'Bay Details')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Bay Details</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('logisticsemployee.bays.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
            </div>
            <br><br>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Number:</strong>
                {{ $bay->number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $bay->status->name }}
            </div>
        </div>
    </div>
@endsection
