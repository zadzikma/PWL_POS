<!DOCTYPE html>
<html>
<head>
    <title>Data Level Pengguna</title>
</head>
<body>
    <h1>Data Level Pengguna</h1>
    <table border="1" Cellpadding="2" cellspacing="0">
        
            <tr>
                <th>Level ID</th>
                <th>Level Kode</th>
                <th>Level Nama</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->level_id }}</td>
                <td>{{ $d->level_kode }}</td>
                <td>{{ $d->level_nama }}</td>
                <td>{{ $d->created_at }}</td>
                <td>{{ $d->updated_at }}</td>
            </tr>
            @endforeach
    </table>
</body>
</html>

