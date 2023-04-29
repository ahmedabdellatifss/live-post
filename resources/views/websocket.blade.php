<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <ul id="list-messages">

    </ul>

    <form action="" id="form">
        @csrf
        <label for="input-message"></label>
        <input id="input-message" type="text" placeholder="Message...">
    </form>

    <script src="{{ mix('js/app.js')  }}"></script>
</body>
</html>
