<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <title>Chat</title>
</head>

<body class="bg-gray-100">

    @include('layouts.navigation')

    <div class="bg-white shadow-md rounded-md p-4 mb-4">
        <div class="chat">
            @forelse ($chats as $chat)
                <div class="mb-4 flex gap-4" id="editor">
                    <form method="POST" action="{{ route('chat.destroy', $chat->id) }}">
                        @csrf
                        @method('DELETE')

                        @can('message-delete')
                            <button type="submit" class="btn btn-sm btn-danger delete-user">{{ 'Supprimer' }}</button>
                        @endcan

                    </form>
                    <p class="text-gray-600"><b>{{ $chat->user->name }}</b> : {!! $chat->message !!}</p>

                </div>
            @empty
                <p class="text-gray-600">Aucun message pour le moment.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white shadow-md rounded-md p-6 mb-4">
        <form action="{{ route('chat.store') }}" method="post" class="space-x-4" id="chatForm">
            @csrf

            <div id="toolbar">
                <!-- Add font size dropdown -->
                <!-- Add a bold button -->
                <button class="ql-bold"></button>
                <!-- Add subscript and superscript buttons -->
                <button class="ql-script" value="sub"></button>
                <button class="ql-script" value="super"></button>
            </div>
            <div id="editor">
                <div id="editor-container" style="min-height: 70px;"></div>
                <input type="hidden" id="message" name="message">
                @error('message')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="bg-blue-500 text-white mt-4 px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Envoyer
            </button>
        </form>
    </div>

    <script>
        var toolbarOptions = ['bold', 'italic', 'underline', 'strike', {
            'color': []
        }, 'link'];

        // Initialiser l'éditeur Quill
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });

        // Gérer la soumission du formulaire avec le contenu de l'éditeur Quill
        document.getElementById('chatForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var editorContent = document.querySelector('.ql-editor').innerHTML;
            document.getElementById('message').value = editorContent;
            this.submit();
        });
    </script>
    <script src="{{ asset('js/chat.js') }}"></script>
</body>

</html>
