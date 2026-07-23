<x-layout title="PIXL - Feed">

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
        <x-post-form />
        {{-- @include('partials.post-form', [
                'labelText' => 'Post body',
                'fieldName' => 'post',
                'placeholder' => "What's up _adrian?",
            ]) --}}

        <!-- Feed -->
        <ol class="mt-4">
            <!-- Feed items -->
            @foreach ($posts as $item)
                <x-post :post="$item" />
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

</x-layout>
