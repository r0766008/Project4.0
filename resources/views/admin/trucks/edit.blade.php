@extends('layouts.template')

@section('title', 'Edit Truck')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Truck</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.trucks.index') }}" title="Go back">Go back<i class="fas fa-backward "></i> </a>
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

    <form action="{{ route('admin.trucks.update', $truck->id) }}" method="POST">
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
    <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Truck Drivers</h2>
            </div>
            <div class="float-right">
                <form action="drivers/create" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xs-6" style="margin-right: 10px;">
                            <select class="form-control" name="user_id" id="user_id">
                                @foreach($remainingusers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-success">
                                <span>Add Driver</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <br><br>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col" width="180px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $user->user->name }}</td>
                    <td>{{ $user->user->email }}</td>
                    <td>
                        <form action="drivers/{{ $user->user->id }}" method="POST">
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
@endsection
