@extends('layouts.app')

@section('content')
    <!-- Back button and actions row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Books
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('books.edit', $book->book_id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Book
            </a>
            <form action="{{ route('books.destroy', $book->book_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Book Details Card -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Book Information</h5>
                <span class="badge {{ $book->status == 'Available' ? 'bg-success' : ($book->status == 'Borrowed' ? 'bg-warning' : 'bg-danger') }}">
                    {{ $book->status }}
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Book Title and Main Info -->
                <div class="col-md-12 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="book-icon p-3 bg-primary bg-opacity-10 rounded-circle me-4">
                            <i class="fas fa-book fa-3x text-primary"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">{{ $book->book_title }}</h3>
                            <p class="text-muted mb-2">By {{ $book->author }}</p>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge bg-info text-dark">{{ $book->category->classname }}</span>
                                <span class="badge bg-secondary">{{ $book->book_copies }} Copies</span>
                                <span class="text-muted">ISBN: {{ $book->ISBN }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Book Details in Two Columns -->
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">Publication Details</h6>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="ps-0" style="width: 40%">Publisher:</th>
                                        <td>{{ $book->publisher_name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0">Publication:</th>
                                        <td>{{ $book->book_pub }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0">Copyright Year:</th>
                                        <td>{{ $book->copyright_year }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">Library Information</h6>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="ps-0" style="width: 40%">Book ID:</th>
                                        <td>{{ $book->book_id }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0">Date Received:</th>
                                        <td>{{ $book->date_receiver ? date('F j, Y', strtotime($book->date_receiver)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0">Date Added:</th>
                                        <td>{{ $book->date_added ? date('F j, Y', strtotime($book->date_added)) : 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Return History Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-history me-2 text-primary"></i>Book Return History</h5>
            <span class="badge bg-primary">{{ count($book->bookReturnDetails) }} Records</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Borrow ID</th>
                            <th>Status</th>
                            <th>Return Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($book->bookReturnDetails as $return)
                            <tr>
                                <td>{{ $return->borrow_detail_id }}</td>
                                <td>{{ $return->borrow_id }}</td>
                                <td>
                                    @if($return->borrow_status == 'Returned')
                                        <span class="badge bg-success">Returned</span>
                                    @elseif($return->borrow_status == 'Damaged')
                                        <span class="badge bg-danger">Damaged</span>
                                    @else
                                        <span class="badge bg-warning">{{ $return->borrow_status }}</span>
                                    @endif
                                </td>
                                <td>{{ date('F j, Y', strtotime($return->date_return)) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('book-returns.show', $return->borrow_detail_id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                        <h5>No return records</h5>
                                        <p class="text-muted">This book has not been borrowed or returned yet</p>
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
