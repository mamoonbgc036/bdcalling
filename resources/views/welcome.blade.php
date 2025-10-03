<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Content/Blog Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light p-4">
    <div class="container">
        <h2 class="mb-4">Add Multiple Contents and Blogs</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Validation Failed:</strong> Please fix the errors below.
        </div>
        @endif
        <form action="{{ route('store') }}" method="POST">
            @csrf
            <button type="button" id="addContentBtn" class="btn btn-primary mb-4">Add Content</button>
            <div id="contentWrapper">
                @if (old('contents'))
                @foreach (old('contents') as $i => $content)
                <div class="content mb-4 p-4 bg-white shadow-sm rounded">
                    <h4>Content {{ $i + 1 }}</h4>
                    <div class="mb-2">
                        <input type="text" name="contents[{{ $i }}][content_title]"
                            class="form-control form-control-sm mb-1" value="{{ $content['content_title'] }}"
                            placeholder="Content title">
                        @error("contents.$i.content_title")
                        <div class="text-danger small">
                            {{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="addBlogBtn btn btn-sm btn-secondary mb-3">Add
                        More
                        Blog</button>
                    <div class="blogs">
                        @foreach ($content['blogs'] as $j => $blog)
                        <div class="blog mb-3">
                            <h6>Blog {{ $j + 1 }}</h6>
                            <input type="text" name="contents[{{ $i }}][blogs][{{ $j }}][title]"
                                class="form-control form-control-sm mb-1" value="{{ $blog['title'] }}"
                                placeholder="Blog title">
                            @error("contents.$i.blogs.$j.title")
                            <div class="text-danger small">
                                {{ $message }}</div>
                            @enderror
                            <input type="text" name="contents[{{ $i }}][blogs][{{ $j }}][body]"
                                class="form-control form-control-sm" value="{{ $blog['body'] }}"
                                placeholder="Blog body">
                            @error("contents.$i.blogs.$j.body")
                            <div class="text-danger small">
                                {{ $message }}</div>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                @else
                <div class="content mb-4 p-4 bg-white shadow-sm rounded">
                    <h4>Content 1</h4>
                    <div class="mb-2">
                        <input type="text" name="contents[0][content_title]" class="form-control form-control-sm mb-1"
                            placeholder="Content title">
                    </div>
                    <button type="button" class="addBlogBtn btn btn-sm btn-secondary mb-3">Add
                        More Blog</button>
                    <div class="blogs">
                        <div class="blog mb-3">
                            <h6>Blog 1</h6>
                            <input type="text" name="contents[0][blogs][0][title]"
                                class="form-control form-control-sm mb-1" placeholder="Blog title">
                            <input type="text" name="contents[0][blogs][0][body]" class="form-control form-control-sm"
                                placeholder="Blog body">
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            let contentIndex =
                {{ old('contents') ? count(old('contents')) : 1
        }};
        $('#addContentBtn').click(function () {
            const contentTemplate = $('.content:first').clone();
            contentTemplate.find('h4').text('Content ' + (
                contentIndex + 1));
            contentTemplate.find(
                'input[name$="[content_title]"]').val('');
            contentTemplate.find(
                'input[name$="[content_title]"]').attr(
                    'name',
                    `contents[${contentIndex}][content_title]`);
            const firstBlog = contentTemplate.find(
                '.blog:first').clone();
            firstBlog.find('h6').text('Blog 1');
            firstBlog.find('input').each(function (index) {
                $(this).val('');
                const type = index === 0 ? 'title' :
                    'body';
                $(this).attr('name',
                    `contents[${contentIndex}][blogs][0][${type}]`
                );
            });
            contentTemplate.find('.blogs').html(firstBlog);

            $('#contentWrapper').append(contentTemplate);
            contentIndex++;
        });
        $(document).on('click', '.addBlogBtn', function () {
            const contentDiv = $(this).closest('.content');
            const blogsWrapper = contentDiv.find('.blogs');
            const blogCount = blogsWrapper.find('.blog').length;
            const contentIdx = $('#contentWrapper .content')
                .index(contentDiv);

            const blogTemplate = blogsWrapper.find(
                '.blog:first').clone();
            blogTemplate.find('h6').text('Blog ' + (blogCount +
                1));

            blogTemplate.find('input').each(function (index) {
                $(this).val('');
                const type = index === 0 ? 'title' :
                    'body';
                $(this).attr('name',
                    `contents[${contentIdx}][blogs][${blogCount}][${type}]`
                );
            });

            blogsWrapper.append(blogTemplate);
        });
        });
    </script>
</body>

</html>