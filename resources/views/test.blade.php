<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<!-- 1.45 -->

<body>
    @if(old('content'))
    @dd(old('content')[0]['blog'])
    @endif
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <div>
            <div>
                <button id="addContent">Add Content</button>
            </div>
            <div id="content">
                @if(old('content'))
                @foreach(old('content') as $key => $cont)
                <div id="contentToBeAppend">
                    <h1 id="heading">Content 1</h1>
                    <div>
                        <button id="addBlog">Add Blog</button>
                    </div>
                    <div>
                        <label for="">Content Title check</label>
                        <input type="text" name="content[0][c_title]">
                    </div>
                    <div id="blog">
                        <div class="blogToBeAdded">
                            <div>
                                <label for="BlogTitle">Blog Title</label>
                                <input class="blog_title" type="text" name="content[0][blog][0][title]">
                            </div>
                            <div>
                                <label for="BlogTitle">Blog Body</label>
                                <input class="blog_body" type="text" name="content[0][blog][0][body]">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div id="contentToBeAppend">
                    <h1 id="heading">Content 1</h1>
                    <div>
                        <button id="addBlog">Add Blog</button>
                    </div>
                    <div>
                        <label for="">Content Title check</label>
                        <input type="text" name="content[0][c_title]">
                    </div>
                    <div id="blog">
                        <div class="blogToBeAdded">
                            <div>
                                <label for="BlogTitle">Blog Title</label>
                                <input class="blog_title" type="text" name="content[0][blog][0][title]">
                            </div>
                            <div>
                                <label for="BlogTitle">Blog Body</label>
                                <input class="blog_body" type="text" name="content[0][blog][0][body]">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <button type="submit">Submit</button>
    </form>
    <script>
        let contentCount = <?= old('content') ? count(old('content')) : 1 ?>;
        let intact = 0;
        $('#addContent').click(function(e) {
            e.preventDefault();
            intact++;
            ++contentCount;
            $('#content').append(`
            <div id="contentToBeAppend">
                    <h1 id="heading">Content ${contentCount}</h1>
                    <div>
                        <button id="addBlog">Add Blog</button>
                    </div>
                    <div>
                        <label for="">Content Title</label>
                        <input type="text" name="content[${intact}][c_title]">
                    </div>
                    <div id="blog">
                        <div class="blogToBeAdded">
                            <div>
                                <label for="BlogTitle">Blog Title</label>
                                <input class="blog_title" type="text" name="content[${intact}][blog][0][title]">
                            </div>
                            <div>
                                <label for="BlogTitle">Blog Body</label>
                                <input class="blog_body" type="text" name="content[${intact}][blog][0][body]">
                            </div>
                        </div>
                    </div>
                </div>
            `);
        });

        $(document).on('click', '#addBlog', function(e) {
            e.preventDefault();
            const blog = $('.blogToBeAdded:first').clone();
            let count = $(this).closest('#contentToBeAppend').find('.blogToBeAdded').length;

            // 
            contentC = $('#contentToBeAppend').length;
            contentC = contentC - 1;
            blog.find('.blog_title').attr('name', `content[${contentC}][blog][${count}][title]`);
            blog.find('.blog_body').attr('name', `content[${contentC}][blog][${count}][body]`)
            $(this).closest('#contentToBeAppend').find('#blog').append(blog)
        })
    </script>

</body>

</html>