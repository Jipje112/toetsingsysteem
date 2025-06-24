<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1>hello</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 max-h-96 overflow-y-auto space-y-3 pr-2" >
                <x-links class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 max-h-96 overflow-y-auto space-y-3 pr-2">
                <x-thisfilewillbedeletedafterwardscapybara class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-6 space-y-6">
                        <h1 class="text-2xl font-bold">Toetsen</h1>

                        <!-- Add New Test -->
                        <form action="{{ route('toets.store') }}" method="POST" class="space-x-2">
                            @csrf
                            <input type="text" name="name" placeholder="Nieuwe toets naam" required class="border p-2 rounded">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Toevoegen</button>
                        </form>

                        <!-- List of Tests -->
                        <div class="max-h-96 overflow-y-auto space-y-3 pr-2">
                            @foreach ($tests as $test)
                                <div class="border p-4 rounded flex justify-between items-center">
                                    <form action="{{ route('toets.update', $test->id) }}" method="POST" class="flex space-x-2 items-center">
                                        @csrf
                                        <input type="text" name="name" value="{{ $test->name }}" class="border p-1 rounded">
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Update</button>
                                    </form>
                                    <a href="{{ route('toets.delete', $test->id) }}" class="text-red-500">Verwijder</a>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
