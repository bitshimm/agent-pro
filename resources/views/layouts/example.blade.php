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

        form {
            display: block;
            max-width: 1200px;
            margin: 0 auto;
        }

        div {
            margin-bottom: 2em;
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif
        }

        input,
        textarea {
            box-sizing: border-box;
            width: 100%;
            padding: 10px 15px;
        }

        input[type=radio] {
            width: auto;
        }

        .card_list {
            /* display: grid;
                gap: 10px;
                grid-template-columns: repeat(4, 1fr);
                font-size: 14px;
                font-weight: 500; */
            display: flex;
            flex-wrap: wrap;
            margin: -7.5px;
        }


        .card_col {
            flex: 0 0 100%;
            padding: 7.5px;
            box-sizing: border-box;
        }

        @media(min-width: 576px) {
            .card_col {
                flex: 0 0 50%;
                /* max-width: 50%; */
            }
        }

        @media(min-width: 992px) {
            .card_col {
                flex: 0 0 calc(100% / 3);
                /* max-width: calc(100%  / 3); */
            }
        }

        @media(min-width: 1200px) {
            .card_col {
                flex: 0 0 25%;
                /* max-width: 25%; */
            }
        }

        .edit_btn {
            display: block;
            background: lightblue;
            color: #000;
            padding: 10px 15px;
            text-decoration: none;
        }

        .remove_btn {
            display: block;
            background: red;
            color: #fff;
            border: none;
            padding: 10px 15px;
        }
    </style>
</body>

</html>
