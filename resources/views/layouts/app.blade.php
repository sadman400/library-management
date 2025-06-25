<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
            --sidebar-width: 250px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-text);
            min-height: 100vh;
            padding: 0;
            margin: 0;
        }
        
        /* Layout */
        .main-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 0.5rem 1rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 1.5rem;
        }
        
        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar-brand i {
            font-size: 1.8rem;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Content Area */
        .content-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }
        
        /* Cards & UI Elements */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Tables */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .table th {
            font-weight: 600;
            color: var(--primary-color);
            border-bottom-width: 1px;
        }
        
        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
            transform: translateY(-2px);
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }
        
        .btn-danger {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }
        
        /* Forms */
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #495057;
        }
        
        /* Alerts */
        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .alert-success {
            background-color: rgba(76, 201, 240, 0.2);
            color: #0077b6;
        }
        
        .alert-danger {
            background-color: rgba(247, 37, 133, 0.2);
            color: #c9184a;
        }
        
        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
            border-radius: 6px;
        }
        
        /* Action Buttons */
        .btn-outline-primary, .btn-outline-secondary, .btn-outline-danger {
            border-width: 1.5px;
            transition: all 0.2s ease;
        }
        
        .btn-outline-primary:hover, .btn-outline-secondary:hover, .btn-outline-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }
        
        .rounded-pill {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .gap-2 {
            gap: 0.75rem !important;
        }
        
        /* Page Headers */
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-header h2 {
            }
            
            .sidebar-brand {
                font-size: 1.5rem;
                font-weight: 600;
                color: white;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .sidebar-brand i {
                font-size: 1.8rem;
            }
            
            .sidebar .nav-link {
                color: rgba(255, 255, 255, 0.85);
                border-radius: 8px;
                margin-bottom: 0.5rem;
                padding: 0.75rem 1rem;
                transition: all 0.3s ease;
                font-weight: 500;
            }
            
            .sidebar .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.1);
                color: white;
                transform: translateX(5px);
            }
            
            .sidebar .nav-link.active {
                background-color: rgba(255, 255, 255, 0.2);
                color: white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            
            .sidebar .nav-link i {
                margin-right: 10px;
                width: 20px;
                text-align: center;
            }
            
            /* Content Area */
            .content-wrapper {
                flex: 1;
                margin-left: var(--sidebar-width);
                padding: 2rem;
                transition: all 0.3s ease;
            }
            
            /* Cards & UI Elements */
            .card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                margin-bottom: 1.5rem;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-brand">
                    <i class="fas fa-book-reader"></i>
                    <span>Library MS</span>
                </a>
            </div>
            <ul class="nav flex-column">
                <!-- Dashboard -->                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') || request()->is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                
                <!-- Library Resources -->                
                <li class="nav-header mt-3 mb-2 ps-3 text-uppercase">
                    <small class="text-white-50">Library Resources</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('books*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                        <i class="fas fa-book"></i> Books
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="fas fa-list-alt"></i> Categories
                    </a>
                </li>
                
                <!-- People Management -->                
                <li class="nav-header mt-3 mb-2 ps-3 text-uppercase">
                    <small class="text-white-50">People Management</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('members*') ? 'active' : '' }}" href="{{ route('members.index') }}">
                        <i class="fas fa-users"></i> Members
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('usertypes*') ? 'active' : '' }}" href="{{ route('usertypes.index') }}">
                        <i class="fas fa-user-tag"></i> User Types
                    </a>
                </li>
                
                <!-- Transactions -->                
                <li class="nav-header mt-3 mb-2 ps-3 text-uppercase">
                    <small class="text-white-50">Transactions</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('book-issuances*') ? 'active' : '' }}" href="{{ route('book-issuances.index') }}">
                        <i class="fas fa-clipboard-list"></i> Book Issuances
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('book-returns*') ? 'active' : '' }}" href="{{ route('book-returns.index') }}">
                        <i class="fas fa-undo-alt"></i> Book Returns
                    </a>
                </li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <div class="content-wrapper">
            <!-- Mobile Toggle Button (only visible on small screens) -->
            <div class="d-lg-none mb-4">
                <button class="btn btn-primary" id="sidebar-toggle">
                    <i class="fas fa-bars"></i> Menu
                </button>
            </div>
            
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle && sidebarToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });
            
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>
