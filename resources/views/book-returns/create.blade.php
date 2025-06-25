@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Create Book Return</h2>
        <a href="{{ route('book-returns.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Returns
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('book-returns.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="book_id" class="form-label">Book</label>
                        <select class="form-select @error('book_id') is-invalid @enderror" id="book_id" name="book_id" required>
                            <option value="">Select Book</option>
                            @foreach($books as $book)
                                <option value="{{ $book->book_id }}" {{ old('book_id') == $book->book_id ? 'selected' : '' }}>
                                    {{ $book->book_title }} ({{ $book->author }})
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="borrow_id" class="form-label">Issuance</label>
                        <select class="form-select @error('borrow_id') is-invalid @enderror" id="borrow_id" name="borrow_id" required>
                            <option value="">Select Issuance</option>
                            @foreach($issuances as $issuance)
                                <option value="{{ $issuance->borrow_id }}" {{ old('borrow_id') == $issuance->borrow_id ? 'selected' : '' }}>
                                    ID: {{ $issuance->borrow_id }} - {{ $issuance->member->firstname }} {{ $issuance->member->lastname }} ({{ date('Y-m-d', strtotime($issuance->date_borrow)) }})
                                </option>
                            @endforeach
                        </select>
                        @error('borrow_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="borrow_status" class="form-label">Status</label>
                        <select class="form-select @error('borrow_status') is-invalid @enderror" id="borrow_status" name="borrow_status" required>
                            <option value="Returned" {{ old('borrow_status') == 'Returned' ? 'selected' : '' }}>Returned</option>
                            <option value="Damaged" {{ old('borrow_status') == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                            <option value="Lost" {{ old('borrow_status') == 'Lost' ? 'selected' : '' }}>Lost</option>
                        </select>
                        @error('borrow_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="date_return" class="form-label">Return Date</label>
                        <input type="date" class="form-control @error('date_return') is-invalid @enderror" id="date_return" name="date_return" value="{{ old('date_return', date('Y-m-d')) }}" required>
                        @error('date_return')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Create Return Record</button>
                </div>
            </form>
        </div>
    </div>
@endsection
