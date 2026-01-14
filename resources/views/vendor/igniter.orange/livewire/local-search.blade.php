<div class="local-search">
    <form
        method="POST"
        role="form"
        data-request="{{ $searchEventHandler }}"
    >
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-gray-500 group-focus-within:text-primary transition-colors">
                <i data-lucide="map-pin" class="w-6 h-6"></i>
            </div>
            <input
                type="text"
                name="search_query"
                class="w-full bg-dark-bg border border-dark-border text-white rounded-2xl pl-16 pr-32 py-5 focus:outline-none focus:ring-4 focus:ring-primary/20 focus:border-primary transition-all text-lg shadow-2xl"
                placeholder="Enter your delivery address..."
                value="{{ $searchQuery }}"
            >
            <button
                type="submit"
                class="absolute right-3 top-3 bottom-3 bg-primary hover:bg-primary-hover text-white px-8 rounded-xl font-bold transition-all active:scale-95 shadow-lg shadow-primary/20 flex items-center gap-2"
            >
                GO <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </button>
        </div>
    </form>
</div>
