@extends('layouts.template')

@section('title', 'Trucks')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Trucks</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('logisticsemployee.trucks.create') }}">Create a truck<i class="fas fa-plus-circle"></i></a>
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
                    <th scope="col">License plate</th>
                    <th scope="col">RFID</th>
                    <th scope="col">Company</th>
                    <th scope="col">Date Created</th>
                    <th scope="col" width="180px">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($trucks as $truck)
                <tr data-href="{{ route('logisticsemployee.trucks.show', $truck->id) }}" onclick="window.location.href = this.getAttribute('data-href');" style="cursor: pointer;">
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $truck->license_plate }}</td>
                    <td>{{ $truck->rfid }}</td>
                    <td>{{ $truck->company }}</td>
                    <td>{{ date_format($truck->created_at, 'jS M Y') }}</td>
                    <td>
                        <form action="{{ route('logisticsemployee.trucks.destroy', $truck->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('logisticsemployee.trucks.edit', $truck->id) }}"><span class="material-icons">edit</span></a>

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
        {{ $trucks->links('pagination.default') }}
    </div>
@endsection
