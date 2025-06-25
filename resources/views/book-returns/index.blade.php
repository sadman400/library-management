@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Book Returns</h2>
        <a href="{{ route('book-returns.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Return
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book</th>
                            <th>Member</th>
                            <th>Status</th>
                            <th>Return Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returns as $return)
                            <tr>
                                <td>{{ $return->borrow_detail_id }}</td>
                                <td>{{ $return->book->book_title }}</td>
                                <td>{{ $return->bookIssuanceDetail->member->firstname }} {{ $return->bookIssuanceDetail->member->lastname }}</td>
                                <td>
                                    <span class="badge {{ $return->borrow_status == 'Returned' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $return->borrow_status }}
                                    </span>
                                </td>
                                <td>{{ date('F j, Y', strtotime($return->date_return)) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('book-returns.show', $return->borrow_detail_id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('book-returns.edit', $return->borrow_detail_id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('book-returns.destroy', $return->borrow_detail_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this return record?');">
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
                                <td colspan="6" class="text-center">No book returns found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
