@extends('layouts.app')

@section('content')
    <!-- Page header with actions -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-tags text-primary me-2"></i>Categories</h2>
            <p class="text-muted">Manage book categories in your library</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Category
        </a>
    </div>

    <!-- Search and filter row -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <form action="{{ route('categories.index') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control" name="search" placeholder="Search categories..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories list -->
    <div class="card">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Categories</h5>
                <span class="badge bg-primary">{{ count($categories) }} Categories</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Category Name</th>
                            <th class="text-center">Books</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="ps-4">{{ $category->category_id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="category-icon bg-light rounded-circle p-2 me-3">
                                            <i class="fas fa-folder text-primary"></i>
                                        </span>
                                        <span>{{ $category->classname }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $category->books->count() }}</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('categories.show', $category->category_id) }}" class="btn btn-sm btn-outline-info me-1" data-bs-toggle="tooltip" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category->category_id) }}" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="tooltip" title="Edit Category">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete Category">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                        <h5>No categories found</h5>
                                        <p class="text-muted">Start by adding a new category to organize your books</p>
                                        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus me-2"></i>Add First Category
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
