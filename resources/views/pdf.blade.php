<!DOCTYPE html>
<html>
<head>
    <title>Laporan Posts</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Posts</h1>

    <!-- Tabel Laporan -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>User Name</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->user_name }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data yang tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
