    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1>Welcome to the Student Page</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3 mt-4">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @if(isset($tests) && count($tests))
                    <ul>
                        @foreach ($tests as $test)
                            @if ($test->name)
                                <li>{{ $test->name }}</li>
                            @else
                                <li>Unnamed test</li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <p>No tests available.</p>
                @endif
            </div>



            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
    </div>

