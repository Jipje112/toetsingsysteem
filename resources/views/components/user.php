<div class="p-4">
    <h2 class="text-xl font-bold mb-4">User List</h2>
    <ul class="space-y-2">
        @foreach ($users as $user)
            <li class="border p-2 rounded">
                {{ $user->name }} – {{ $user->email }}
            </li>
        @endforeach
    </ul>
</div>
