@extends('layouts.chapter_layout')

@section('style')

<style>
.chapter_button_box_2
{
    position: absolute;
    top: 55%;
    left: 35%;
    transform: translate(-35%, -55%);

    width: 300px;
    height: 300px;
    
    color: white; 
    font-weight: bold;
    font-size: 17px;

    background-image: url("button.png"); /* The image used */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: 100% 100%;

    cursor: pointer;
}

.chapter_button_box_2:hover 
{
    color: cyan;
    filter: brightness(220%);
}

.chapter_button_box_3
{
    position: absolute;
    top: 15%;
    left: 63%;
    transform: translate(-63%, -15%);

    width: 300px;
    height: 300px;

    color: white; 
    font-weight: bold;
    font-size: 17px;

    background-image: url("button.png"); /* The image used */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: 100% 100%;

    cursor: pointer;
}

.chapter_button_box_3:hover 
{
    color: cyan;
    filter: brightness(220%);
}

.chapter_button_box_1
{
    position: absolute;
    top: 95%;
    left: 63%;
    transform: translate(-63%, -95%);

    width: 300px;
    height: 300px;

    color: white; 
    font-weight: bold;
    font-size: 17px;

    background-image: url("button.png"); /* The image used */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: 100% 100%;

    cursor: pointer;
}

.chapter_button_box_1:hover 
{
    color: cyan;
    filter: brightness(220%);
}

.chapter_label
{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    box-sizing: border-box;
    border-radius: 20px;
}

.chapter_button_box_arrow
{
    position: absolute; 
    top: 50%; 
    left: -50px; 
    transform: translateY(-50%); 
    /* background-color: orange; */
    animation-name: arrow_move;
    animation-iteration-count: infinite;
    animation-duration: 1s;

    width: 120px;
    height: 120px;
}

.chapter_button_box_arrow_image
{
    width: 100%;
    height: 100%;
}

.customize_displaynone
{
    display: none!important;
}

@keyframes arrow_move {
  0%{ left: -50px; }
  15%{ left: -52px; }
  30%{ left: -57px; }
  45%{ left: -62px; }
  50%{ left: -67px; }
  55%{ left: -62px; }
  70%{ left: -57px; }
  85%{ left: -52px; }
  0%{ left: -50px; }
}
</style>

@endsection

@section('content')

    <div id = "game_chapter_two_id" class = "chapter_button_box_2">

        <div class = "chapter_label">
            CHAPTER 2
        </div>

        <div id = "game_chapter_two_arrow_id" class = "chapter_button_box_arrow customize_displaynone">
            <img class = "chapter_button_box_arrow_image" src = "arrow.png"/>
        </div>

    </div>

    <div id = "game_chapter_three_id" class = "chapter_button_box_3">

        <div class = "chapter_label">
            CHAPTER 3
        </div>

        <div id = "game_chapter_three_arrow_id" class = "chapter_button_box_arrow customize_displaynone">
            <img class = "chapter_button_box_arrow_image" src = "arrow.png"/>
        </div>

    </div>

    <div id = "game_chapter_one_id" class = "chapter_button_box_1">
        
        <div class = "chapter_label">
            CHAPTER 1
        </div>

        <div id = "game_chapter_one_arrow_id" class = "chapter_button_box_arrow customize_displaynone">
            <img class = "chapter_button_box_arrow_image" src = "arrow.png"/>
        </div>

    </div>

    <script>
    $(document).ready(function()
    {
        chapter_one_disabled();
        chapter_two_disabled();
        chapter_three_disabled();

        get_user_chapter();

        $('#game_chapter_one_id').on('click', function()
        {
            $('#game_loading_id').removeClass('customize_displaynone');
            $('#game_title_id').text('CHAPTER SELECTION');
            $('#game_text_id').text('Redirecting to Chapter 1. Please Wait..');

            setTimeout(function()
            {
                window.location.href = "/chapter?ch=1";
            }, 1500);
        });

        $('#game_chapter_two_id').on('click', function()
        {
            $('#game_loading_id').removeClass('customize_displaynone');
            $('#game_title_id').text('CHAPTER SELECTION');
            $('#game_text_id').text('Redirecting to Chapter 2. Please Wait..');

            setTimeout(function()
            {
                window.location.href = "/chapter?ch=2";
            }, 1500);
        });

        $('#game_chapter_three_id').on('click', function()
        {
            $('#game_loading_id').removeClass('customize_displaynone');
            $('#game_title_id').text('CHAPTER SELECTION');
            $('#game_text_id').text('Redirecting to Chapter 3. Please Wait..');

            setTimeout(function()
            {
                window.location.href = "/chapter?ch=3";
            }, 1500);
        });

        function get_user_chapter()
        {

            $.ajax({
                url: '/get_user_chapter',
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(result)
                {
                    global_chapter_list = result['data'];

                    if(result['status'] == 200)
                    {
                        let chapter_one_unlocked = result['data']['chapter_one']['is_chapter_unlocked'],
                            chapter_two_unlocked = result['data']['chapter_two']['is_chapter_unlocked'],
                            chapter_three_unlocked = result['data']['chapter_three']['is_chapter_unlocked'];

                        chapter_one_unlocked == 1 ? chapter_one_enabled():chapter_one_disabled();
                        chapter_two_unlocked == 1 ? chapter_two_enabled():chapter_two_disabled();
                        chapter_three_unlocked == 1 ? chapter_three_enabled():chapter_three_disabled();

                        if(chapter_three_unlocked == 1)
                        {
                            arrow_hide_chapter_one();
                            arrow_hide_chapter_two();
                            arrow_show_chapter_three();
                        }
                        else if(chapter_two_unlocked == 1)
                        {
                            arrow_hide_chapter_one();
                            arrow_show_chapter_two();
                            arrow_hide_chapter_three();
                        }
                        else
                        {
                            arrow_show_chapter_one();
                            arrow_hide_chapter_two();
                            arrow_hide_chapter_three();
                        }
                        
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

        function chapter_one_enabled()
        {
            $('#game_chapter_one_id').css('pointer-events', 'auto');
            $('#game_chapter_one_id').css('opacity', 1);
        }

        function chapter_two_enabled()
        {
            $('#game_chapter_two_id').css('pointer-events', 'auto');
            $('#game_chapter_two_id').css('opacity', 1);
        }

        function chapter_three_enabled()
        {
            $('#game_chapter_three_id').css('pointer-events', 'auto');
            $('#game_chapter_three_id').css('opacity', 1);
        }

        function chapter_one_disabled()
        {
            $('#game_chapter_one_id').css('pointer-events', 'none');
            $('#game_chapter_one_id').css('opacity', 0.3);
        }

        function chapter_two_disabled()
        {
            $('#game_chapter_two_id').css('pointer-events', 'none');
            $('#game_chapter_two_id').css('opacity', 0.3);
        }

        function chapter_three_disabled()
        {
            $('#game_chapter_three_id').css('pointer-events', 'none');
            $('#game_chapter_three_id').css('opacity', 0.3);
        }

        function arrow_show_chapter_one()
        {
            $('#game_chapter_one_arrow_id').removeClass('customize_displaynone');
        }

        function arrow_show_chapter_two()
        {
            $('#game_chapter_two_arrow_id').removeClass('customize_displaynone');
        }

        function arrow_show_chapter_three()
        {
            $('#game_chapter_three_arrow_id').removeClass('customize_displaynone');
        }

        function arrow_hide_chapter_one()
        {
            $('#game_chapter_one_arrow_id').addClass('customize_displaynone');
        }

        function arrow_hide_chapter_two()
        {
            $('#game_chapter_two_arrow_id').addClass('customize_displaynone');
        }

        function arrow_hide_chapter_three()
        {
            $('#game_chapter_three_arrow_id').addClass('customize_displaynone');
        }
    });
    </script>

@endsection