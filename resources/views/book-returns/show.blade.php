@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Book Return Details</h2>
        <div>
            <a href="{{ route('book-returns.edit', $return->borrow_detail_id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('book-returns.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Returns
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Return Information</h4>
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Return ID</th>
                            <td>{{ $return->borrow_detail_id }}</td>
                        </tr>
                        <tr>
                            <th>Return Date</th>
                            <td>{{ date('F j, Y', strtotime($return->date_return)) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $return->borrow_status == 'Returned' ? 'bg-success' : ($return->borrow_status == 'Damaged' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $return->borrow_status }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Book Information</h4>
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Book ID</th>
                            <td>{{ $return->book->book_id }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $return->book->book_title }}</td>
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td>{{ $return->book->author }}</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>{{ $return->book->ISBN }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <h4>Issuance Information</h4>
                <table class="table">
                    <tr>
                        <th style="width: 200px;">Issuance ID</th>
                        <td>{{ $return->bookIssuanceDetail->borrow_id }}</td>
                    </tr>
                    <tr>
                        <th>Member</th>
                        <td>{{ $return->bookIssuanceDetail->member->firstname }} {{ $return->bookIssuanceDetail->member->lastname }}</td>
                    </tr>
                    <tr>
                        <th>Date Borrowed</th>
                        <td>{{ date('F j, Y', strtotime($return->bookIssuanceDetail->date_borrow)) }}</td>
                    </tr>
                    <tr>
                        <th>Due Date</th>
                        <td>{{ date('F j, Y', strtotime($return->bookIssuanceDetail->due_date)) }}</td>
                    </tr>
                    <tr>
                        <th>Days Overdue</th>
                        <td>
                            @php
                                $dueDate = strtotime($return->bookIssuanceDetail->due_date);
                                $returnDate = strtotime($return->date_return);
                                $daysOverdue = $returnDate > $dueDate ? floor(($returnDate - $dueDate) / (60 * 60 * 24)) : 0;
                            @endphp
                            
                            @if($daysOverdue > 0)
                                <span class="text-danger">{{ $daysOverdue }} days</span>
                            @else
                                <span class="text-success">0 days (Returned on time)</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
