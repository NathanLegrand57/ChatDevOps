<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Chat</title>
</head>

<body>

    <div class="chat">
        <form action="{{ route('chat.store') }}" method="post">
            @csrf

            <input type="text" placeholder="Pseudo" name="pseudo" value="{{ old('pseudo') }}"required>
            <input type="text" placeholder="Message" name="message" required>

            <input type="submit">
        </form>
    </div>

    @forelse ($chats as $chat)
        <em>{{ $chat->pseudo }}</em> : {{ $chat->message}} <br>
    @empty
    @endforelse


</body>
</html>
