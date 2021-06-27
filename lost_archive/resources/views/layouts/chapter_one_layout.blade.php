<!DOCTYPE>
<html lang>
    <head>
        <title>Lost Archive - Chapter 1</title>

        <script src = "jquery.min.js"></script>
        <link href = "game_back_button.css" rel = "stylesheet"/>
        <link href = "game_prompt.css" rel = "stylesheet"/>
        <link href = "game_prompt_question.css" rel = "stylesheet"/>
        <link href = "game_prompt_assessment.css" rel = "stylesheet"/>
        <link href = "game_prompt_assessment_result.css" rel = "stylesheet"/>
        <link href = "button_previous_next_scene.css" rel = "stylesheet"/>
        <link href = "fontawesome5.15.3/css/all.min.css" rel = "stylesheet"/>

        <style>
        *
        {
            user-select: none;
        }
        body
        {
            margin: 0px;
            padding: 0px;
            font-family: arial;
            overflow:hidden;
        }
        .chapter_background
        {
            width: 100%;
            height: 100%;
            z-index: -1;
            position: absolute;
            top: 0px;
            background-image: url("chapter_one_background.jpg"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;
        }
        input[type="radio"] 
        {
            -ms-transform: scale(2); /* IE 9 */
            -webkit-transform: scale(2); /* Chrome, Safari, Opera */
            transform: scale(2);
        }
        </style>

        @yield('style')

    </head>
    <body>

        <div id = "game_back_id" class = "game_back_button">
            <div class = "game_back_button_text">Back</div>
        </div>

        <div class = "chapter_background">
        </div>

        <div>

            @yield('content')

        </div>

        <script>
        $(document).ready(function()
        {
            $('#game_back_id').on('click', function()
            {
                window.location.href = "/chapter";
            });
        });
        </script>

    </body>
</html>