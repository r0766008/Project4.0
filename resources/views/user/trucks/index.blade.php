@extends('layouts.template')

@section('title', 'My Trucks')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>My Trucks</h2>
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
                    <th scope="col">License Plate</th>
                    <th scope="col">Company</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($trucks as $truck)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $truck->truck->license_plate }}</td>
                    <td>{{ $truck->truck->company }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $trucks->links('pagination.default') }}
    </div>
@endsection
