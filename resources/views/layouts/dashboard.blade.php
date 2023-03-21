<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <aside class="main_sidebar">
        <div class="user_panel">
            <a href="#">Profile</a>
        </div>
        <nav>
            <ul class="nav">
                <li class="nav_item"><a class="nav_link active" href="#">Новости</a></li>
                <li class="nav_item"><a class="nav_link" href="#">item 2</a></li>
                <li class="nav_item"><a class="nav_link" href="#">item 3</a></li>
                <li class="nav_item"><a class="nav_link" href="#">item 4</a></li>
                <li class="nav_item"><a class="nav_link" href="#">item 5</a></li>
                <li class="nav_item"><a class="nav_link" href="#">item 6</a></li>
                <li class="nav_item"><a class="nav_link" href="#">item 7</a></li>
            </ul>
        </nav>
    </aside>
    <div class="content_wrapper">
        @yield('content')
    </div>
    <style>
        *,
        ::after,
        ::before {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        .main_sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            font-size: 16px;
            padding: 10px 5px;
            background-color: #343a40;
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            flex-direction: column;
        }

        .nav>.nav_item>.nav_link {
            display: block;
            color: #c2c7d0;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
        }

        .nav>.nav_item>.nav_link:hover {
            background-color: rgba(255, 255, 255, .1);
            color: #fff;
        }

        .nav>.nav_item>.nav_link.active {
            background-color: rgba(255, 255, 255, .9);
            color: #343a40;
        }

        .content_wrapper {
            margin-left: 250px;
        }
    </style>
</body>

</html>
