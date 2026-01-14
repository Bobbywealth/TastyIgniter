<div>
    @if (count($featuredItems))
        <div id="featured-menu-box" class="py-5">
            <div class="row g-4">
                @foreach ($featuredItems as $featuredItem)
                    <div class="col-sm-{{ round(12 / $itemsPerRow) }}">
                        <a class="text-decoration-none group" href="{{ $featuredItem->getUrl() }}">
                            <div class="card h-100 overflow-hidden group-hover:border-primary/50 transition-all duration-500">
                                @if ($showThumb)
                                    <div class="relative overflow-hidden aspect-[4/3]">
                                        <img
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                            src="{{ $featuredItem->getThumb([
                                                'width' => 800,
                                                'height' => 600,
                                            ]) }}" 
                                            alt="{{ $featuredItem->name }}"
                                            loading="lazy"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                                            <span class="text-white font-bold flex items-center gap-2">
                                                Order Now <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="card-body p-8">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="text-2xl font-bold text-white mb-0 group-hover:text-primary transition-colors">
                                            {{ $featuredItem->name }}
                                        </h4>
                                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-lg font-bold">
                                            {{ currency_format($featuredItem->price()) }}
                                        </span>
                                    </div>
                                    <p class="text-gray-500 leading-relaxed line-clamp-2 mb-0">
                                        {{ $featuredItem->description }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
