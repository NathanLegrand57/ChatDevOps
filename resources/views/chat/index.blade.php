<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <title>Chat</title>
</head>

<body class="bg-gray-100">

    @include('layouts.navigation')

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
                <div id="editor-container" style="min-height: 200px;"></div>
                <input type="hidden" id="message" name="message">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Envoyer
            </button>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-md p-4 mb-4">
        <div class="chat">
            @forelse ($chats as $chat)
                <div class="mb-4" id="editor">
                    <p class="text-gray-600"><em>{{ $chat->user_id }}</em> : {!! $chat->message !!}</p>
                </div>
            @empty
                <p class="text-gray-600">Aucun message pour le moment.</p>
            @endforelse
        </div>
    </div>

    <div class="container mx-auto p-4">
        <!-- Le contenu de la div container -->
    </div>

    <script src="{{ asset('js/chat.js') }}"></script>
    <script>
        var toolbarOptions = ['bold', 'italic', 'underline', 'strike', {
            'color': []
        }, 'link', 'image', ];

        // Initialiser l'éditeur Quill
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });

        // Gérer la soumission du formulaire avec le contenu de l'éditeur Quill
        document.getElementById('chatForm').addEventListener('submit', function (event) {
            event.preventDefault();
            var editorContent = quill.getText();
            document.getElementById('message').value = editorContent;
            this.submit();
        });
    </script>
</body>

</html>
