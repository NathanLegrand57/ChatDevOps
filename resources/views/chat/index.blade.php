<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Chat</title>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-md p-6 mb-4">
            <form action="{{ route('chat.store') }}" method="post" class="flex space-x-4">
                @csrf

                <input type="text" placeholder="Pseudo" name="pseudo" value="{{ old('pseudo') }}" required
                    class="border rounded-md px-4 py-2 w-1/3 focus:outline-none focus:border-blue-500">

                <input type="text" placeholder="Message" name="message" required
                    class="border rounded-md px-4 py-2 flex-1 focus:outline-none focus:border-blue-500">

                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                    Envoyer
                </button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-md p-4 mb-4">
            <div class="chat overflow-scroll overflow-x-hidden h-96">

                @forelse ($chats as $chat)
                    <div class="mb-4">
                        <p class="text-gray-600 scroll-smooth"><em>{{ $chat->pseudo }}</em> : {{ $chat->message }}</p>
                    </div>
                @empty
                    <p class="text-gray-600">Aucun message pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>
<script src="resources\js\chat.js"></script>
</body>

</html>
