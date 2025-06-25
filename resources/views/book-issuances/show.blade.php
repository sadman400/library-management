@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Book Issuance Details</h2>
        <div>
            <a href="{{ route('book-issuances.edit', $issuance->borrow_id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('book-issuances.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Issuances
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Issuance Information</h4>
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Issuance ID</th>
                            <td>{{ $issuance->borrow_id }}</td>
                        </tr>
                        <tr>
                            <th>Date Borrowed</th>
                            <td>{{ date('F j, Y', strtotime($issuance->date_borrow)) }}</td>
                        </tr>
                        <tr>
                            <th>Due Date</th>
                            <td>{{ date('F j, Y', strtotime($issuance->due_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
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
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Member Information</h4>
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Member ID</th>
                            <td>{{ $issuance->member->member_id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $issuance->member->firstname }} {{ $issuance->member->lastname }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ $issuance->member->type }}</td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td>{{ $issuance->member->contact }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Book Return Details</h3>
            <a href="{{ route('book-returns.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Book Return
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Book</th>
                                <th>Status</th>
                                <th>Return Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($issuance->bookReturnDetails as $return)
                                <tr>
                                    <td>{{ $return->borrow_detail_id }}</td>
                                    <td>{{ $return->book->book_title }}</td>
                                    <td>
                                        <span class="badge {{ $return->borrow_status == 'Returned' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $return->borrow_status }}
                                        </span>
                                    </td>
                                    <td>{{ date('F j, Y', strtotime($return->date_return)) }}</td>
                                    <td>
                                        <a href="{{ route('book-returns.show', $return->borrow_detail_id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No return records found for this issuance.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
