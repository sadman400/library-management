@extends('layouts.app')

@section('content')
    <!-- Page header with actions -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-users text-primary me-2"></i>Members</h2>
            <p class="text-muted">Manage library members and their borrowing privileges</p>
        </div>
        <a href="{{ route('members.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>Add New Member
        </a>
    </div>

    <!-- Search and filter row -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <form action="{{ route('members.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control" name="search" placeholder="Search by name or ID..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="type">
                        <option value="">All Member Types</option>
                        <option value="Student" {{ request('type') == 'Student' ? 'selected' : '' }}>Student</option>
                        <option value="Faculty" {{ request('type') == 'Faculty' ? 'selected' : '' }}>Faculty</option>
                        <option value="Staff" {{ request('type') == 'Staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="status">
                        <option value="">All Statuses</option>
                        <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Members list -->
    <div class="card">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Members</h5>
                <span class="badge bg-primary">{{ count($members) }} Members</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Member</th>
                            <th>Contact</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td class="ps-4">{{ $member->member_id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="member-avatar bg-light rounded-circle p-2 me-3 text-center" style="width: 40px; height: 40px;">
                                            <i class="fas {{ $member->gender == 'Male' ? 'fa-male' : 'fa-female' }} text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $member->firstname }} {{ $member->lastname }}</h6>
                                            <small class="text-muted">{{ $member->gender }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <i class="fas fa-phone-alt text-muted me-1"></i> {{ $member->contact }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $member->type }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $member->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $member->status }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('members.show', $member->member_id) }}" class="btn btn-sm btn-outline-info me-1" data-bs-toggle="tooltip" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('members.edit', $member->member_id) }}" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="tooltip" title="Edit Member">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('members.destroy', $member->member_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete Member">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <h5>No members found</h5>
                                        <p class="text-muted">Start by adding members to your library system</p>
                                        <a href="{{ route('members.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-user-plus me-2"></i>Add First Member
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
