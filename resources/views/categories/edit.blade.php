@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Category</h2>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Categories
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->category_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="classname" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('classname') is-invalid @enderror" id="classname" name="classname" value="{{ old('classname', $category->classname) }}" required>
                    @error('classname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        </div>
    </div>
@endsection
