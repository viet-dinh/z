<div class="swiper-slide bg-center bg-cover rounded-lg overflow-hidden aspect-[2/3]">
    <a href="{{ route('story.show', $story->slug) }}"
        class="story-link block transform transition-transform hover:scale-105 h-full">
        <div class="bg-cover bg-center h-full relative rounded-lg"
            style="background-image: url('{{ asset('thumbnails/' . $story->thumbnail) }}');">
            <div class="bg-black bg-opacity-50 h-full flex flex-col justify-end p-4 rounded-lg">
                <h3 class="text-lg font-bold text-white story-title">{{ $story->title }}</h3>
                <p class="text-sm text-gray-200 story-description">{{ Str::limit($story->description, 64) }}</p>
            </div>
        </div>
    </a>
</div>
