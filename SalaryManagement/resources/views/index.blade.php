<!-- View: Form with AJAX + CSRF token -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>

    {{-- links and things that are needed --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

</head>
<body>
    <h2>New Post</h2>

    <div id="responseMessage"></div>

    <form id="postForm">
        <input type="text" name="title" placeholder="Post title"><br>
        <textarea name="content" placeholder="Post content"></textarea><br>
        <button type="submit">Submit</button>
    </form>

    <h1>All Posts</h1>

<table id="dt-posts">
    <thead>
        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<div id="edit-modal">
    <h2>Edit Post</h2>
    <form id="editForm">
        <input type="hidden" name="id">
        <input type="text" name="title" placeholder="Post title"><br>
        <textarea name="content" placeholder="Post content"></textarea><br>
        <button type="button">Update</button>
        <button type="button">Cancel</button>
    </form>
</div>


    <script>
        $(document).ready(function(){
           var table = $('#dt-posts').DataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ route('getPosts') }}",
                    type: "GET"
                },

                columns: [
                    { data: 'id', visible: false},
                    { data: 'title'},
                    { data: 'content'},
                    { data: null, orderable: false, searchable: false,
                        render: function(data, type, row){
                            return `
                                <button class="edit-btn" data-id="${row.id}">Edit</button>
                                <button class="delete-btn" data-id="${row.id}">Delete</button>
                            `;
                        }
                    }
                ]
            })

            $('#postForm').on('submit', function(e) {
                e.preventDefault();
                let title = $('input[name="title"]').val();
                let content = $('textarea[name="content"]').val();
    
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    url: "{{ route('submitForm') }}",
                    type: "POST",
                    data: {
                        title: title,
                        content: content
                    },
                    success: function(response) {
                        $('#responseMessage').text(response.msg).css('color', 'green');
                        $('#postForm')[0].reset();
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        $('#responseMessage').text('Error: ' + xhr.responseText).css('color', 'red');
                    }
                });
            });

            $('#dt-posts').on('click', '.edit-btn', function(){
                const id = $(this).data('id');
                    window.location.href = '/posts/' + id + '/editPage';
            })

            $('#dt-posts').on('click', '.delete-btn', function(){
                const id = $(this).data('id');
                alert('Delete post with ID: ' + id);
            })
            
        });

    </script>
</body>
</html>
