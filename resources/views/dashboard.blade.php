{{-- resources/views/dashboard.blade.php --}}

<x-layouts.app :title="__('Dashboard')">
    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-links class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4">
        <h1 class="text-2xl font-bold">Hello!</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <p class="text-green-600">{{ session('success') }}</p>
        @endif

        {{-- Student Creation Form --}}
        <div class="p-4 bg-white dark:bg-neutral-800 rounded-lg shadow">
            <h2 class="font-semibold mb-2">Add a New Student</h2>
            <form method="POST" action="{{ route('students.store') }}">
                @csrf
                <div class="mb-2">
                    <label class="block">Name:</label>
                    <input type="text" name="name" class="w-full rounded border p-2" required>
                </div>
                <div class="mb-2">
                    <label class="block">Email:</label>
                    <input type="email" name="email" class="w-full rounded border p-2" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Student</button>
            </form>
        </div>

        {{-- Student List --}}
        <div class="p-4 bg-white dark:bg-neutral-800 rounded-lg shadow mt-4">
            <h2 class="font-semibold mb-2">All Students</h2>
            <ul class="list-disc list-inside">
                @forelse ($students as $student)
                    <li>{{ $student->name }} ({{ $student->email }})</li>
                @empty
                    <p>No students yet.</p>
                @endforelse
            </ul>
        </div>
    </div>
</x-layouts.app>
