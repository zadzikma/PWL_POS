 <!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    <a href="/user/tambah">+ Tambah User</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>User ID</td>
            <td>Username</td>
            <td>Nama</td>
            <td>Level ID</td>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->level_id }}</td>
            <a href="/user/ubah/{{ $d->user_id }}">Ubah</a> | 
                <a href="/user/hapus/{{ $d->user_id }}" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
        </tr>
         @endforeach
     </table>
</body>
</html>
