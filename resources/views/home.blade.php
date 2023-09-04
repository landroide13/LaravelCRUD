<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Test 1</h1>

    @auth

        <p>Congrats your logged in..</p>

        <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form>

        <div class="">
            <h1>Create a New Post</h1>
            <form action="/create-post" method="POST">
                @csrf
                <input name='title' type="text" placeholder="Title" />
                <textarea name='body' placeholder="Text"></textarea>
                <button>Create</button>
            </form>
        </div>

        <div class="">
            <h3>Some Posts</h3>

            @foreach($posts as $post)
                <div class="" style="background: grey; padding: 10px; margin: 10px;">

                    <h3>{{ $post['title'] }} by {{ $post -> user -> name }}</h3>
                    <p>
                        <a href="/edit-post/{{ $post->id }}">Edit</a>
                    </p> 

                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                     
                
                </div>
            @endforeach
        </div>
    @else

        <main>
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input name='name' type="text" placeholder="Name" />
                <input name='email' type="email" placeholder="Email" />
                <input name='password' type="password" placeholder="Password" />
                <button>Register</button>
            </form>
            <hr>
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input name='loginemail' type="email" placeholder="Email" />
                <input name='loginpassword' type="password" placeholder="Password" />
                <button>Login</button>
            </form>
        </main>

    @endauth

    <hr/>

    
</body>
</html>