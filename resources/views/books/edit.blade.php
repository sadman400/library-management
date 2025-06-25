@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Book</h2>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Books
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.update', $book->book_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="book_title" class="form-label">Book Title</label>
                        <input type="text" class="form-control @error('book_title') is-invalid @enderror" id="book_title" name="book_title" value="{{ old('book_title', $book->book_title) }}" required>
                        @error('book_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ old('category_id', $book->category_id) == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->classname }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $book->author) }}" required>
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="book_copies" class="form-label">Number of Copies</label>
                        <input type="number" class="form-control @error('book_copies') is-invalid @enderror" id="book_copies" name="book_copies" value="{{ old('book_copies', $book->book_copies) }}" min="1" required>
                        @error('book_copies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="book_pub" class="form-label">Publication</label>
                        <input type="text" class="form-control @error('book_pub') is-invalid @enderror" id="book_pub" name="book_pub" value="{{ old('book_pub', $book->book_pub) }}">
                        @error('book_pub')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="publisher_name" class="form-label">Publisher</label>
                        <input type="text" class="form-control @error('publisher_name') is-invalid @enderror" id="publisher_name" name="publisher_name" value="{{ old('publisher_name', $book->publisher_name) }}">
                        @error('publisher_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="ISBN" class="form-label">ISBN</label>
                        <input type="text" class="form-control @error('ISBN') is-invalid @enderror" id="ISBN" name="ISBN" value="{{ old('ISBN', $book->ISBN) }}">
                        @error('ISBN')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="copyright_year" class="form-label">Copyright Year</label>
                        <input type="number" class="form-control @error('copyright_year') is-invalid @enderror" id="copyright_year" name="copyright_year" value="{{ old('copyright_year', $book->copyright_year) }}">
                        @error('copyright_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="date_receiver" class="form-label">Date Received</label>
                        <input type="date" class="form-control @error('date_receiver') is-invalid @enderror" id="date_receiver" name="date_receiver" value="{{ old('date_receiver', $book->date_receiver ? date('Y-m-d', strtotime($book->date_receiver)) : '') }}">
                        @error('date_receiver')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="date_added" class="form-label">Date Added</label>
                        <input type="date" class="form-control @error('date_added') is-invalid @enderror" id="date_added" name="date_added" value="{{ old('date_added', $book->date_added ? date('Y-m-d', strtotime($book->date_added)) : '') }}">
                        @error('date_added')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Available" {{ old('status', $book->status) == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Borrowed" {{ old('status', $book->status) == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option value="Damaged" {{ old('status', $book->status) == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                            <option value="Lost" {{ old('status', $book->status) == 'Lost' ? 'selected' : '' }}>Lost</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </div>
            </form>
        </div>
    </div>
@endsection
