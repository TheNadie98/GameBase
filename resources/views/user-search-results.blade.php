<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search Results</title>
</head>
<body>
    <h1>User Search Results</h1>

    @if ($users->isEmpty())
        <p>No users found.</p>
    @else
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }}</li>
                @if ($user->posts->isNotEmpty())
                    <ul>
                        @foreach ($user->posts as $post)
                            <li>{{ $post->title }}</li>
                            <p>{{ $post->body }}</p>
                        @endforeach
                    </ul>
                @else
                    <p>No posts found for this user.</p>
                @endif
            @endforeach
        </ul>
    @endif
</body>
</html>
