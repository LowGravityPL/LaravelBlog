<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog - Create Post</title>
</head>
<body>
    <h1>Create post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <input type="text" name="title" placeholder="Post Title" />
        </div>
        <div>
            <textarea name="content" id="" cols="30" rows="10" placeholder="Post content"></textarea>
        </div>
        <div>
            <label for="post_image">Post image</label>
            <input type="file" name="post_image" id="post_image" />
        </div>

        @if (! empty($categories))
            <div>
                <label for="category">Category</label>
                <select name="category" id="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        @if (! empty($users))
            <div>
                <label for="user">User</label>
                <select name="user" id="user">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div>
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</body>
</html>
