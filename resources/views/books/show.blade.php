@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Book Details</h2>
        <div>
            <a href="{{ route('books.edit', $book->book_id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Books
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
                            <td>{{ $book->book_id }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $book->book_title }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $book->category->classname }}</td>
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                            <th>Number of Copies</th>
                            <td>{{ $book->book_copies }}</td>
                        </tr>
                        <tr>
                            <th>Publication</th>
                            <td>{{ $book->book_pub }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Publisher</th>
                            <td>{{ $book->publisher_name }}</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>{{ $book->ISBN }}</td>
                        </tr>
                        <tr>
                            <th>Copyright Year</th>
                            <td>{{ $book->copyright_year }}</td>
                        </tr>
                        <tr>
                            <th>Date Received</th>
                            <td>{{ $book->date_receiver ? date('F j, Y', strtotime($book->date_receiver)) : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Date Added</th>
                            <td>{{ $book->date_added ? date('F j, Y', strtotime($book->date_added)) : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $book->status == 'Available' ? 'bg-success' : ($book->status == 'Borrowed' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $book->status }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h3>Book Return History</h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Borrow ID</th>
                                <th>Status</th>
                                <th>Return Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($book->bookReturnDetails as $return)
                                <tr>
                                    <td>{{ $return->borrow_detail_id }}</td>
                                    <td>{{ $return->borrow_id }}</td>
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
                                    <td colspan="5" class="text-center">No return records found for this book.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
