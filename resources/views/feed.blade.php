<x-layout title="PIXL - Feed">
    <!-- Left Sidebar Navigation -->
    @include('partials.navigation')

    <!-- Content -->
    <main class="flex grow scrollbar-none flex-col gap-4 overflow-y-auto px-0.5 py-4">
        <!-- Top navigation -->
        <div class="h-full">
            <nav class="overflow-x-auto">
                <ul class="flex min-w-max justify-end gap-8 text-sm">
                    <li><a href="#">For you</a></li>
                    <li class="text-pixl-light/60 hover:text-pixl-light/80">
                        <a href="#">Idea Streams</a>
                    </li>
                    <li class="text-pixl-light/60 hover:text-pixl-light/80">
                        <a href="#">Following</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Post form -->
        <div class="border-pixl-light/10 mt-8 flex items-start gap-4 border-b pb-4">
            <a href="/profile" class="shrink-0">
                <img src="/images/adrian.png" alt="Adrian's photo" class="size-12 object-cover" />
            </a>
            @include('partials.post-form', [
                'labelText' => 'Post body',
                'fieldName' => 'post',
                'placeholder' => "What's up _adrian?",
            ])
        </div>

        <!-- Feed -->
        <ol class="mt-4">
            <!-- Feed items -->
            @foreach ($feedItems as $item)
                @include('partials.feed-item', compact('item'))
            @endforeach
        </ol>

        <!-- footer -->
        <footer class="mt-30 ml-14">
            <p class="text-center">That's all, folks!</p>
            <hr class="border-pixl-light/10 my-4" />
            <!-- White noise -->
            <div class="h-20 bg-[url(/resources/images/white-noise.gif)]"></div>
        </footer>
    </main>

    {{-- Aside --}}
    @include('partials.aside')
</x-layout>
