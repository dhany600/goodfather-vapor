<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <img class="login-page-logo mb-3" src="{{ asset('src/logo-no-background.png') }}" alt="" style="max-width: 200px; margin: 0 auto; display: block;background-color: #000;
            border-radius: 100%;">
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('src/brand/coreui.svg') }}#signet"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-speedometer"></use>
                </svg>
                Dashboard
            </a>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-money"></use>
                </svg>
                Transactions
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('transaction.index') }}">
                        <span class="nav-icon"></span>
                        Transaction List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('transaction.addTransaction') }}">
                        <span class="nav-icon"></span>
                        Add Transaction
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-user"></use>
                </svg>
                Customer
            </a>
        </li>
        @if(auth()->check() && auth()->user()->role === 'owner')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('employee.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-group"></use>
                    </svg>
                    Employee
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index') }}">
                <svg class="nav-icon-lucide" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-package">
                    <path d="m7.5 4.27 9 5.15" />
                    <path
                        d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                    <path d="m3.3 7 8.7 5 8.7-5" />
                    <path d="M12 22V12" />
                </svg>
                Product
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <svg class="nav-icon-lucide" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-grid-2x2">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M3 12h18" />
                    <path d="M12 3v18" />
                </svg>
                Category
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('activity-log.index') }}">
                <svg class="nav-icon-lucide" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-list">
                    <line x1="8" x2="21" y1="6" y2="6" />
                    <line x1="8" x2="21" y1="12" y2="12" />
                    <line x1="8" x2="21" y1="18" y2="18" />
                    <line x1="3" x2="3.01" y1="6" y2="6" />
                    <line x1="3" x2="3.01" y1="12" y2="12" />
                    <line x1="3" x2="3.01" y1="18" y2="18" />
                </svg>
                Activity Log
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
