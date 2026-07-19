<!-- Aside -->
<aside class="my-4 hidden w-80 shrink-0 overflow-y-auto px-0.5 lg:block">
    <input type="text" placeholder="#Search an idea or pixl" class="w-full text-sm" />
    <hr class="border-pixl-light/10 mt-2" />

    <!-- ِArtists to follow -->
    <x-artists-to-follow />

    <!-- Follow idea streams -->
    <div class="border-pixl-light/10 mt-4 border p-4">
        <h2 class="text-pixl-light/60 text-sm">Follow idea streams</h2>
        <ol class="mt-4 flex flex-col gap-2.5">
            <li class="flex items-center justify-between gap-4">
                <p class="truncate text-sm">Breakfast ideas and whatever</p>
                <button
                    class="bg-pixl-dark/50 border-pixl/50 hover:bg-pixl-dark/60 hover:border-pixl/60 active:bg-pixl-dark/75 active:border-pixl/75 text-pixl border px-1.5 py-0.5 text-2xl leading-none">
                    +
                </button>
            </li>
            <li class="flex items-center justify-between gap-4">
                <p class="truncate text-sm">Quick book to read</p>
                <button
                    class="bg-pixl-dark/50 border-pixl/50 hover:bg-pixl-dark/60 hover:border-pixl/60 active:bg-pixl-dark/75 active:border-pixl/75 text-pixl border px-1.5 py-0.5 text-2xl leading-none">
                    +
                </button>
            </li>
            <li class="flex items-center justify-between gap-4">
                <p class="truncate text-sm">Inspiration for Art</p>
                <button
                    class="bg-pixl-dark/50 border-pixl/50 hover:bg-pixl-dark/60 hover:border-pixl/60 active:bg-pixl-dark/75 active:border-pixl/75 text-pixl border px-1.5 py-0.5 text-2xl leading-none">
                    +
                </button>
            </li>
        </ol>
        <a href="#" class="text-pixl-light/60 mt-4 inline-block text-xs">Show more</a>
    </div>
</aside>
