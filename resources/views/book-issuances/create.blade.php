@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Create Book Issuance</h2>
        <a href="{{ route('book-issuances.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Issuances
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('book-issuances.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="member_id" class="form-label">Member</label>
                        <select class="form-select @error('member_id') is-invalid @enderror" id="member_id" name="member_id" required>
                            <option value="">Select Member</option>
                            @foreach($members as $member)
                                <option value="{{ $member->member_id }}" {{ old('member_id') == $member->member_id ? 'selected' : '' }}>
                                    {{ $member->firstname }} {{ $member->lastname }} ({{ $member->type }})
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="date_borrow" class="form-label">Date Borrowed</label>
                        <input type="date" class="form-control @error('date_borrow') is-invalid @enderror" id="date_borrow" name="date_borrow" value="{{ old('date_borrow', date('Y-m-d')) }}" required>
                        @error('date_borrow')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}" required>
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Create Issuance</button>
                </div>
            </form>
        </div>
    </div>
@endsection
