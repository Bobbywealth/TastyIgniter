<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sashey's Kitchen | Elite SMS Marketing Solutions</title>
    <meta name="vapi-public-key" content="{{ config('services.vapi.public_key') }}">
    <meta name="vapi-assistant-id" content="{{ config('services.vapi.assistant_id') }}">
    <meta name="vapi-metadata" content='@json(["source" => "marketing_page"])'>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
        
        .mesh-gradient {
            background-color: #0a0a0a;
            background-image: 
                radial-gradient(at 0% 0%, hsla(0,100%,70%,0.15) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(0,100%,70%,0.1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(0,100%,70%,0.15) 0, transparent 50%);
        }

        .glass {
            background: rgba(22, 22, 22, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .text-gradient {
            background: linear-gradient(to right, #fff, #999);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-dark-bg font-sans selection:bg-primary selection:text-white">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-2">
                    <div class="bg-primary p-1.5 rounded-lg">
                        <i data-lucide="zap" class="w-6 h-6 text-white fill-current"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tighter text-white">SASHEY'S KITCHEN</span>
                </div>
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">How it Works</a>
                    <a href="#subscribe" class="btn-primary py-2 text-sm">Join our Kitchen</a>
                </div>
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-400 hover:text-white transition-colors">
                        <i data-lucide="menu" x-show="!mobileMenuOpen"></i>
                        <i data-lucide="x" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden glass border-t border-white/10" x-cloak>
            <div class="px-4 py-6 space-y-4">
                <a href="#features" @click="mobileMenuOpen = false" class="block text-lg font-medium text-gray-300 hover:text-white">Features</a>
                <a href="#how-it-works" @click="mobileMenuOpen = false" class="block text-lg font-medium text-gray-300 hover:text-white">How it Works</a>
                <a href="#subscribe" @click="mobileMenuOpen = false" class="block btn-primary text-center">Join our Kitchen</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative min-h-screen flex items-center pt-20 mesh-gradient overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary/20 rounded-full blur-[128px] animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-primary/10 rounded-full blur-[128px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary text-xs font-bold tracking-widest uppercase mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                    The Future of Engagement
                </div>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white leading-tight mb-8 tracking-tight">
                    Scale Your Business with <span class="text-primary">SMS Alpha</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Connect with your customers instantly. <span class="text-white font-semibold">98% open rates</span> that drive real revenue, not just clicks.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="#subscribe" class="btn-primary w-full sm:w-auto text-lg flex items-center justify-center gap-2">
                        Start Growing Now
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                    <div class="flex items-center gap-3">
                        <button type="button" id="vapi-start" class="btn-outline w-full sm:w-auto flex items-center justify-center gap-2 group">
                            <i data-lucide="phone" class="w-5 h-5 group-hover:animate-bounce"></i>
                            Speak with AI Agent
                        </button>
                        <button type="button" id="vapi-stop" class="p-3 border border-red-900/50 bg-red-950/20 text-red-500 rounded-lg hidden disabled:opacity-0 transition-all duration-300" disabled>
                            <i data-lucide="phone-off" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>
                <div class="mt-8 flex flex-col items-center">
                    <div id="vapi-status" class="text-xs font-mono uppercase tracking-widest text-gray-500 bg-dark-surface px-4 py-2 rounded-full border border-dark-border">
                        System Ready
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="py-20 border-y border-dark-border bg-dark-surface/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">98%</div>
                    <div class="text-sm text-gray-500 uppercase tracking-widest">Open Rate</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">3s</div>
                    <div class="text-sm text-gray-500 uppercase tracking-widest">Avg Delivery</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">45%</div>
                    <div class="text-sm text-gray-500 uppercase tracking-widest">Conversion</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">10x</div>
                    <div class="text-sm text-gray-500 uppercase tracking-widest">ROI vs Email</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Built for Performance</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">Our platform is designed to get your messages seen and acted upon instantly.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="card group">
                    <div class="w-14 h-14 bg-primary/10 border border-primary/20 rounded-xl flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                        <i data-lucide="rocket" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-white mb-4">Instant Delivery</h4>
                    <p class="text-gray-400 leading-relaxed text-lg">Messages reach your audience in seconds, ensuring your offers are seen exactly when you want them to be.</p>
                </div>
                
                <div class="card group">
                    <div class="w-14 h-14 bg-primary/10 border border-primary/20 rounded-xl flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                        <i data-lucide="bar-chart-3" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-white mb-4">High Engagement</h4>
                    <p class="text-gray-400 leading-relaxed text-lg">With 98% open rates, SMS outperforms email and social media marketing by a massive margin.</p>
                </div>

                <div class="card group">
                    <div class="w-14 h-14 bg-primary/10 border border-primary/20 rounded-xl flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                        <i data-lucide="target" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-white mb-4">Targeted Reach</h4>
                    <p class="text-gray-400 leading-relaxed text-lg">Reach your most loyal customers directly on the device they use most—their mobile phone.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-32 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/2">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-8">Go Live in <span class="text-primary">Minutes</span></h2>
                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-dark-surface border border-dark-border flex items-center justify-center text-primary font-bold text-xl">1</div>
                            <div>
                                <h5 class="text-xl font-bold text-white mb-2">Connect Your Data</h5>
                                <p class="text-gray-400">Sync your customer list securely with our API or upload via CSV in seconds.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-dark-surface border border-dark-border flex items-center justify-center text-primary font-bold text-xl">2</div>
                            <div>
                                <h5 class="text-xl font-bold text-white mb-2">Craft Your Message</h5>
                                <p class="text-gray-400">Use our AI-assisted editor to create high-converting copy that resonates with your audience.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-dark-surface border border-dark-border flex items-center justify-center text-primary font-bold text-xl">3</div>
                            <div>
                                <h5 class="text-xl font-bold text-white mb-2">Launch & Scale</h5>
                                <p class="text-gray-400">Hit send and watch your engagement metrics skyrocket in real-time on our dashboard.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 relative">
                    <div class="glass p-4 rounded-3xl border border-white/10 animate-float">
                        <div class="bg-black rounded-2xl overflow-hidden p-6 border border-white/5">
                            <div class="flex items-center gap-3 mb-6 border-b border-white/10 pb-4">
                                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                                    <i data-lucide="user" class="w-5 h-5 text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-white font-bold text-sm">Sashey's Kitchen SMS</div>
                                    <div class="text-green-500 text-xs flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        Delivered
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-dark-surface p-4 rounded-2xl rounded-tl-none border border-dark-border max-w-[80%]">
                                    <p class="text-sm text-gray-200">Hey John! Your exclusive 40% OFF code is: <span class="text-primary font-mono font-bold">WOLF40</span>. Only valid for the next 2 hours! 🐺🔥</p>
                                </div>
                                <div class="text-[10px] text-gray-600 ml-1">Read 2:14 PM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscription Form -->
    <section id="subscribe" class="py-32 bg-dark-surface/30">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass p-8 md:p-12 rounded-3xl border border-primary/20 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <i data-lucide="utensils" class="w-32 h-32"></i>
                </div>
                
                <div class="relative z-10">
                    <h3 class="text-3xl md:text-4xl font-bold text-white text-center mb-4">Join Sashey's Kitchen</h3>
                    <p class="text-gray-400 text-center mb-10">Start your 14-day free trial. No credit card required.</p>
                    
                    @if(session('success'))
                        <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-xl flex items-center gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-8 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl">
                            <ul class="space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="flex items-center gap-2">
                                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('marketing.subscribe') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-medium text-gray-400 ml-1">Full Name</label>
                                <input type="text" name="name" class="input-field w-full" id="name" placeholder="John Doe" required value="{{ old('name') }}">
                            </div>
                            <div class="space-y-2">
                                <label for="phone_number" class="text-sm font-medium text-gray-400 ml-1">Phone Number</label>
                                <input type="tel" name="phone_number" class="input-field w-full" id="phone_number" placeholder="+1 (555) 000-0000" required value="{{ old('phone_number') }}">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-gray-400 ml-1">Email Address (Optional)</label>
                            <input type="email" name="email" class="input-field w-full" id="email" placeholder="john@example.com" value="{{ old('email') }}">
                        </div>
                        <button type="submit" class="btn-primary w-full py-4 text-lg">
                            Get Started Now
                        </button>
                        <p class="text-gray-500 text-xs text-center mt-6">
                            By joining, you agree to our <a href="#" class="underline">Terms</a> and <a href="#" class="underline">Privacy Policy</a>.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-20 border-t border-dark-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center gap-2 mb-8">
                <div class="bg-primary p-1.5 rounded-lg">
                    <i data-lucide="zap" class="w-5 h-5 text-white fill-current"></i>
                </div>
                <span class="text-xl font-black tracking-tighter text-white uppercase">SASHEY'S KITCHEN</span>
            </div>
            <p class="text-gray-500 text-sm mb-8 max-w-md mx-auto">
                Empowering businesses with elite SMS marketing solutions that drive real engagement and growth.
            </p>
            <div class="flex justify-center gap-8 mb-12">
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i data-lucide="twitter" class="w-5 h-5"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i data-lucide="instagram" class="w-5 h-5"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i data-lucide="linkedin" class="w-5 h-5"></i>
                </a>
            </div>
            <div class="text-gray-600 text-xs">
                &copy; 2026 Sashey's Kitchen Marketing. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
    <script src="{{ asset('js/marketing-vapi.js') }}"></script>
</body>
</html>
