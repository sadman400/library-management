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
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('usertypes.show', $usertype->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('usertypes.edit', $usertype->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('usertypes.destroy', $usertype->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user type?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete
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
