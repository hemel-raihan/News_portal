<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{route('video.upload')}}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="video" >
    <button type="submit" class="btn btn-success mt-1">

        <i class="fe fe-plus"></i>
        Create
    </button>
</body>
</html>
