@extends('layouts.admin')

@section('title', 'User Management - Admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <strong>Admin Users</strong>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">Add New User</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge bg-primary">{{ $user->role?->name ?? 'No role' }}</span></td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
