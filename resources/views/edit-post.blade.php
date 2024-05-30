<!-- edit-post.blade.php -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('imagenes/wallpaper2.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar titulo</h1>
        <form action="/edit-post/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titulo</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}" required>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Resumen</label>
                <textarea name="body" class="form-control" id="body" rows="3" required>{{ $post->body }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="Completado" {{ $post->status == 'Completado' ? 'selected' : '' }}>Completado</option>
                    <option value="Drop" {{ $post->status == 'Drop' ? 'selected' : '' }}>Drop</option>
                    <option value="Platinado" {{ $post->status == 'Platinado' ? 'selected' : '' }}>Platinado</option>
                    <option value="On-Hold" {{ $post->status == 'On-Hold' ? 'selected' : '' }}>On-Hold</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="platform">Plataforma</label>
                <select name="platform" id="platform" class="form-control" required>
                    <option value="PS1" {{ $post->platform == 'PS1' ? 'selected' : '' }}>PS1</option>
                    <option value="PS2" {{ $post->platform == 'PS2' ? 'selected' : '' }}>PS2</option>
                    <option value="PS3" {{ $post->platform == 'PS3' ? 'selected' : '' }}>PS3</option>
                    <option value="PS4" {{ $post->platform == 'PS4' ? 'selected' : '' }}>PS4</option>
                    <option value="PS5" {{ $post->platform == 'PS5' ? 'selected' : '' }}>PS5</option>
                    <option value="XBOX" {{ $post->platform == 'XBOX' ? 'selected' : '' }}>XBOX</option>
                    <option value="XBOX360" {{ $post->platform == 'XBOX360' ? 'selected' : '' }}>XBOX360</option>
                    <option value="XBOX One" {{ $post->platform == 'XBOX One' ? 'selected' : '' }}>XBOX One</option>
                    <option value="XBOX Series X|S" {{ $post->platform == 'XBOX Series X|S' ? 'selected' : '' }}>XBOX Series X|S</option>
                    <option value="Nintendo SW" {{ $post->platform == 'Nintendo SW' ? 'selected' : '' }}>Nintendo SW</option>
                    <option value="Nintendo DS" {{ $post->platform == 'Nintendo DS' ? 'selected' : '' }}>Nintendo DS</option>
                    <option value="Nintendo 3DS" {{ $post->platform == 'Nintendo 3DS' ? 'selected' : '' }}>Nintendo 3DS</option>
                    <option value="PC" {{ $post->platform == 'PC' ? 'selected' : '' }}>PC</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar titulo</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
