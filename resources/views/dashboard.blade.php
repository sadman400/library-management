@extends('layouts.app')

@section('content')
    <!-- Dashboard header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="mb-1"><i class="fas fa-tachometer-alt text-primary me-2"></i>Dashboard</h2>
            <div class="d-flex align-items-center">
                <p class="text-muted mb-0">Welcome to the Library Management System</p>
                <span class="ms-3 badge bg-light text-dark">
                    <i class="far fa-calendar-alt me-1"></i> {{ date('F d, Y') }}
                </span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('books.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Add a new book to the library">
                <i class="fas fa-book me-2"></i>Add New Book
            </a>
            <a href="{{ route('members.create') }}" class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Register a new library member">
                <i class="fas fa-user-plus me-2"></i>Add Member
            </a>
        </div>
    </div>

    <!-- Stats cards -->
    <div class="row mb-4">
        <!-- Total Books -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow-sm h-100 stat-card" data-color="primary">
                <div class="card-body position-relative p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1 fw-light">Total Books</h6>
                            <h3 class="mb-0 fw-bold counter-value">{{ $totalBooks }}</h3>
                        </div>
                        <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                            <i class="fas fa-book fa-fw"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top">
                        <a href="{{ route('books.index') }}" class="text-decoration-none text-primary d-flex align-items-center">
                            <span>View all books</span> <i class="fas fa-arrow-right ms-2 card-arrow"></i>
                        </a>
                    </div>
                    <div class="position-absolute opacity-10 bottom-0 end-0 mb-2 me-2 card-bg-icon">
                        <i class="fas fa-book fa-4x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Members -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow-sm h-100 stat-card" data-color="success">
                <div class="card-body position-relative p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1 fw-light">Total Members</h6>
                            <h3 class="mb-0 fw-bold counter-value">{{ $totalMembers }}</h3>
                        </div>
                        <div class="icon-shape bg-success bg-opacity-10 text-success rounded-circle p-3">
                            <i class="fas fa-users fa-fw"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top">
                        <a href="{{ route('members.index') }}" class="text-decoration-none text-success d-flex align-items-center">
                            <span>View all members</span> <i class="fas fa-arrow-right ms-2 card-arrow"></i>
                        </a>
                    </div>
                    <div class="position-absolute opacity-10 bottom-0 end-0 mb-2 me-2 card-bg-icon">
                        <i class="fas fa-users fa-4x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books Borrowed -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow-sm h-100 stat-card" data-color="warning">
                <div class="card-body position-relative p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1 fw-light">Books Borrowed</h6>
                            <h3 class="mb-0 fw-bold counter-value">{{ $borrowedBooks }}</h3>
                        </div>
                        <div class="icon-shape bg-warning bg-opacity-10 text-warning rounded-circle p-3">
                            <i class="fas fa-book-reader fa-fw"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top">
                        <a href="{{ route('book-issuances.index') }}" class="text-decoration-none text-warning d-flex align-items-center">
                            <span>View all issuances</span> <i class="fas fa-arrow-right ms-2 card-arrow"></i>
                        </a>
                    </div>
                    <div class="position-absolute opacity-10 bottom-0 end-0 mb-2 me-2 card-bg-icon">
                        <i class="fas fa-book-reader fa-4x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow-sm h-100 stat-card" data-color="info">
                <div class="card-body position-relative p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1 fw-light">Categories</h6>
                            <h3 class="mb-0 fw-bold counter-value">{{ $totalCategories }}</h3>
                        </div>
                        <div class="icon-shape bg-info bg-opacity-10 text-info rounded-circle p-3">
                            <i class="fas fa-folder fa-fw"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top">
                        <a href="{{ route('categories.index') }}" class="text-decoration-none text-info d-flex align-items-center">
                            <span>View all categories</span> <i class="fas fa-arrow-right ms-2 card-arrow"></i>
                        </a>
                    </div>
                    <div class="position-absolute opacity-10 bottom-0 end-0 mb-2 me-2 card-bg-icon">
                        <i class="fas fa-folder fa-4x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent activities and quick actions -->
    <div class="row">
        <!-- Recent book issuances -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-clock text-primary me-2"></i>Recent Book Issuances</h5>
                        <a href="{{ route('book-issuances.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt me-1"></i> View All
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Book</th>
                                    <th>Member</th>
                                    <th>Borrow Date</th>
                                    <th>Due Date</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentIssuances as $issuance)
                                    <tr>
                                        <td class="ps-4 fw-bold text-primary">{{ $issuance->borrow_id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-book text-primary me-2"></i>
                                                <span class="text-truncate" style="max-width: 150px;" title="{{ $issuance->book->book_title }}">
                                                    {{ $issuance->book->book_title }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    @if($issuance->member->gender == 'Male')
                                                        <i class="fas fa-user text-primary"></i>
                                                    @else
                                                        <i class="fas fa-user text-danger"></i>
                                                    @endif
                                                </div>
                                                {{ $issuance->member->firstname }} {{ $issuance->member->lastname }}
                                            </div>
                                        </td>
                                        <td><i class="far fa-calendar-alt me-1 text-muted"></i> {{ date('M d, Y', strtotime($issuance->date_borrow)) }}</td>
                                        <td><i class="far fa-calendar-check me-1 text-muted"></i> {{ date('M d, Y', strtotime($issuance->due_date)) }}</td>
                                        <td class="text-end pe-4">
                                            @php
                                                $today = new DateTime();
                                                $dueDate = new DateTime($issuance->due_date);
                                                $isOverdue = $today > $dueDate;
                                            @endphp
                                            
                                            @if($isOverdue)
                                                <span class="badge bg-danger">Overdue</span>
                                            @else
                                                <span class="badge bg-warning">Borrowed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center py-4">
                                                <div class="bg-light p-4 rounded-circle mb-3">
                                                    <i class="fas fa-book-reader fa-3x text-muted"></i>
                                                </div>
                                                <h5>No recent book issuances</h5>
                                                <p class="text-muted">Books that are borrowed will appear here</p>
                                                <a href="{{ route('book-issuances.create') }}" class="btn btn-sm btn-primary mt-2">
                                                    <i class="fas fa-plus me-1"></i> Issue a Book
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
        </div>

        <!-- Quick actions and info -->
        <div class="col-lg-4 mb-4">
            <!-- Quick actions -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-bolt text-primary me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('book-issuances.create') }}" class="btn btn-outline-primary d-flex flex-column align-items-center p-3 h-100 w-100" data-bs-toggle="tooltip" title="Issue a book to a member">
                                <i class="fas fa-book-reader fa-2x mb-2"></i>
                                <span>Issue Book</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('book-returns.create') }}" class="btn btn-outline-success d-flex flex-column align-items-center p-3 h-100 w-100" data-bs-toggle="tooltip" title="Process a book return">
                                <i class="fas fa-undo fa-2x mb-2"></i>
                                <span>Return Book</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('books.create') }}" class="btn btn-outline-info d-flex flex-column align-items-center p-3 h-100 w-100" data-bs-toggle="tooltip" title="Add a new book to the library">
                                <i class="fas fa-book-medical fa-2x mb-2"></i>
                                <span>Add Book</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('members.create') }}" class="btn btn-outline-warning d-flex flex-column align-items-center p-3 h-100 w-100" data-bs-toggle="tooltip" title="Register a new library member">
                                <i class="fas fa-user-plus fa-2x mb-2"></i>
                                <span>Add Member</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System info -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle text-primary me-2"></i>System Info</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush system-info-list">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <span>Books Available</span>
                            </div>
                            <span class="badge bg-success rounded-pill">{{ $availableBooks }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 p-2 rounded-circle me-3">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                </div>
                                <span>Overdue Books</span>
                            </div>
                            <span class="badge bg-danger rounded-pill">{{ $overdueBooks }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                    <i class="fas fa-user-check text-primary"></i>
                                </div>
                                <span>Active Members</span>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $activeMembers }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-2 rounded-circle me-3">
                                    <i class="fas fa-book-medical text-warning"></i>
                                </div>
                                <span>Damaged Books</span>
                            </div>
                            <span class="badge bg-warning rounded-pill">{{ $damagedBooks }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Add hover effects to cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            const color = card.getAttribute('data-color');
            const arrow = card.querySelector('.card-arrow');
            
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.1)';
                this.style.transition = 'all 0.3s ease';
                if (arrow) {
                    arrow.style.transform = 'translateX(5px)';
                    arrow.style.transition = 'transform 0.3s ease';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
                if (arrow) {
                    arrow.style.transform = '';
                }
            });
        });
        
        // Animate counters
        const counterElements = document.querySelectorAll('.counter-value');
        counterElements.forEach(counter => {
            const target = parseInt(counter.innerText);
            let count = 0;
            const duration = 1500; // Animation duration in milliseconds
            const increment = Math.ceil(target / (duration / 30)); // Update every 30ms
            
            const animateCounter = () => {
                count += increment;
                if (count >= target) {
                    counter.innerText = target;
                    return;
                }
                counter.innerText = count;
                setTimeout(animateCounter, 30);
            };
            
            // Start animation when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(counter);
        });
        
        // Add subtle pulse animation to background icons
        const bgIcons = document.querySelectorAll('.card-bg-icon');
        bgIcons.forEach(icon => {
            setInterval(() => {
                icon.style.transform = 'scale(1.05)';
                icon.style.transition = 'transform 2s ease';
                
                setTimeout(() => {
                    icon.style.transform = 'scale(1)';
                    icon.style.transition = 'transform 2s ease';
                }, 2000);
            }, 4000);
        });
    });
</script>
@endsection
