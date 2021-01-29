@extends('layouts.template')

@section('title', 'Bays')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Bays</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('admin.bays.create') }}">Create a bay<i class="fas fa-plus-circle"></i></a>
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
                    <th scope="col">Number</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date Created</th>
                    <th scope="col" width="180px">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bays as $bay)
                <tr data-href="{{ route('admin.bays.show', $bay->id) }}" onclick="window.location.href = this.getAttribute('data-href');" style="cursor: pointer;">
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $bay->number }}</td>
                    <td>{{ $bay->status->name }}</td>
                    <td>{{ date_format($bay->created_at, 'jS M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.bays.destroy', $bay->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('admin.bays.edit', $bay->id) }}"><span class="material-icons">edit</span></a>

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
        {{ $bays->links('pagination.default') }}
    </div>
@endsection
