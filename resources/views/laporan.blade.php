<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Page</title>
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
        .download-btn {
            margin: 20px 0;
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
   
        <h1 class="mb-4" style="text-align: center">Daftar Semua Post</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Create By</th>
                </tr>
            </thead>
        <tbody>
        @foreach ($posts as $post )
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->body }}</td>
            <td>{{ $post->user_name }}</td>
        </tr>
      
        </div>
            
        @endforeach
    </tbody>
</table>
<p><a href="/home">Kembali</a></p>
<a href="/pdf" class="download-btn">Download PDF</a>
    </div>
</body>
</html>