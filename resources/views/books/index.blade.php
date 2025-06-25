@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h2><i class="fas fa-book text-primary me-2"></i>Book Collection</h2>
                <p class="text-muted">Manage your library's book inventory</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Book
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <form action="{{ route('books.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search by title or author..." name="search" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="category">
                        <option value="">All Categories</option>
                        <!-- We'll implement this filter functionality later -->
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="status">
                        <option value="">All Statuses</option>
                        <option value="Available">Available</option>
                        <option value="Borrowed">Borrowed</option>
                        <option value="Damaged">Damaged</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Books Inventory</h5>
            <span class="badge bg-primary">{{ count($books) }} Books</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Copies</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                            <tr>
                                <td>{{ $book->book_id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="book-icon me-2 text-primary">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $book->book_title }}</div>
                                            <small class="text-muted">ISBN: {{ $book->ISBN }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $book->author }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $book->category->classname }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $book->book_copies }}</span>
                                </td>
                                <td>
                                    @if($book->status == 'Available')
                                        <span class="badge bg-success">Available</span>
                                    @elseif($book->status == 'Borrowed')
                                        <span class="badge bg-warning">Borrowed</span>
                                    @else
                                        <span class="badge bg-danger">{{ $book->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('books.show', $book->book_id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('books.edit', $book->book_id) }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Edit Book">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('books.destroy', $book->book_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete Book" onclick="return confirm('Are you sure you want to delete this book?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                        <h5>No books found</h5>
                                        <p class="text-muted">Try adding a new book to your collection</p>
                                        <a href="{{ route('books.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus me-2"></i>Add New Book
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Initialize tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endsection
