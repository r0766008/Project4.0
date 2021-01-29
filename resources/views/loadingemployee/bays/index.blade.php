@extends('layouts.template')

@section('title', 'My Schedules')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>My Schedules</h2>
            </div>
            <br><br>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">ETA</th>
                    <th scope="col">Arrival</th>
                    <th scope="col">Departure</th>
                    <th scope="col">Truck</th>
                    <th scope="col">Bay</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->eta }}</td>
                    <td>{{ $schedule->ata }}</td>
                    <td>{{ $schedule->atd }}</td>
                    <td>{{ $schedule->truck->license_plate }}</td>
                    <td>{{ $schedule->bay->number }}</td>
                    <td>{{ $schedule->status->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $schedules->links('pagination.default') }}
    </div>
@endsection
