<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

        {{-- links and things that are needed --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h2>Edit Post</h2>

    <div id="responseMessage"></div>

    <form id="postForm">
        <input type="text" name="title" placeholder="Post title"><br>
        <textarea name="content" placeholder="Post content"></textarea><br>
        <button type="submit">Submit</button>
    </form>

    <script>
        $(document).ready(function(){
            
        });
    </script>
</body>
</html>