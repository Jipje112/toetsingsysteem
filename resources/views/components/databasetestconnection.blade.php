@props(['users'])

<ul>
    @foreach ($students as $student)
        <li>{{ $student->name }} ({{ $student->email }})</li>
    @endforeach
</ul>
