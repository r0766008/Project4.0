@extends('layouts.template')

@section('title', 'Schedules')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Schedules</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('logisticsemployee.schedules.create') }}">Create a schedule<i class="fas fa-plus-circle"></i></a>
            </div>
            <br><br>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning">
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
                    <th scope="col">Date Created</th>
                    <th scope="col" width="180px">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($schedules as $schedule)
                <tr data-href="{{ route('logisticsemployee.schedules.show', $schedule->id) }}" onclick="window.location.href = this.getAttribute('data-href');" style="cursor: pointer;">
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->eta }}</td>
                    <td>{{ $schedule->ata }}</td>
                    <td>{{ $schedule->atd }}</td>
                    <td>{{ $schedule->truck->truck->license_plate }}</td>
                    <td>{{ $schedule->bay->number }}</td>
                    <td>{{ $schedule->status->name }}</td>
                    <td>{{ date_format($schedule->created_at, 'jS M Y') }}</td>
                    <td>
                        <form action="{{ route('logisticsemployee.schedules.destroy', $schedule->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('logisticsemployee.schedules.edit', $schedule->id) }}"><span class="material-icons">edit</span></a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <span class="material-icons">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $schedules->links('pagination.default') }}
    </div>
@endsection
