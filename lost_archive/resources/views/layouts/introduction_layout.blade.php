<!DOCTYPE>
<html lang>
    <head>
        <title>Lost Archive - Introduction</title>

        <script src = "jquery.min.js"></script>
        <link href = "game_loading.css" rel = "stylesheet"/>
        <link href = "game_confirm.css" rel = "stylesheet"/>
        <link href = "game_back_button.css" rel = "stylesheet"/>
        <link href = "button_previous_next_scene.css" rel = "stylesheet"/>
        <link href = "fontawesome5.15.3/css/all.min.css" rel = "stylesheet"/>

        <style>
        body
        {
            margin: 0px;
            padding: 0px;
            font-family: arial;
            overflow:hidden;
        }
        .introduction_background
        {
            width: 100%;
            height: 100%;
            z-index: -1;
            position: absolute;
            top: 0px;
            background-image: url("introduction.jpg"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;
        }
        </style>
        
        <style>
        .game_next_button
        {
            width: 100px;
            height: 100px;
            
            position: absolute;

            top: 20px;
            right: 20px;

            background-image: url("button.png"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;
            cursor: pointer;
        }

        .game_next_button_text
        {
            position: absolute; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
            user-select: none;
        }

        .game_next_button:hover 
        {
            color: cyan;
            filter: brightness(220%);
        }
    </style>

        @yield('style')

    </head>
    <body>

        <div id = "game_back_id" class = "game_back_button">
            <div class = "game_back_button_text">Back</div>
        </div>

        <div id = "game_loading_id" class = "game_loading_container customize_displaynone">
            <div class = "game_loading_background">
            </div>
            <div class = "game_loading_content">

                <div id = "game_title_id" class = "game_loading_content_title">
                </div>

                <div id = "game_text_id" class = "game_loading_content_text">
                </div>

            </div>
        </div>

        <div id = "game_confirm_id" class = "game_confirm_container customize_displaynone">
            <div class = "game_confirm_background">
            </div>
            <div class = "game_confirm_content">

                <div id = "game_confirm_close_id" class = "game_confirm_content_close">
                    X
                </div>
            
                <div id = "game_confirm_title_id" class = "game_confirm_content_title">
                </div>

                <div id = "game_confirm_text_id" class = "game_confirm_content_text">
                </div>

                <div id = "game_confirm_proceed_id" class = "game_confirm_content_button">
                    Proceed
                </div>

            </div>
        </div>

        <div class = "introduction_background">
        </div>

        <div>

            @yield('content')

        </div>

        <script>
        $(document).ready(function()
        {
            $('#game_back_id').on('click', function()
            {
                window.location.href = "/";
            });

            $('#game_confirm_close_id').on('click', function()
            {
                $('#game_confirm_id').addClass('customize_displaynone');
            });
        });
        </script>

    </body>
</html>