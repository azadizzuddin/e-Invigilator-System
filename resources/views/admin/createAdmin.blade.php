<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Admin</title>
</head>
<body>
    <h2>Create New Admin</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <label for="adminID">Admin ID:</label><br>
        <input type="text" name="adminID" id="adminID"><br><br>

        <label for="adminName">Admin Name:</label><br>
        <input type="text" name="adminName" id="adminName"><br><br>

        <label for="adminPassword">Password:</label><br>
        <input type="password" name="adminPassword" id="adminPassword"><br><br>

        <label for="adminContact">Contact:</label><br>
        <input type="text" name="adminContact" id="adminContact"><br><br>

        <button type="submit">Create Admin</button>
    </form>
</body>
</html>
