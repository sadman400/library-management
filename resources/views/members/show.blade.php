@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Member Details</h2>
        <div>
            <a href="{{ route('members.edit', $member->member_id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Members
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">ID</th>
                            <td>{{ $member->member_id }}</td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td>{{ $member->firstname }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ $member->lastname }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $member->gender }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $member->address }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Contact</th>
                            <td>{{ $member->contact }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ $member->type }}</td>
                        </tr>
                        <tr>
                            <th>Year Level</th>
                            <td>{{ $member->year_level }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $member->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $member->status }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h3>Book Issuance History</h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($member->bookIssuanceDetails as $issuance)
                                <tr>
                                    <td>{{ $issuance->borrow_id }}</td>
                                    <td>{{ date('F j, Y', strtotime($issuance->date_borrow)) }}</td>
                                    <td>{{ date('F j, Y', strtotime($issuance->due_date)) }}</td>
                                    <td>
                                        <a href="{{ route('book-issuances.show', $issuance->borrow_id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No book issuance records found for this member.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
