<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
this is a home page </br>
{{Auth::user()->name}}

<a href="{{route('login')}}">login</a></br>
<a href="{{route('register')}}">register</a>
</body>
</html>
