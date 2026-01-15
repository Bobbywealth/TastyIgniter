<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script defer src="https://unpkg.com/lucide@latest"></script>

<div class="min-h-screen bg-[#0a0a0a] flex items-center justify-center p-6 mesh-gradient overflow-hidden relative">
    <!-- Background Accents -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-[#ff4d4d]/10 rounded-full blur-[128px] animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-[#ff4d4d]/5 rounded-full blur-[128px]"></div>
    </div>

    <div class="max-w-md w-full relative z-10">
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 mb-6">
                <div class="bg-[#ff4d4d] p-2 rounded-xl shadow-lg shadow-[#ff4d4d]/20">
                    <i data-lucide="zap" class="w-8 h-8 text-white fill-current"></i>
                </div>
                <span class="text-3xl font-black tracking-tighter text-white uppercase">SASHEY'S KITCHEN</span>
            </div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Welcome Back</h2>
            <p class="text-gray-400 mt-2">Enter your credentials to access the pack</p>
        </div>

        <div class="bg-[#161616]/80 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-2xl">
            {!! form_open([
                'id' => 'edit-form',
                'role' => 'form',
                'method' => 'POST',
            ]) !!}
                <div class="space-y-6">
                    <div>
                        <label for="input-email" class="block text-sm font-medium text-gray-400 mb-2 ml-1">
                            @lang('igniter.user::default.login.label_email')
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-[#ff4d4d] transition-colors">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <input name="email" type="email" id="input-email" 
                                class="w-full bg-[#0a0a0a] border border-[#262626] text-white rounded-xl pl-12 pr-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#ff4d4d]/50 focus:border-[#ff4d4d] transition-all"
                                placeholder="name@example.com"
                            />
                        </div>
                        {!! form_error('email', '<p class="mt-2 text-sm text-red-500 flex items-center gap-1"><i data-lucide="alert-circle" class="w-4 h-4"></i> ', '</p>') !!}
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label for="input-password" class="text-sm font-medium text-gray-400">
                                @lang('igniter.user::default.login.label_password')
                            </label>
                            <a href="{{ admin_url('login/reset') }}" class="text-xs text-[#ff4d4d] hover:text-[#e60000] transition-colors font-semibold">
                                @lang('igniter.user::default.login.text_forgot_password')
                            </a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-[#ff4d4d] transition-colors">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input name="password" type="password" id="input-password" 
                                class="w-full bg-[#0a0a0a] border border-[#262626] text-white rounded-xl pl-12 pr-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#ff4d4d]/50 focus:border-[#ff4d4d] transition-all"
                                placeholder="••••••••"
                            />
                        </div>
                        {!! form_error('password', '<p class="mt-2 text-sm text-red-500 flex items-center gap-1"><i data-lucide="alert-circle" class="w-4 h-4"></i> ', '</p>') !!}
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#ff4d4d] hover:bg-[#e60000] text-white font-bold py-4 rounded-xl shadow-lg shadow-[#ff4d4d]/20 transition-all duration-300 active:scale-[0.98] flex items-center justify-center gap-3 group"
                        data-attach-loading=""
                    >
                        <span>@lang('igniter.user::default.login.button_login')</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            {!! form_close() !!}
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Sashey's Kitchen. All rights reserved.
            </p>
        </div>
    </div>
</div>

<style>
    .mesh-gradient {
        background-color: #0a0a0a;
        background-image: 
            radial-gradient(at 0% 0%, hsla(0,100%,70%,0.05) 0, transparent 50%), 
            radial-gradient(at 100% 100%, hsla(0,100%,70%,0.05) 0, transparent 50%);
    }
</style>

<script>
    // Initialize icons if not already done
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
