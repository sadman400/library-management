@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Category Details</h2>
        <div>
            <a href="{{ route('categories.edit', $category->category_id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th style="width: 200px;">ID</th>
                    <td>{{ $category->category_id }}</td>
                </tr>
                <tr>
                    <th>Category Name</th>
                    <td>{{ $category->classname }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <h3>Books in this Category</h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($category->books as $book)
                                <tr>
                                    <td>{{ $book->book_id }}</td>
                                    <td>{{ $book->book_title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>
                                        <span class="badge {{ $book->status == 'Available' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $book->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('books.show', $book->book_id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No books found in this category.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
