<!DOCTYPE>
<html lang>
    <head>
        <title>Lost Archive - Character Selection</title>

        <script src = "jquery.min.js"></script>

        <link href = "game_loading.css" rel = "stylesheet"/>
        <link href = "flash_screen.css" rel = "stylesheet"/>

        <!-- SELECTION SCREEN STYLE -->
        <style>
        body
        {
            margin: 0px;
            padding: 0px;
            font-family: arial;
            overflow:hidden;
        }
        .selection_background
        {
            /* background-color: black; */
            width: 100%;
            height: 100%;
            z-index: -1;
            position: absolute;
            top: 0px;
            background-image: url("introduction.jpg"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;
        }

        .body_container
        {
            display: grid;
            grid-template-rows: 12% auto 12%;
            height: 100%;
            
        }

        .head_container
        {
            text-align: center;
            background-image: url("bg_header_selection.jpg"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;
            box-shadow: 2px 2px 5px black;
            color: white;
            font-weight: bold;
            font-size: 25px;
            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
            user-select: none;
            text-shadow: 2px 2px 5px black;
        }

        .menu_container
        {
            display: grid;
            grid-template-columns: 500px auto;
            height: 100%;
        }

        .menu_container_box_one
        {
            
            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
            /* border: 2px solid grey; */
            min-height: 200px;
            padding: 20px;
        }
        .menu_container_box_two
        {
            
            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
            /* border: 2px solid grey; */
            min-height: 200px;
            padding: 20px 20px 20px 20px;
            position: relative;
        }

        .menu_container_box_three
        {
            
            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
            /* border: 2px solid grey; */
            min-height: 200px;
            padding: 20px;
        }

        .container_box_one
        {
            height: 50%; width: 100%;
            /* background-color: orange; */
            box-shadow: 2px 2px 5px black;
            position: relative;
            border-radius: 10px;

            background-image: url("comscreen.png"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;
        }

        .container_box_one_title
        {
            position: absolute;
            top: -43px;
            left: -10px;
            width: 103%;
            height: 50px;
            /* background-color: orange; */
            border-radius: 5px;
            box-shadow: 2px 2px 5px black;
            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
            color: white;
            font-weight: bold;
            font-size: 20px;
            user-select: none;
            text-shadow: 1px 1px 2px black;

            background-image: url("bg_header_selection.jpg"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;
        }

        .container_box_one_input_container
        {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            box-shadow: 2px 2px 5px black;
            width: 70%;
        }

        .container_box_one_input
        {
            text-align: center;
            padding: 5px;
            /* box-shadow: 2px 2px 5px black; */
            /* border: 1px solid black; */
            margin: 2px;
            width: 100%;
            outline: none;
            /* border-top-left-radius: 10px;
            border-bottom-right-radius: 10px; */
            font-size: 14px;
            padding: 5px;
            border: none;
            border-bottom: 1px solid white;
            background-color: transparent;
            color: cyan;
        }

        .container_box_one_input::placeholder
        {
            color: cyan;
            opacity: 0.6;
        }

        .container_box_two
        {
            height: 90%; width: 100%;
            /* background-color: #09305c; */
            box-shadow: 2px 2px 5px black;
            border-radius: 10px;
            position: relative;

            background-image: url("comscreen.png"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 110%;

            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
        }

        .container_box_two_title
        {
            position: absolute;
            top: -35px;
            left: -10px;
            width: 101.9%;
            height: 50px;
            /* background-color: #09305c; */
            /* border-radius: 5px; */
            box-shadow: 2px 2px 5px black;
            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
            color: white;
            font-weight: bold;
            font-size: 20px;
            user-select: none;
            text-shadow: 1px 1px 2px black;

            
            background-image: url("bg_header_selection.jpg"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 110%;
        }

        .container_box_two_avatar
        {
            width: 150px;
            height: 73%;   
            margin: 50px 10px 0px 10px;
            border-radius: 50px;
            box-shadow: 0px 10px 5px orange;
            cursor: pointer;
        }

        .container_box_two_avatar:hover
        {
            border: 5px solid #d0f4f5;
            cursor: pointer;
        }

        .container_box_two_avatar_selected
        {
            border: 5px solid red!important;
            cursor: pointer!important;
        }

        .container_box_three
        {
            height: 90%; width: 100%;
            background-color: #405157;
            box-shadow: 2px 2px 5px black;
            border-radius: 10px;
        }

        .foot_container
        {
            text-align: center;
            background-image: url("bg_header_selection.jpg"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 100% 100%;
            box-shadow: 2px 2px 5px black;
            color: white;
            font-weight: bold;
            font-size: 25px;
            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
            user-select: none;
            text-shadow: 2px 2px 5px black;
        }

        .foot_container_button_confirm
        {
            width: 270px;
            height: 30px;
            padding: 5px;
            box-shadow: 1px 1px 5px black;
            /* background-color: #004eb5; */
            border: 1px solid black;
            color: white;
            font-weight: bold;
            font-size: 17px;
            outline: none;

            background-image: url("bg_header_selection.jpg"); /* The image used */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: 110% 110%;
        }

        .foot_container_button_confirm:hover
        {
            border: 1px solid white;
            cursor: pointer;
        }
        </style>

    </head>
    <body>

        <div class = "selection_background">
        </div>

        <div class = "body_container">
            <div class = "head_container">
                Character Selection
            </div>
            <div class = "menu_container">
                <div class = "menu_container_box_one">
                    
                    <div class = "container_box_one">

                        <div class = "container_box_one_title">
                            Enter your Details
                        </div>


                        <div class = "container_box_one_input_container">
                            <input id = "character_name_id" class = "container_box_one_input" type = "text" placeholder = "Enter your Name"/>
                            <input id = "character_year_level_id" class = "container_box_one_input" type = "text" placeholder = "Enter your Year Level"/>
                        </div>
                    </div>
                    
                </div>
                <div class = "menu_container_box_two">
                    
                    <input id = "character_selected_avatar_type_id" type = "hidden" />

                    <div id = "avatar_list_id" class = "container_box_two">
                        <div class = "container_box_two_title">
                            Choose your Avatar
                        </div>


                        <!-- <img class = "container_box_two_avatar select_avatar" src = "Girlavatar.png" alt = "emoji" />
                        <img class = "container_box_two_avatar select_avatar" src = "guyavatar.png" alt = "emoji" /> -->
                    </div>

                </div>
            </div>
            <div class = "foot_container">
                <button id = "selection_proceed_id" class = "foot_container_button_confirm" type = "button">Proceed</button>
            </div>
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

        <div id = "flash_screen_id" class = "flash_screen_container">
            <div class = "flash_screen_background">
            </div>

            <div class = "flash_screen_content">
            </div>
        </div>

        <script>
        $(document).ready(function()
        {
            hide_flash_screen();

            get_master_avatar_list();
            get_character_user_detail();

            $('#selection_proceed_id').on('click', function()
            {
                update_character_user();

                // $('#game_text_id').text('Redirecting to Introduction. Please Wait..');

                // $('#game_loading_id').removeClass('customize_displaynone');

                // setTimeout(function()
                // {
                //     window.location.href = "/introduction";
                // }, 1500);
            });

            function update_character_user()
            {
                
                let character_name = $('#character_name_id').val(),
                    character_year_level = $('#character_year_level_id').val(),
                    character_selected_avatar_type  = $('#character_selected_avatar_type_id').val();

                if(character_name.length < 1)
                {
                    alert('Please enter your name');
                    $('#character_name_id').focus();
                }
                else if(character_year_level.length < 1)
                {
                    alert('Please enter your year level');
                    $('#character_year_level_id').focus();
                }
                else if(character_selected_avatar_type.length < 1)
                {
                    alert('Please select your avatar');
                }
                else
                {
                    $.ajax({
                        url: "/update_user_character_selected?name=" + character_name + "&year_level=" + character_year_level + "&selected_avatar_type=" + character_selected_avatar_type + "&is_selected_avatar=1&is_proceed=1",
                        type: 'get',
                        dataType: 'json',
                        beforeSend: function()
                        {
                            $('#game_loading_id').removeClass('customize_displaynone');
                            $('#game_title_id').text('CHARACTER SELECTION');
                            $('#game_text_id').text('Please wait while updating your detail..');
                        },
                        success: function(result)
                        {
                            if(result['status'] == 200)
                            {
                                setTimeout(function()
                                {
                                    $('#game_title_id').text('CHARACTER SELECTION');
                                    $('#game_text_id').text('Redirecting to Introduction. Please Wait..');

                                    setTimeout(function()
                                    {
                                        window.location.href = "/introduction";
                                    }, 1500);
                                }, 1500);
                            }
                            else
                            {
                                $('#game_loading_id').addClass('customize_displaynone');
                                alert('Something went wrong please refresh your page');
                            }
                        },
                        error: function(err)
                        {
                            $('#game_loading_id').addClass('customize_displaynone');
                            alert('Something went wrong please refresh your page');
                        }
                    });
                }
            }

            function get_character_user_detail()
            {
                $.ajax({
                    url: "/get_user_selected_detail",
                    type: 'get',
                    dataType: 'json',
                    async: false,
                    success: function(result)
                    {
                        if(result['status'] == 200)
                        {
                            $('#character_name_id').val(result['data']['name']);
                            $('#character_year_level_id').val(result['data']['year_level']);
                            $('#character_selected_avatar_type_id').val(result['data']['selected_avatar_type']);

                            $('.select_avatar').each(function()
                            {
                                if($(this).attr('data-avatar-type') == result['data']['selected_avatar_type'])
                                {
                                    $(this).addClass('container_box_two_avatar_selected');
                                }
                            });
                        }
                        else
                        {
                            alert('Something went wrong please refresh your page');
                        }
                    },
                    error: function(err)
                    {
                        alert('Something went wrong please refresh your page');
                    }
                });
            }

            function get_master_avatar_list()
            {
                $.ajax({
                    url: '/master_avatar_list',
                    type: 'get',
                    dataType: 'json',
                    async: false,
                    success: function(result)
                    {
                        if(result['status'] == 200)
                        {
                            let html_img = "";

                            for(i = 0; i < result['data'].length; i++)
                            {
                                html_img += '<img class = "container_box_two_avatar select_avatar" data-avatar-type = "'+ result['data'][i]['avatar_type'] +'" src = "'+ result['data'][i]['avatar_path'] +'" alt = "'+ result['data'][i]['avatar_type'] +'" />';
                            }

                            $('#avatar_list_id').append(html_img);

                            $('.select_avatar').unbind('click');
                            $('.select_avatar').on('click', function()
                            {
                                let avatar_type = $(this).attr('data-avatar-type');

                                $('.select_avatar').each(function()
                                {
                                    $(this).removeClass('container_box_two_avatar_selected');
                                });

                                $(this).addClass('container_box_two_avatar_selected');
                                
                                $('#character_selected_avatar_type_id').val(avatar_type);
                            });
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

            function hide_flash_screen()
            {
                setTimeout(function()
                {
                    $('#flash_screen_id').addClass('flash_screen_displaynone');
                }, 3000);
            }
        });
        </script>
    
    </body>
</html>