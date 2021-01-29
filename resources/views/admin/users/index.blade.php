@extends('layouts.template')

@section('title', 'Users')

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Users</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('users.create') }}">Create a user<i class="fas fa-plus-circle"></i></a>
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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Date Created</th>
                    <th scope="col" width="180px">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr data-href="{{ route('users.show', $user->id) }}" onclick="window.location.href = this.getAttribute('data-href');" style="cursor: pointer;">
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ date_format($user->created_at, 'jS M Y') }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"><span class="material-icons">edit</span></a>

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
        {{ $users->links('pagination.default') }}
    </div>
@endsection
