<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la búsqueda de Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-image: url('{{ asset('imagenes/mosaico3.avif') }}');
        background-size: cover;
        background-position: center;
        min-height: 100vh; 
        margin: 0; 
        padding: 0; 
    }

    .transparent-background {
        background-color: rgba(255, 255, 255, 0.7); /* Ajusta el último valor para cambiar la opacidad */
        padding: 20px; /* Espacio interior */
        border-radius: 10px; /* Bordes redondeados */
    }

    .list-group-item {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        border-radius: 8px;
    }

    .list-group-item:hover {
        background-color: #e9ecef;
    }

    .post-title {
        font-weight: bold;
    }

    .post-body {
        color: #6c757d;
    }

    .post-status {
        font-style: italic;
        color: #868e96;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="transparent-background mt-3">
        <h1 class="mt-5">Resultado de la búsqueda de Usuario</h1>
        </div>

        <div class="transparent-background mt-3">
            @if ($users->isEmpty())
                <p>No se han encontrado usuarios.</p>
            @else
                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item">{{ $user->name }}</li>
                        @if ($user->posts->isNotEmpty())
                            <ul class="list-group list-group-flush">
                                @foreach ($user->posts as $post)
                                    <li class="list-group-item">
                                        <span class="post-title">{{ $post->title }}</span><br>
                                        <span class="post-body">{{ $post->body }}</span><br>
                                        <span class="post-status">{{ $post->status }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-2">Este usuario no tiene posts.</p>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
