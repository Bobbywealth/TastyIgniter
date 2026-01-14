---
title: Sashey's Kitchen | Premium Dining
description: 'Experience the finest cuisine from Sashey\'s Kitchen. Order online for delivery or pickup.'
permalink: /
layout: default

'[igniter-orange::featured-items]': []
---
<div class="relative overflow-hidden pt-12 pb-24 md:pt-20 md:pb-32">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-[128px] animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-primary/5 rounded-full blur-[128px]"></div>
    </div>

    <div class="container relative z-10">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="mb-4 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary text-xs font-bold tracking-widest uppercase">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                    Now Serving Excellence
                </div>
                <h1 class="text-6xl md:text-8xl font-black text-white leading-tight mb-8 tracking-tighter">
                    Taste the <span class="text-primary">Extraordinary</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-400 mb-12 max-w-xl leading-relaxed">
                    Crafting unforgettable culinary experiences delivered straight to your door. Experience Sashey's Kitchen today.
                </p>
                
                <div class="card p-4 border-white/5 bg-white/5 backdrop-blur-xl mb-12">
                    <div class="row align-items-center g-3">
                        <div class="col-md-8">
                            <livewire:igniter-orange::local-search/>
                        </div>
                        <div class="col-md-4">
                            <p class="text-xs text-gray-500 mb-0 px-2">Enter your address to check delivery availability.</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-8 items-center">
                    <div class="flex items-center gap-3">
                        <div class="text-3xl font-bold text-white">4.9/5</div>
                        <div class="text-xs text-gray-500 uppercase tracking-widest">Customer<br>Rating</div>
                    </div>
                    <div class="w-px h-10 bg-white/10"></div>
                    <div class="flex items-center gap-3">
                        <div class="text-3xl font-bold text-white">30m</div>
                        <div class="text-xs text-gray-500 uppercase tracking-widest">Average<br>Delivery</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="relative">
                    <div class="absolute -inset-4 bg-primary/20 rounded-full blur-3xl animate-pulse"></div>
                    <div class="relative glass rounded-3xl overflow-hidden border border-white/10 p-4 transform rotate-3 hover:rotate-0 transition-all duration-700">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=60" alt="Delicious Food" class="w-full h-auto rounded-2xl shadow-2xl" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-24 border-t border-white/5">
    <div class="container">
        <div class="row text-center mb-16">
            <div class="col-12">
                <h2 class="text-4xl font-bold text-white mb-4">Our Signature Menu</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Explore our chef-curated selection of premium dishes made with only the freshest local ingredients.</p>
            </div>
        </div>
        
        <x-igniter-orange::featured-items/>
        
        <div class="text-center mt-16">
            <a href="{{ page_url('local/menus') }}" class="btn-primary px-8 py-4 text-lg inline-flex items-center gap-2 text-decoration-none">
                View Full Menu
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
</div>
