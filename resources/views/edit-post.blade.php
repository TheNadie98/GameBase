<!-- edit-post.blade.php -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <button type="submit" class="btn btn-primary">Actualizar titulo</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
