<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <x-navigation />
        @yield('content')
    </div>
    
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 7.5px;
        }
    </style>
</body>

</html>