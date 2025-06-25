@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>User Types</h2>
        <a href="{{ route('usertypes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New User Type
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Borrower Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usertypes as $usertype)
                            <tr>
                                <td>{{ $usertype->id }}</td>
                                <td>{{ $usertype->borrowertype }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('usertypes.show', $usertype->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="tooltip" title="View details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('usertypes.edit', $usertype->id) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3" data-bs-toggle="tooltip" title="Edit user type">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('usertypes.destroy', $usertype->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user type?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" data-bs-toggle="tooltip" title="Delete user type">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No user types found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
