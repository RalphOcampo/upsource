@extends('layouts.introduction_layout')

@section('style')

    <style>
        .characters_container
        {
            display: grid;
            grid-template-columns: auto auto;
            height: 100%;
        }

        .character_user_container
        {
            height: 80%;

            position: relative;
            top: 100%;
            left: 50%;

            transform: translate(-50%, -110%);

            box-sizing: border-box;
        }

        .character_user_image_container
        {
            position: relative;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -100%);
            height: 63%;
            width: 200px;
        }

        .character_user_message
        {
            position: absolute;
            top: -150px;
            left: -100px;
            /* height: 200px; */
            width: 400px;
            height: 140px;
            /* min-height: 130px;
            max-height: 200px;
            min-width: 150px; */
            /* background-color: white; */
            /* border-radius: 50px; */
            padding: 40px 30px 40px 30px;
            box-sizing: border-box; 
            user-select: none;
            z-index: 9999;

            background-image: url("message_box.png"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;

            text-align: center;
            font-size: 17px;
        }

        .character_user_image
        {
            position: absolute;
            top: 0px;
            height: 100%;
            width: 100%;
        }

        .character_guide_container
        {
            height: 80%;

            position: relative;
            top: 100%;
            left: 50%;

            transform: translate(-50%, -110%);

            box-sizing: border-box;
        }

        .character_guide_image_container
        {
            position: relative;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -100%);
            height: 63%;
            width: 200px;
        }

        .character_guide_message
        {
            position: absolute;
            top: -250px;
            left: -250px;
            transform: translateY(30%);
            /* height: 200px; */
            width: 500px;
            height: auto;
            min-height: 150px;
            max-height: 250px;
            line-height: 25px;
            /* min-height: 130px;
            max-height: 200px;
            min-width: 150px; */
            /* background-color: white; */
            /* border-radius: 50px; */
            padding: 20px 35px 35px 35px;
            box-sizing: border-box; 
            user-select: none;
            z-index: 9999;

            background-image: url("message_box.png"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;

            text-align: center;

            /* font-weight: bold; */

            font-size: 17.5px;
        }

        .character_guide_image
        {
            position: absolute;
            top: 0px;
            height: 100%;
            width: 100%;
        }

    </style>

@endsection

@section('content')

    <div class = "characters_container">
        <div>

            <div class = "character_user_container">

                <div class = "character_user_image_container">

                    <div id = "character_user_message_id" class = "character_user_message">
                    </div>

                    <img id = "character_user_image_id" class = "character_user_image" alt = "girl avatar"/>

                </div>

            </div>

        </div>
        <div>

            <div class = "character_guide_container">

                <div class = "character_guide_image_container">

                    <div id = "character_guide_message_id" class = "character_guide_message">
                    </div>

                    <img class = "character_guide_image" src = "guide.png" alt = "girl avatar"/>

                </div>
            </div>
        </div>
    </div>

    <div class = "character_scene_container">
        <div>
            <button id = "game_scene_previous_id" class = "character_scene_previous_button" data-current-scene = "" data-next-scene = "" type = "button">
               Previous
            </button>
        </div>
        <div>
            <button id = "game_scene_next_id" class = "character_scene_next_button" data-current-scene = "" data-next-scene = "" type = "button">
                Next&emsp;
            </button>
        </div>
    </div>

    <div id = "game_next_id" class = "game_next_button">
        <div class = "game_next_button_text">Proceed</div>
    </div>

    <script>
    $(document).ready(function()
    {
        get_user_introduction();

        $('#game_next_id').on('click', function()
        {   
            $('#game_loading_id').removeClass('customize_displaynone');
            $('#game_title_id').text('INTRODUCTION');
            $('#game_text_id').text('Redirecting to Chapters. Please Wait..');

            setTimeout(function()
            {
                window.location.href = "/chapter";
            }, 1500);
        });

        $('#game_scene_previous_id').on('click', function()
        {
            let current_scene = $(this).attr('data-current-scene'),
                next_scene = $(this).attr('data-next-scene');

            update_user_introduction(current_scene, next_scene);
        });

        $('#game_scene_next_id').on('click', function()
        {
            let current_scene = $(this).attr('data-current-scene'),
                next_scene = $(this).attr('data-next-scene');

                update_user_introduction(current_scene, next_scene);
        });

        function update_user_introduction(current_scene, next_scene)
        {
            $.ajax({
                url: '/update_user_introduction?current_scene=' + current_scene + '&next_scene=' + next_scene ,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(result)
                {
                    if(result['status'] == 200)
                    {
                        get_user_introduction();
                    }
                    else
                    {
                        alert('Something went wrong.. Please refresh your page');
                    }
                },
                error: function(result)
                {
                    alert('Something went wrong.. Please refresh your page');
                }
            });
        }

        function get_user_introduction()
        {
            $.ajax({
                url: '/get_user_introduction',
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(result)
                {
                    if(result['status'] == 200)
                    {
                        $('#character_user_image_id').attr('src', result['user_avatar']);
                        
                        if( result['data']['introduction_scene_one']['is_read'] == 0 ||
                            result['data']['introduction_scene_two']['is_read'] == 0 || 
                            result['data']['introduction_scene_three']['is_read'] == 0 ||
                            result['data']['introduction_scene_four']['is_read'] == 0 )
                        {
                            user_disable_button_next();
                        }
                        else
                        {
                            user_enable_button_next();
                        }

                        if( result['data']['introduction_scene_one']['is_current_selected'] == 1)
                        {
                            user_disable_button_previous_scene();
                            user_enable_button_next_scene();

                            user_message_hide();
                            guide_message_show();

                            $('#character_user_message_id').text(result['data']['introduction_scene_one']['user_message']);
                            $('#character_guide_message_id').text(result['data']['introduction_scene_one']['guide_message']);

                            $('#game_scene_previous_id').attr('data-current-scene', 'introduction_scene_one');
                            $('#game_scene_previous_id').attr('data-next-scene', 'introduction_scene_one');

                            $('#game_scene_next_id').attr('data-current-scene', 'introduction_scene_one');
                            $('#game_scene_next_id').attr('data-next-scene', 'introduction_scene_two');
                        }
                        else if( result['data']['introduction_scene_two']['is_current_selected'] == 1)
                        {
                            user_enable_button_previous_scene();
                            user_enable_button_next_scene();

                            user_message_hide();
                            guide_message_show();

                            $('#character_user_message_id').text(result['data']['introduction_scene_two']['user_message']);
                            $('#character_guide_message_id').text(result['data']['introduction_scene_two']['guide_message']);

                            $('#game_scene_previous_id').attr('data-current-scene', 'introduction_scene_two');
                            $('#game_scene_previous_id').attr('data-next-scene', 'introduction_scene_one');

                            $('#game_scene_next_id').attr('data-current-scene', 'introduction_scene_two');
                            $('#game_scene_next_id').attr('data-next-scene', 'introduction_scene_three');
                        }
                        else if( result['data']['introduction_scene_three']['is_current_selected'] == 1)
                        {
                            user_enable_button_previous_scene();
                            user_enable_button_next_scene();

                            user_message_hide();
                            guide_message_show();

                            $('#character_user_message_id').text(result['data']['introduction_scene_three']['user_message']);
                            $('#character_guide_message_id').text(result['data']['introduction_scene_three']['guide_message']);

                            $('#game_scene_previous_id').attr('data-current-scene', 'introduction_scene_three');
                            $('#game_scene_previous_id').attr('data-next-scene', 'introduction_scene_two');

                            $('#game_scene_next_id').attr('data-current-scene', 'introduction_scene_three');
                            $('#game_scene_next_id').attr('data-next-scene', 'introduction_scene_four');
                        }
                        else if( result['data']['introduction_scene_four']['is_current_selected'] == 1)
                        {
                            user_enable_button_previous_scene();
                            
                            if( result['data']['introduction_scene_four']['is_read'] == 0 )
                            {
                                user_enable_button_next_scene();
                            }
                            else
                            {
                                user_disable_button_next_scene();

                                // setTimeout(function()
                                // {
                                //     $('#game_confirm_id').removeClass('customize_displaynone');
                                //     $('#game_confirm_title_id').text('INTRODUCTION');
                                //     $('#game_confirm_text_id').text('Lets Proceed to Chapters');
                                // }, 2000);
                            }

                            user_message_show();
                            guide_message_show();

                            $('#character_user_message_id').text(result['data']['introduction_scene_four']['user_message']);
                            $('#character_guide_message_id').text(result['data']['introduction_scene_four']['guide_message']);

                            $('#game_scene_previous_id').attr('data-current-scene', 'introduction_scene_four');
                            $('#game_scene_previous_id').attr('data-next-scene', 'introduction_scene_three');

                            $('#game_scene_next_id').attr('data-current-scene', 'introduction_scene_four');
                            $('#game_scene_next_id').attr('data-next-scene', 'introduction_scene_four');
                        }
                        else if( result['data']['introduction_scene_four']['is_current_selected'] == 1)
                        {
                            user_enable_button_previous_scene();
                            
                            if( result['data']['introduction_scene_four']['is_read'] == 0 )
                            {
                                user_enable_button_next_scene();
                            }
                            else
                            {
                                user_disable_button_next_scene();

                                setTimeout(function()
                                {
                                    $('#game_confirm_id').removeClass('customize_displaynone');
                                    $('#game_confirm_title_id').text('INTRODUCTION');
                                    $('#game_confirm_text_id').text('Lets Proceed to Chapters');
                                }, 1500);
                            }

                            user_message_show();
                            guide_message_show();

                            $('#character_user_message_id').text(result['data']['introduction_scene_four']['user_message']);
                            $('#character_guide_message_id').text(result['data']['introduction_scene_four']['guide_message']);

                            $('#game_scene_previous_id').attr('data-current-scene', 'introduction_scene_four');
                            $('#game_scene_previous_id').attr('data-next-scene', 'introduction_scene_three');

                            $('#game_scene_next_id').attr('data-current-scene', 'introduction_scene_four');
                            $('#game_scene_next_id').attr('data-next-scene', 'introduction_scene_four');
                        }
                        else
                        {
                            user_disable_button_previous_scene();
                            user_enable_button_next_scene();

                            user_message_hide();
                            guide_message_show();

                            $('#character_user_message_id').text(result['data']['introduction_scene_one']['user_message']);
                            $('#character_guide_message_id').text(result['data']['introduction_scene_one']['guide_message']);

                            $('#game_scene_previous_id').attr('data-current-scene', 'introduction_scene_one');
                            $('#game_scene_previous_id').attr('data-next-scene', 'introduction_scene_one');

                            $('#game_scene_next_id').attr('data-current-scene', 'introduction_scene_one');
                            $('#game_scene_next_id').attr('data-next-scene', 'introduction_scene_two');
                        }
                    }
                    else
                    {
                        alert('Something went wrong.. Please refresh your page');
                    }
                },
                error: function(err)
                {
                    alert('Something went wrong.. Please refresh your page');
                }
            });
        }

        function user_disable_button_next()
        {
            $('#game_next_id').css('pointer-events', 'none');
            $('#game_next_id').css('opacity', 0.3);
        }

        function user_enable_button_next()
        {
            $('#game_next_id').css('pointer-events', 'auto');
            $('#game_next_id').css('opacity', 1);
        }

        function user_disable_button_previous_scene()
        {
            $('#game_scene_previous_id').css('pointer-events', 'none');
            $('#game_scene_previous_id').css('opacity', 0.3);
        }

        function user_enable_button_previous_scene()
        {
            $('#game_scene_previous_id').css('pointer-events', 'auto');
            $('#game_scene_previous_id').css('opacity', 1);
        }

        function user_disable_button_next_scene()
        {
            $('#game_scene_next_id').css('pointer-events', 'none');
            $('#game_scene_next_id').css('opacity', 0.3);
        }

        function user_enable_button_next_scene()
        {
            $('#game_scene_next_id').css('pointer-events', 'auto');
            $('#game_scene_next_id').css('opacity', 1);
        }

        function user_message_show()
        {
            $('#character_user_message_id').css('display', 'block');
        }

        function user_message_hide()
        {
            $('#character_user_message_id').css('display', 'none');
        }

        function guide_message_show()
        {
            $('#character_guide_message_id').css('display', 'block');
        }

        function guide_message_hide()
        {
            $('#character_guide_message_id').css('display', 'none');
        }
    });
    </script>

@endsection