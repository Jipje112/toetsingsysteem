<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>
    <h1>All Students</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach ($students as $student)
            <li>{{ $student->name }} ({{ $student->email }})</li>
        @endforeach
    </ul>

    <hr>

    <h2>Add a New Student</h2>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <button type="submit">Add Student</button>
    </form>
</body>
</html>
