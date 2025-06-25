@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>User Type Details</h2>
        <div>
            <a href="{{ route('usertypes.edit', $usertype->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('usertypes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to User Types
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th style="width: 200px;">ID</th>
                    <td>{{ $usertype->id }}</td>
                </tr>
                <tr>
                    <th>Borrower Type</th>
                    <td>{{ $usertype->borrowertype }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
