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
            <th>Nama</th>
            <th>Level ID</th>
        </tr>
        
        <tr>
            <td>{{ $data->user_id }}</td>
            <td>{{ $data->username }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->level_id }}</td>
        </tr>
     </table>