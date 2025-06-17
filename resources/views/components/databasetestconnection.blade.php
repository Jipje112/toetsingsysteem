<x-databasetestconnection :users="$users" />
@props(['users'])

<ul>
    @foreach ($users as $user)
        <li>{{ $user->name }} ({{ $user->email }})</li>
    @endforeach
</ul>
