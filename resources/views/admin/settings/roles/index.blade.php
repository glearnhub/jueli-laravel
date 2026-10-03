@extends('layouts.admin')

@section('title', 'Roles & Permissions - Admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2 bg-dark text-white">
            <strong>Roles & Permissions</strong>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">Add New Role</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Users</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $index => $role)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->permissions()->count() }}</td>
                                <td>{{ $role->users_count }}</td>
                                <td>
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @if ($role->slug !== 'super-admin')
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this role?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No roles found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
