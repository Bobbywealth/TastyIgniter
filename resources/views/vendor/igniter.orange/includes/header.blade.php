<nav class="navbar navbar-dark navbar-expand-md py-4">
    <div class="container">
        <a class="navbar-brand d-flex items-center gap-2" href="{{ page_url('home') }}">
            <div class="bg-primary p-1.5 rounded-lg">
                <i data-lucide="zap" class="w-6 h-6 text-white fill-current"></i>
            </div>
            <span class="text-2xl font-black tracking-tighter text-white uppercase">SASHEY'S KITCHEN</span>
        </a>
        <button
            class="navbar-toggler border-0 text-gray-400"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMainHeader"
            aria-controls="navbarMainHeader"
            aria-expanded="false"
            aria-label="Toggle navigation"
        ><i data-lucide="menu"></i></button>

        <div class="justify-content-end collapse navbar-collapse" id="navbarMainHeader">
            <x-igniter-orange::nav code="main-menu"/>
            <div class="ms-md-4 mt-3 mt-md-0">
                <a href="{{ page_url('local/menus') }}" class="btn-primary d-inline-flex items-center gap-2 text-decoration-none">
                    Order Now
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
