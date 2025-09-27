 <!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level ID</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->password }}</td>
            <td>{{ $d->level_id }}</td>
        </tr>
        @endforeach
    </table>