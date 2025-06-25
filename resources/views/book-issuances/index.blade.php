@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Book Issuances</h2>
        <a href="{{ route('book-issuances.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Issuance
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Member</th>
                            <th>Date Borrowed</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($issuances as $issuance)
                            <tr>
                                <td>{{ $issuance->borrow_id }}</td>
                                <td>{{ $issuance->member->firstname }} {{ $issuance->member->lastname }}</td>
                                <td>{{ date('F j, Y', strtotime($issuance->date_borrow)) }}</td>
                                <td>{{ date('F j, Y', strtotime($issuance->due_date)) }}</td>
                                <td>
                                    @php
                                        $hasReturns = $issuance->bookReturnDetails->count() > 0;
                                        $allReturned = $hasReturns && $issuance->bookReturnDetails->where('borrow_status', '!=', 'Returned')->count() === 0;
                                    @endphp
                                    
                                    @if($allReturned)
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($hasReturns)
                                        <span class="badge bg-warning">Partially Returned</span>
                                    @elseif(strtotime($issuance->due_date) < time())
                                        <span class="badge bg-danger">Overdue</span>
                                    @else
                                        <span class="badge bg-info">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('book-issuances.show', $issuance->borrow_id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('book-issuances.edit', $issuance->borrow_id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('book-issuances.destroy', $issuance->borrow_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this issuance?');">
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
                                <td colspan="6" class="text-center">No book issuances found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
