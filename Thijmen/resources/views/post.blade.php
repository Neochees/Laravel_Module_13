{{-- onderstaande gebruik je als $post gewone tekst is. 
    HTML wordt hier uit veiligheid gefilterd en weergegeven als HTML-code --}}
{{ $post }}

{{-- dit gebruik je als $post HTML is en je dat als HTML wilt renderen --}}
{!! $post !!}

@foreach ($posts as $post)
    <article>
        <h1><a href="post/<?= $post->id; ?>"><?= $post->title; ?></a></h1>
        <div>
            <?= $post->excerpt; ?>
        </div>
    </article>
@endforeach

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/app.css">
    <title>Blog posts</title>
</head>
<body>
    <article>
        <h1><?= $post->title;?></h1>
        <p>
            <?= $post->body;?>    
        </p>
    </article>
    <a href="/">Go back</a>
</body>
</html>