<div class="py-12 bg-[#0a0a0a]">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <a class="navbar-brand d-flex items-center gap-2 mb-6" href="{{ page_url('home') }}">
                    <div class="bg-primary p-1.5 rounded-lg">
                        <i data-lucide="zap" class="w-6 h-6 text-white fill-current"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tighter text-white uppercase">SASHEY'S KITCHEN</span>
                </a>
                <p class="text-gray-500 mb-8 max-w-sm">
                    Crafting premium culinary experiences with locally sourced ingredients. Join us for a journey of taste and excellence.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-primary/20 transition-all">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-primary/20 transition-all">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-primary/20 transition-all">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <h5 class="text-white font-bold mb-6">Quick Links</h5>
                <x-igniter-orange::nav code="footer-menu" />
                <ul class="list-unstyled mt-4 space-y-4">
                    <li><a href="{{ page_url('local/menus') }}" class="text-gray-500 hover:text-white text-decoration-none">Our Menu</a></li>
                    <li><a href="{{ page_url('account/login') }}" class="text-gray-500 hover:text-white text-decoration-none">My Account</a></li>
                    <li><a href="{{ page_url('contact') }}" class="text-gray-500 hover:text-white text-decoration-none">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-4">
                <div id="newsletter-box">
                    <h5 class="text-white font-bold mb-6">Join Our Newsletter</h5>
                    <p class="text-gray-500 mb-6">Stay updated with our latest dishes and exclusive offers.</p>
                    <livewire:igniter-orange::newsletter-subscribe-form />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <hr class="my-12 border-white/5">
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <div class="text-gray-600 text-sm">
                    &copy; {{ date('Y') }} Sashey's Kitchen. All rights reserved.
                </div>
            </div>
            <div class="col-md-6 text-center text-md-end mt-4 mt-md-0">
                <div class="flex justify-center justify-md-end gap-6">
                    <a href="#" class="text-gray-600 hover:text-white text-xs text-decoration-none uppercase tracking-widest">Privacy Policy</a>
                    <a href="#" class="text-gray-600 hover:text-white text-xs text-decoration-none uppercase tracking-widest">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</div>
