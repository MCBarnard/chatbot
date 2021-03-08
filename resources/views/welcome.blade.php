<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How to install Botman Chatbot in Laravel? - codechief.org</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
</body>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script>
    var botmanWidget = {
        frameEndpoint: "{{ route('botman.show') }}",
        title: "PayFast Bot",
        mainColor: "#041b2b",
        bubbleBackground: "#e0182d",
        aboutText: 'Powered by PayFast',
        introMessage: "✋ Hi! Welcome to PayFast ChatBot, I am still in Beta, dont expect too much...<br> <br> What can I assist with?"
    };
</script>

<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</html>
