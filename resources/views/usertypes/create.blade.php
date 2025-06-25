@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Create User Type</h2>
        <a href="{{ route('usertypes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to User Types
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('usertypes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="borrowertype" class="form-label">Borrower Type</label>
                    <input type="text" class="form-control @error('borrowertype') is-invalid @enderror" id="borrowertype" name="borrowertype" value="{{ old('borrowertype') }}" required>
                    @error('borrowertype')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create User Type</button>
            </form>
        </div>
    </div>
@endsection
