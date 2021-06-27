@extends('layouts.chapter_two_layout')

@section('style')

<style>
.characters_container
{
    display: grid;
    grid-template-columns: auto auto;
    height: 100%;
}

.character_guide_container
{
    height: 80%;

    position: relative;
    top: 10%;
    left: 70%;

    transform: translate(-50%, -10%);

    box-sizing: border-box;
}

.character_guide_image_container
{
    position: relative;
    top: 125%;
    left: 30%;
    transform: translate(-30%, -125%);
    height: 70%;
    width: 270px;
}

.character_guide_message
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
    padding: 20px 30px 20px 30px;
    box-sizing: border-box; 
    user-select: none;
    z-index: 9999;

    background-image: url("message_box.png"); /* The image used */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: 100% 100%;

    text-align: center;
    font-size: 17px;
}

.character_guide_image
{
    position: absolute;
    top: 0px;
    height: 100%;
    width: 100%;
}

.character_user_container
{
    height: 80%;

    position: relative;
    top: 90%;
    left: 50%;

    transform: translate(-50%, -90%);

    box-sizing: border-box;
}

.character_user_image_container
{
    position: relative;
    top: 60%;
    left: 35%;
    transform: translate(-35%, -60%);
    height: 70%;
    width: 200px;
}

.character_user_message
{
    position: absolute;
    top: -170px;
    left: -150px;
    /* transform: translateY(30%); */
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

.character_user_image
{
    position: absolute;
    top: 0px;
    height: 100%;
    width: 100%;
}

.character_scene_container
{
    position: absolute;
    bottom: 5%;
    left: 50%;
    transform: translate(-50%);

    width: 30%;
    height: 5%;

    display: grid;

    grid-template-columns: auto auto;      
    grid-gap: 10px;

    text-align: center;

    z-index: 99999999;
}

.character_scene_previous_button
{
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    border-top-left-radius: 50px;
    border-bottom-left-radius: 50px;

    font-size: 16px;
    font-weight: bold;
    color: white;

    background-color: #121975;
    border: 1px solid blue;
    box-shadow: 2px 2px 10px black;
}

.character_scene_previous_button:hover
{
    cursor: pointer;
    box-shadow: 2px 2px 20px black;
    color: cyan;
}

.character_scene_next_button
{
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    border-top-right-radius: 50px;
    border-bottom-right-radius: 50px;

    font-size: 16px;
    font-weight: bold;
    color: white;

    background-color: #121975;
    border: 1px solid blue;
    box-shadow: 2px 2px 10px black;
}

.character_scene_next_button:hover
{
    cursor: pointer;
    box-shadow: 2px 2px 20px black;
    color: cyan;
}

</style>

<style>

.find_container_box
{
    position: absolute;
    top: 5%;
    left: 10%;

    width: 250px; 
    height: auto;
    background-color: white;

    padding: 10px;
    box-sizing: border-box;

    text-align: center;
    font-size: 20px;

    line-height: 35px;
}

.object_container_1
{
    position: absolute;
    top: 85%;
    left: 83%;
    transform: translate(-83%, -85%);
}

.object_container_1_img
{
    width: 60px;
    height: 70px;
    filter: brightness(120%);
    cursor: pointer;
}

.object_container_1_img:hover
{
    filter: brightness(150%);
}

.object_container_1_dialog
{
    position: absolute;
    top: 10px;
    left: -370px;

    height: 100px;
    width: 350px;
    background-color: white;
    box-sizing: border-box;
    padding: 10px;

    font-size: 17px;
    text-align: center;
}

.object_container_2
{
    position: absolute;
    top: 22%;
    left: 40%;
    transform: translate(-40%, -22%);
}

.object_container_2_img
{
    width: 140px;
    height: 90px;
    filter: brightness(120%);
    cursor: pointer;
}

.object_container_2_img:hover
{
    filter: brightness(150%);
}

.object_container_2_dialog
{
    position: absolute;
    top: 10px;
    left: 200px;

    height: 100px;
    width: 350px;
    background-color: white;
    box-sizing: border-box;
    padding: 10px;

    font-size: 17px;
    text-align: center;
}

.object_container_3
{
    position: absolute;
    top: 59%;
    left: 24%;
    transform: translate(-24%, -59%);
}

.object_container_3_img
{
    width: 70px;
    height: 50px;
    filter: brightness(120%);
    cursor: pointer;
}

.object_container_3_img:hover
{
    filter: brightness(150%);
}

.object_container_3_dialog
{
    position: absolute;
    top: -15px;
    left: 130px;

    height: 100px;
    width: 350px;
    background-color: white;
    box-sizing: border-box;
    padding: 10px;

    font-size: 17px;
    text-align: center;
}

.object_container_4
{
    position: absolute;
    top: 49%;
    left: 75%;
    transform: translate(-75%, -49%);
}

.object_container_4_img
{
    width: 160px;
    height: 80px;
    filter: brightness(120%);
    cursor: pointer;
}

.object_container_4_img:hover
{
    filter: brightness(150%);
}

.object_container_4_dialog
{
    position: absolute;
    top: 10px;
    left: -390px;

    height: 100px;
    width: 350px;
    background-color: white;
    box-sizing: border-box;
    padding: 10px;

    font-size: 17px;
    text-align: center;
}

.object_selected
{
    box-sizing: border-box; 
    padding: 15px; 
    border-radius: 50%; 
    border: 5px double white;
}

</style>

<style>
.customize_colorgray
{
    color: #f2f0ed!important;
}
.customize_colorgreen
{
    color: green!important;
}

</style>

<style>
table
{
    width: 100%!important;
}
table td
{
    font-size: 20px;
    text-align: center;
}
</style>

<style>
    .customize_hide_element
    {
        display: none!important;
    }
</style>

<style>
.proceed_button
{
    width: 250px;
    height: 250px;
    
    position: absolute;

    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    background-image: url("button.png"); /* The image used */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: 100% 100%;
    cursor: pointer;
}

.proceed_button_text
{
    position: absolute; 
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%);
    color: white;
    font-weight: bold;
    user-select: none;
    font-size: 21px;

    text-align: center;
}

.proceed_button:hover 
{
    color: cyan;
    filter: brightness(220%);
}
</style>

@endsection

@section('content')

<div id = "game_prompt_id" class = "game_prompt_container customize_hide_element">
    <!-- <div class = "game_prompt_background">
    </div> -->
    <div class = "game_prompt_content">

        <div id = "game_title_id" class = "game_prompt_content_title">
        </div>

        <div id = "game_text_id" class = "game_prompt_content_text">
        </div>

    </div>
</div>

<div id = "game_prompt_question_id" class = "game_prompt_question_container customize_hide_element">
    <!-- <div class = "game_prompt_background">
    </div> -->
    <div class = "game_prompt_question_content">

        <div id = "game_question_title_id" class = "game_prompt_question_content_title">
        </div>

        <textarea id = "game_question_text_id" class = "game_prompt_question_content_text"></textarea>

        <div class = "game_prompt_question_content_note">
            <div class = "game_prompt_question_content_note_left">Note:</div> <div class = "game_prompt_question_content_note_right">Take a screenshot of your answer and <br/>
            place it in a folder.<br/>
            You will send it later to my email.</div>
        </div>

    </div>
</div>

<div id = "game_prompt_assessment_id" class = "game_prompt_assessment_container customize_hide_element">
    <!-- <div class = "game_prompt_background">
    </div> -->
    <div class = "game_prompt_assessment_content">

        <div id = "game_assessment_title_id" class = "game_prompt_assessment_content_title">
        </div>

        <div id = "game_assessment_text_id" class = "game_prompt_assessment_content_text">

            <!-- <div><input class = "assessment_select" data-assessment-id = "" data-assessment-letter = "" type = "radio"/> a) More Distant</div>
            <div><input class = "assessment_select" data-assessment-id = "" data-assessment-letter = "" type = "radio"/> b) Outside the understanding</div>
            <div><input class = "assessment_select" data-assessment-id = "" data-assessment-letter = "" type = "radio"/> c) Superior to anyone</div>
            <div><input class = "assessment_select" data-assessment-id = "" data-assessment-letter = "" type = "radio"/> d) Limitless space</div> -->

        </div>

        <button id = "game_assessment_next_id" data-assessment-question-current-scene-id = "" data-assessment-question-next-scene-id = "" class = "game_prompt_assessment_content_button" type = "button">Next</button>

    </div>
</div>

<div id = "game_prompt_assessment_result_id" class = "game_prompt_assessment_result_container customize_hide_element">
    <!-- <div class = "game_prompt_background">
    </div> -->
    <div class = "game_prompt_assessment_result_content">

        <div id = "game_assessment_result_title_id" class = "game_prompt_assessment_result_content_title">
        </div>

        <div id = "game_assessment_result_text_id" class = "game_prompt_assessment_result_content_text">

            <!-- <div><input class = "assessment_select" data-assessment-id = "" data-assessment-letter = "" type = "radio"/> a) More Distant</div>
            <div><input class = "assessment_select" data-assessment-id = "" data-assessment-letter = "" type = "radio"/> b) Outside the understanding</div>
            <div><input class = "assessment_select" data-assessment-id = "" data-assessment-letter = "" type = "radio"/> c) Superior to anyone</div>
            <div><input class = "assessment_select" data-assessment-id = "" data-assessment-letter = "" type = "radio"/> d) Limitless space</div> -->

        </div>

        <button id = "game_assessment_result_revert_id" data-assessment-revert-current-scene-id = "" class = "game_prompt_assessment_result_content_button customize_prompt_assessment_result_backgroundgreen customize_hide_element" type = "button">Go back to Chapter 2 <i class="fa fa-undo"></i></button>
        <button id = "game_assessment_result_next_id" data-assessment-result-current-scene-id = "" data-assessment-result-next-scene-id = "" class = "game_prompt_assessment_result_content_button customize_hide_element" type = "button">Proceed to Chapters <i class="fa fa-check"></i></button>

    </div>
</div>

<div id = "proceed_id" data-poem-current-scene-id = "" data-poem-next-scene-id = "" class = "proceed_button customize_hide_element">
    <div class = "proceed_button_text">Click to read the poem</div>
</div>

<div id = "enter_id" data-assessment-current-scene-id = "" data-assessment-next-scene-id = "" class = "proceed_button customize_hide_element">
    <div class = "proceed_button_text">Enter</div>
</div>

<div id = "find_object_container_id" class = "customize_hide_element">

    <div class = "object_container_1">
        <div data-object-image-id = "4" data-chapter-scene-id = "4" class = "object_dialog_image">
            <img class = "object_container_1_img" src = "blanket.png"/>
        </div>

        <div data-object-dialog-id = "4" class = "object_container_1_dialog object_dialog customize_hide_element">
        </div>
    </div>

    <div class = "object_container_2">
        <div data-object-image-id = "3" data-chapter-scene-id = "4" class = "object_dialog_image">
            <img class = "object_container_2_img" src = "pine_cone.png"/>
        </div>

        <div data-object-dialog-id = "3" class = "object_container_2_dialog object_dialog customize_hide_element">
        </div>
    </div>

    <div class = "object_container_3">
        <div data-object-image-id = "2" data-chapter-scene-id = "4" class = "object_dialog_image">
            <img class = "object_container_3_img" src = "present.png"/>
        </div>

        <div data-object-dialog-id = "2" class = "object_container_3_dialog object_dialog customize_hide_element">
        </div>
    </div>
    
    <div class = "object_container_4">
        <div data-object-image-id = "1" data-chapter-scene-id = "4" class = "object_dialog_image">
            <img class = "object_container_4_img" src = "stop_sign.png"/>
        </div>

        <div data-object-dialog-id = "1" class = "object_container_4_dialog object_dialog customize_hide_element">
        </div>
    </div>

    <div class = "find_container_box">

        <div>Find the objects</div>

        <br/>

        <div>
            <table>
                <tr>
                    <td>Stop sign</td>
                    <td><i data-object-box-id = "1" class = "fa fa-check customize_colorgray"></i></td>
                </tr>
                <tr>
                    <td>Present</td>
                    <td><i data-object-box-id = "2" class = "fa fa-check customize_colorgray"></i></td>
                </tr>
                <tr>
                    <td>Pine cone</td>
                    <td><i data-object-box-id = "3" class = "fa fa-check customize_colorgray"></i></td>
                </tr>
                <tr>
                    <td>Blanket</td>
                    <td><i data-object-box-id = "4" class = "fa fa-check customize_colorgray"></i></td>
                </tr>
            </table>
        </div>

    </div>

</div>


<div id = "character_container_id" class = "characters_container customize_hide_element">
    <div>

        <div class = "character_guide_container">

            <div class = "character_guide_image_container">

                <div id = "character_guide_message_id" class = "character_guide_message">
                </div>

                <img class = "character_guide_image" src = "guide.png" alt = "girl avatar"/>

            </div>

        </div>

    </div>
    <div>

        <div class = "character_user_container">

            <div class = "character_user_image_container">

                <div id = "character_user_message_id" class = "character_user_message">
                </div>

                <img id = "character_user_image_id" class = "character_user_image" alt = "girl avatar"/>

            </div>

        </div>

    </div>
</div>

<div class = "character_scene_container">
    <div>
        <button id = "game_scene_previous_id" class = "character_scene_previous_button" data-current-scene-id = "" data-next-scene-id = "" type = "button">
            Previous
        </button>
    </div>
    <div>
        <button id = "game_scene_next_id" class = "character_scene_next_button" data-current-scene-id = "" data-next-scene-id = ""
        data-next-scene-type = "" type = "button">
            Next&emsp;
        </button>
    </div>
</div>

<script>
$(document).ready(function()
{
    var global_chapter_list = [];

    get_user_chapter();

    $('.object_dialog_image').unbind('click');
    $('.object_dialog_image').click(function()
    {
        let id = $(this).attr('data-object-image-id');
        let chapter_scene_id = $(this).attr('data-chapter-scene-id');

        $('.object_dialog_image').each(function()
        {
            if($(this).attr('data-object-image-id') != id)
            {
                $(this).removeClass('object_selected');
            }
        });

        $('.object_dialog').each(function()
        {
            if($(this).attr('data-object-dialog-id') != id)
            {
                $(this).addClass('customize_hide_element');
            }
        });

        if($(this).hasClass( "object_selected" ))
        {
            $(this).removeClass('object_selected');
            $('div[data-object-dialog-id="'+ id +'"]').addClass('customize_hide_element');
        }
        else
        {
            $(this).addClass('object_selected');
            $('div[data-object-dialog-id="'+ id +'"]').removeClass('customize_hide_element');

            for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
            {
                if(chapter_scene_id == global_chapter_list['chapter_two']['chapter_scenes'][i]['id'])
                {
                    for(j = 0; j < global_chapter_list['chapter_two']['chapter_scenes'][i]['find_object'].length; j++)
                    {
                        if(id == global_chapter_list['chapter_two']['chapter_scenes'][i]['find_object'][j]['id'])
                        {
                            $('div[data-object-dialog-id="'+ id +'"]').text(global_chapter_list['chapter_two']['chapter_scenes'][i]['find_object'][j]['message']);

                            global_chapter_list['chapter_two']['chapter_scenes'][i]['find_object'][j]['is_read'] = 1;
                        }
                    }
                }
            }

            update_user_chapter();
        }

    });

    $('#game_scene_previous_id').on('click', function()
    {
        let current_scene = $(this).attr('data-current-scene-id'),
            next_scene = $(this).attr('data-next-scene-id');

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 0;
        }

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            let id = global_chapter_list['chapter_two']['chapter_scenes'][i]['id'];

            if(current_scene == id)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['is_read'] = 1;
            }

            if(next_scene == id)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 1;
            }
        }

        update_user_chapter();
    });

    $('#game_scene_next_id').on('click', function()
    {
        let current_scene = $(this).attr('data-current-scene-id'),
            next_scene = $(this).attr('data-next-scene-id'),
            next_scene_type = $(this).attr('data-next-scene-type');

        if(next_scene_type == "is_poem_question")
        {
            if($('#game_question_text_id').val().length < 1)
            {
                alert('Please do not leave blank your answer');
                $('#game_question_text_id').focus();
                return false;
            }
        }
        
        
        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 0;
        }

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            let id = global_chapter_list['chapter_two']['chapter_scenes'][i]['id'];

            if(current_scene == id)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['is_read'] = 1;
                
                if(next_scene_type == "is_poem_question")
                {
                    global_chapter_list['chapter_two']['chapter_scenes'][i]['poem_question_and_answer']['answer'] = $('#game_question_text_id').val();
                }
            }

            if(next_scene == id)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 1;
            }
        }

        update_user_chapter();
    });

    $('#proceed_id').on('click', function()
    {
        let current_scene = $(this).attr('data-poem-current-scene-id'),
            next_scene = $(this).attr('data-poem-next-scene-id');

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 0;
        }

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            let id = global_chapter_list['chapter_two']['chapter_scenes'][i]['id'];

            if(current_scene == id)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['is_read'] = 1;
            }

            if(next_scene == id)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 1;
            }
        }

        update_user_chapter();
    });

    $('#enter_id').on('click', function()
    {
        let current_scene = $(this).attr('data-assessment-current-scene-id'),
            next_scene = $(this).attr('data-assessment-next-scene-id');

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 0;
        }

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            let id = global_chapter_list['chapter_two']['chapter_scenes'][i]['id'];

            if(current_scene == id)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['is_read'] = 1;
            }

            if(next_scene == id)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 1;
            }
        }

        update_user_chapter();
    });

    $('#game_assessment_next_id').on('click', function()
    {
        let current_scene = $(this).attr('data-assessment-question-current-scene-id'),
            next_scene = $(this).attr('data-assessment-question-next-scene-id');
        
        let letter_chosen = "",
            is_chosen = false;

        $('.assessment_select').each(function()
        {
            if($(this).is(':checked') == true)
            {
                letter_chosen = $(this).attr('data-assessment-letter');
                is_chosen = true;
            }
        });

        if(is_chosen == true)
        {
            for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
            {
                for(j = 0; j < global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'].length; j++)
                {
                    global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['is_current_selected'] = 0;
                }
            }

            for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
            {
                for(j = 0; j < global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'].length; j++)
                {
                    let id = global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['id'];

                    if(current_scene == id)
                    {
                        global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['is_read'] = 1;

                        if(letter_chosen == "a")
                        {
                            global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['answer'] = letter_chosen;
                        }
                        else if(letter_chosen == "b")
                        {
                            global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['answer'] = letter_chosen;
                        }
                        else if(letter_chosen == "c")
                        {
                            global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['answer'] = letter_chosen;
                        }
                        else if(letter_chosen == "d")
                        {
                            global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['answer'] = letter_chosen;
                        }
                    }

                    if(next_scene == id)
                    {
                        global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['is_current_selected'] = 1;
                    }
                }
            }

            update_user_chapter();
        }
        else
        {
            alert('Please do not leave blank your answer');
        }
        
    });

    $('#game_assessment_result_revert_id').on('click', function()
    {
        let current_scene_id = $(this).attr('data-assessment-revert-current-scene-id');

        $('i[data-object-box-id]').removeClass('customize_colorgreen');
        $('i[data-object-box-id]').addClass('customize_colorgray');

        $('.object_dialog_image').removeClass('object_selected');
        $('.object_dialog').addClass('customize_hide_element');

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            global_chapter_list['chapter_two']['chapter_scenes'][i]['is_read'] = 0;
            global_chapter_list['chapter_two']['chapter_scenes'][i]['is_current_selected'] = 0;
        }

        for(i = 0; i < global_chapter_list['chapter_two']['chapter_scenes'].length; i++)
        {
            if(global_chapter_list['chapter_two']['chapter_scenes'][i]['poem_question_and_answer'] != null)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['poem_question_and_answer']['answer'] = '';
            }

            for(j = 0; j < global_chapter_list['chapter_two']['chapter_scenes'][i]['find_object'].length; j++)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['find_object'][j]['is_read'] = 0;
                global_chapter_list['chapter_two']['chapter_scenes'][i]['find_object'][j]['is_current_selected'] = 0;
            }

            for(j = 0; j < global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'].length; j++)
            {
                global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['answer'] = '';
                global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['is_read'] = 0;
                global_chapter_list['chapter_two']['chapter_scenes'][i]['assessment'][j]['is_current_selected'] = 0;
            }
        }

        update_user_chapter();
    });

    $('#game_assessment_result_next_id').on('click', function()
    {
        global_chapter_list['chapter_three']['is_chapter_unlocked'] = 1;

        update_user_chapter_unlocked();
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
                    let chapter_list = result['data']['chapter_two']['chapter_scenes'],
                        chapter_two_answer_key_list = result['data']['chapter_two']['assessment_answer_keys'];

                    if(chapter_list.length > 0)
                    {
                        for(i = 0; i < chapter_list.length; i++)
                        {
                            let chapter_scene_id = chapter_list[i]['id'],
                                is_read = chapter_list[i]['is_read'],
                                is_current_selected = chapter_list[i]['is_current_selected'];

                            if(is_read == 0)
                            {
                                chapter_process(chapter_scene_id, chapter_list, chapter_two_answer_key_list);
                            }
                            else
                            {
                                if(is_current_selected == 1)
                                {
                                    chapter_process(chapter_scene_id, chapter_list, chapter_two_answer_key_list);
                                }
                            }
                        }
                    }
                    else
                    {
                        alert('Something went wrong.. Please refresh your page');
                    }

                    $('#character_user_image_id').attr('src', result['user_avatar']);
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

    function chapter_process(chapter_scene_id, chapter_list, chapter_two_answer_key_list)
    {
        for(i = 0; i < chapter_list.length; i++)
        {
            let id = chapter_list[i]['id'],
                chapter_number = chapter_list[i]['chapter_number'],
                user_message = chapter_list[i]['user_message'],
                guide_message = chapter_list[i]['guide_message'],
                title = chapter_list[i]['title'],
                subtitle = chapter_list[i]['subtitle'],
                find_object = chapter_list[i]['find_object'],
                prompt_message = chapter_list[i]['prompt_message'],
                poem_question_and_answer = chapter_list[i]['poem_question_and_answer'],
                assessment = chapter_list[i]['assessment'],
                is_conversation = chapter_list[i]['is_conversation'],
                is_prompt = chapter_list[i]['is_prompt'],
                is_find_object = chapter_list[i]['is_find_object'],
                is_poem_proceed = chapter_list[i]['is_poem_proceed'],
                is_poem_question = chapter_list[i]['is_poem_question'],
                is_assessment_proceed = chapter_list[i]['is_assessment_proceed'],
                is_assessment_question = chapter_list[i]['is_assessment_question'],
                is_read = chapter_list[i]['is_read'],
                is_current_selected = chapter_list[i]['is_current_selected'];
            
            if(id == chapter_scene_id)
            {
                let compute_previous_current_scene = parseInt(i),
                    compute_previous_next_scene = (parseInt(i) - 1),
                    compute_next_current_scene = parseInt(i),
                    compute_next_next_scene = (parseInt(i) + 1);

                    compute_previous_next_scene = compute_previous_next_scene < 1 ? 0:compute_previous_next_scene;
                    compute_next_next_scene = compute_next_next_scene >= chapter_list.length ? compute_next_current_scene:compute_next_next_scene;

                let previous_data_current_scene = chapter_list[compute_previous_current_scene]['id'],
                    previous_data_next_scene = chapter_list[compute_previous_next_scene]['id'],
                    next_data_current_scene = chapter_list[compute_next_current_scene]['id'],
                    next_data_next_scene = chapter_list[compute_next_next_scene]['id'];

                if(is_conversation == 1)
                {
                    hide_game_prompt();
                    hide_game_prompt_question();
                    hide_find_object();
                    show_character_conversation();
                    hide_proceed();
                    hide_enter();
                    hide_game_prompt_assessment();
                    hide_game_prompt_assessment_result();
                    
                    user_message.length < 1 ? user_message_hide(): user_message_show();
                    guide_message.length < 1 ? guide_message_hide(): guide_message_show();

                    (i == 0 || i < 1 ) ? user_disable_button_previous_scene():user_enable_button_previous_scene();
                    (i > (chapter_list.length - 1) ) ? user_disable_button_next_scene(): user_enable_button_next_scene();

                    $('#character_user_message_id').text(user_message);
                    $('#character_guide_message_id').text(guide_message);

                    $('#game_scene_previous_id').attr('data-current-scene-id', previous_data_current_scene);
                    $('#game_scene_previous_id').attr('data-next-scene-id', previous_data_next_scene);

                    $('#game_scene_next_id').attr('data-current-scene-id', next_data_current_scene);
                    $('#game_scene_next_id').attr('data-next-scene-id', next_data_next_scene);

                    $('#game_scene_next_id').attr('data-next-scene-type', "");
                }
                else if(is_prompt == 1)
                {
                    show_game_prompt();
                    hide_game_prompt_question();
                    hide_find_object();
                    hide_character_conversation();
                    hide_proceed();
                    hide_enter();
                    hide_game_prompt_assessment();
                    hide_game_prompt_assessment_result();

                    (i == 0 || i < 1 ) ? user_disable_button_previous_scene():user_enable_button_previous_scene();
                    (i > (chapter_list.length - 1) ) ? user_disable_button_next_scene(): user_enable_button_next_scene();

                    let message = "";

                    for(j = 0; j < prompt_message.length; j++)
                    {
                        message += prompt_message[j] + '<br/><br/>';
                    }

                    $('#game_title_id').text(title);
                    $('#game_text_id').html(message);

                    $('#game_scene_previous_id').attr('data-current-scene-id', previous_data_current_scene);
                    $('#game_scene_previous_id').attr('data-next-scene-id', previous_data_next_scene);

                    $('#game_scene_next_id').attr('data-current-scene-id', next_data_current_scene);
                    $('#game_scene_next_id').attr('data-next-scene-id', next_data_next_scene);

                    $('#game_scene_next_id').attr('data-next-scene-type', "");
                }
                else if(is_find_object == 1)
                {
                    hide_game_prompt();
                    hide_game_prompt_question();
                    show_find_object();
                    hide_character_conversation();
                    hide_proceed();
                    hide_enter();
                    hide_game_prompt_assessment();
                    hide_game_prompt_assessment_result();

                    for(j = 0; j < chapter_list[i]['find_object'].length; j++)
                    {  
                        if(chapter_list[i]['find_object'][j]['is_read'] == 1)
                        {
                            $('i[data-object-box-id="'+ chapter_list[i]['find_object'][j]['id'] +'"]').addClass('customize_colorgreen');
                            $('i[data-object-box-id="'+ chapter_list[i]['find_object'][j]['id'] +'"]').removeClass('customize_colorgray');
                        }
                        else
                        {
                            $('i[data-object-box-id="'+ chapter_list[i]['find_object'][j]['id'] +'"]').removeClass('customize_colorgreen');
                            $('i[data-object-box-id="'+ chapter_list[i]['find_object'][j]['id'] +'"]').addClass('customize_colorgray');
                        }
                    }

                    (i == 0 || i < 1 ) ? user_disable_button_previous_scene():user_enable_button_previous_scene();

                    let is_found_all_object = false;

                    for(j = 0; j < chapter_list[i]['find_object'].length; j++)
                    {
                        if(chapter_list[i]['find_object'][j]['is_read'] == 0)
                        {
                            is_found_all_object = false;
                            break;
                        }
                        else
                        {
                            is_found_all_object = true;
                        }
                    }

                    if(is_found_all_object == true)
                    {
                        (i > (chapter_list.length - 1) ) ? user_disable_button_next_scene(): user_enable_button_next_scene();
                    }
                    else
                    {
                        user_disable_button_next_scene();
                    }

                    $('#game_scene_previous_id').attr('data-current-scene-id', previous_data_current_scene);
                    $('#game_scene_previous_id').attr('data-next-scene-id', previous_data_next_scene);

                    $('#game_scene_next_id').attr('data-current-scene-id', next_data_current_scene);
                    $('#game_scene_next_id').attr('data-next-scene-id', next_data_next_scene);

                    $('#game_scene_next_id').attr('data-next-scene-type', "");
                }
                else if(is_poem_proceed == 1)
                {
                    hide_game_prompt();
                    hide_game_prompt_question();
                    hide_find_object();
                    hide_character_conversation();
                    show_proceed();
                    hide_enter();
                    hide_game_prompt_assessment();
                    hide_game_prompt_assessment_result();

                    (i == 0 || i < 1 ) ? user_disable_button_previous_scene():user_enable_button_previous_scene();
                    // (i > (chapter_list.length - 1) ) ? user_disable_button_next_scene(): user_enable_button_next_scene();
                    user_disable_button_next_scene();

                    $('#game_scene_previous_id').attr('data-current-scene-id', previous_data_current_scene);
                    $('#game_scene_previous_id').attr('data-next-scene-id', previous_data_next_scene);

                    $('#game_scene_next_id').attr('data-current-scene-id', next_data_current_scene);
                    $('#game_scene_next_id').attr('data-next-scene-id', next_data_next_scene);

                    $('#game_scene_next_id').attr('data-next-scene-type', "");

                    $('#proceed_id').attr('data-poem-current-scene-id', next_data_current_scene);
                    $('#proceed_id').attr('data-poem-next-scene-id', next_data_next_scene);
                }
                else if(is_poem_question == 1)
                {
                    show_game_prompt();
                    show_game_prompt_question();
                    hide_find_object();
                    hide_character_conversation();
                    hide_proceed();
                    hide_enter();
                    hide_game_prompt_assessment();
                    hide_game_prompt_assessment_result();

                    (i == 0 || i < 1 ) ? user_disable_button_previous_scene():user_enable_button_previous_scene();
                    (i > (chapter_list.length - 1) ) ? user_disable_button_next_scene(): user_enable_button_next_scene();

                    let question = poem_question_and_answer['question'],
                        answer = poem_question_and_answer['answer'];

                    $('#game_question_title_id').text(question);
                    $('#game_question_text_id').val(answer);

                    $('#game_scene_previous_id').attr('data-current-scene-id', previous_data_current_scene);
                    $('#game_scene_previous_id').attr('data-next-scene-id', previous_data_next_scene);

                    $('#game_scene_next_id').attr('data-current-scene-id', next_data_current_scene);
                    $('#game_scene_next_id').attr('data-next-scene-id', next_data_next_scene);

                    $('#game_scene_next_id').attr('data-next-scene-type', "is_poem_question");
                }
                else if(is_assessment_proceed == 1)
                {
                    hide_game_prompt();
                    hide_game_prompt_question();
                    hide_find_object();
                    hide_character_conversation();
                    hide_proceed();
                    show_enter();
                    hide_game_prompt_assessment();
                    hide_game_prompt_assessment_result();

                    (i == 0 || i < 1 ) ? user_disable_button_previous_scene():user_enable_button_previous_scene();
                    // (i > (chapter_list.length - 1) ) ? user_disable_button_next_scene(): user_enable_button_next_scene();
                    user_disable_button_next_scene();

                    $('#game_scene_previous_id').attr('data-current-scene-id', previous_data_current_scene);
                    $('#game_scene_previous_id').attr('data-next-scene-id', previous_data_next_scene);

                    $('#game_scene_next_id').attr('data-current-scene-id', next_data_current_scene);
                    $('#game_scene_next_id').attr('data-next-scene-id', next_data_next_scene);
                    
                    $('#game_scene_next_id').attr('data-next-scene-type', "");

                    $('#enter_id').attr('data-assessment-current-scene-id', next_data_current_scene);
                    $('#enter_id').attr('data-assessment-next-scene-id', next_data_next_scene);
                }
                else if(is_assessment_question == 1)
                {
                    hide_game_prompt();
                    hide_game_prompt_question();
                    hide_find_object();
                    hide_character_conversation();
                    hide_proceed();
                    hide_enter();
                    show_game_prompt_assessment();
                    hide_game_prompt_assessment_result();

                    (i == 0 || i < 1 ) ? user_disable_button_previous_scene():user_enable_button_previous_scene();
                    // (i > (chapter_list.length - 1) ) ? user_disable_button_next_scene(): user_enable_button_next_scene();
                    user_disable_button_next_scene();

                    let html = "",
                        question = "";
                    
                    let compute_assessment_previous_current_scene = 0,
                        compute_assessment_previous_next_scene = 0,
                        compute_assessment_next_current_scene = 0,
                        compute_assessment_next_next_scene = 0;
                    
                    let previous_assessment_data_current_scene = 0,
                        previous_assessment_data_next_scene = 0,
                        next_assessment_data_current_scene = 0,
                        next_assessment_data_next_scene = 0;

                    let assessment_all_answered = false;

                    for(j = 0; j < assessment.length; j++)
                    {
                        if(assessment[j]['is_read'] == 1)
                        {
                            assessment_all_answered = true;
                        }
                        else
                        {
                            assessment_all_answered = false;
                            break;
                        }
                    }

                    if(assessment_all_answered == true)
                    {
                        show_game_prompt_assessment_result();
                        hide_game_prompt_assessment();

                        let total_correct_answer = 0;
                        let answer_keys = '';

                        for(j = 0; j < assessment.length; j++)
                        {
                            for(k = 0; k < chapter_two_answer_key_list.length; k++)
                            {
                                if(assessment[j]['id'] == chapter_two_answer_key_list[k]['id'])
                                {
                                    if(assessment[j]['answer'] == chapter_two_answer_key_list[k]['answer'])
                                    {
                                        total_correct_answer++; 
                                    }

                                    break;
                                }
                            }
                        }

                        for(j = 0; j < chapter_two_answer_key_list.length; j++)
                        {
                            answer_keys += chapter_two_answer_key_list[j]['id'] + '. ' + chapter_two_answer_key_list[j]['answer'].toUpperCase() + ' ';
                        }

                        if(total_correct_answer >= 6)
                        {
                            $('#game_assessment_result_title_id').html('Great job! Proceed to chapter 3.');
                            $('#game_assessment_result_text_id').html(total_correct_answer + '/' + assessment.length + ' <br/><br/>Answer key:<br/>' + answer_keys);

                            $('#game_assessment_result_revert_id').attr('data-assessment-revert-current-scene-id', '');

                            $('#game_assessment_result_revert_id').addClass('customize_hide_element');
                            $('#game_assessment_result_next_id').removeClass('customize_hide_element');
                        }
                        else
                        {
                            $('#game_assessment_result_title_id').text('Oh! I wonder what items you forgot. Let’s have another attempt.');
                            $('#game_assessment_result_text_id').html(total_correct_answer + '/' + assessment.length);

                            $('#game_assessment_result_revert_id').attr('data-assessment-revert-current-scene-id', next_data_current_scene);

                            $('#game_assessment_result_revert_id').removeClass('customize_hide_element');
                            $('#game_assessment_result_next_id').addClass('customize_hide_element');
                        }
                    }
                    else
                    {
                        console.log('not yet all answered');
                    }

                    for(j = 0; j < assessment.length; j++)
                    {
                        if(assessment[j]['is_read'] == 0 || assessment[j]['is_current_selected'] == 1)
                        {
                            html += '<div><input class = "assessment_select" data-assessment-id = "'+ assessment[j]['id'] +'" data-assessment-letter = "a" type = "radio"/> '+ 'a) ' + assessment[j]['a'] + '</div>';
                            html += '<div><input class = "assessment_select" data-assessment-id = "'+ assessment[j]['id'] +'" data-assessment-letter = "b" type = "radio"/> '+ 'b) ' + assessment[j]['b'] + '</div>';
                            html += '<div><input class = "assessment_select" data-assessment-id = "'+ assessment[j]['id'] +'" data-assessment-letter = "c" type = "radio"/> '+ 'c) ' + assessment[j]['c'] + '</div>';
                            html += '<div><input class = "assessment_select" data-assessment-id = "'+ assessment[j]['id'] +'" data-assessment-letter = "d" type = "radio"/> '+ 'd) ' + assessment[j]['d'] + '</div>';

                            question = assessment[j]['id'] + '. ' + assessment[j]['question'];

                            compute_assessment_previous_current_scene = parseInt(j);
                            compute_assessment_previous_next_scene = (parseInt(j) - 1);
                            compute_assessment_next_current_scene = parseInt(j);
                            compute_assessment_next_next_scene = (parseInt(j) + 1);

                            compute_assessment_previous_next_scene = compute_assessment_previous_next_scene < 1 ? 0:compute_assessment_previous_next_scene;
                            compute_assessment_next_next_scene = compute_assessment_next_next_scene >= assessment.length ? compute_assessment_next_current_scene:compute_assessment_next_next_scene;

                            previous_assessment_data_current_scene = assessment[compute_assessment_previous_current_scene]['id'];
                            previous_assessment_data_next_scene = assessment[compute_assessment_previous_next_scene]['id'];
                            next_assessment_data_current_scene = assessment[compute_assessment_next_current_scene]['id'];
                            next_assessment_data_next_scene = assessment[compute_assessment_next_next_scene]['id'];

                            break;
                        }
                    }

                    $('#game_assessment_title_id').text(question);
                    $('#game_assessment_text_id').html(html);

                    $('.assessment_select').unbind('click');
                    $('.assessment_select').on('click', function()
                    {
                        let assessment_id = $(this).attr('data-assessment-id'),
                            assessment_letter = $(this).attr('data-assessment-letter');

                        $('.assessment_select').each(function()
                        {
                            if($(this).attr('data-assessment-letter') != assessment_letter)
                            {
                                $(this).prop('checked', false);
                            }
                        });
                    });

                    $('#game_assessment_next_id').attr('data-assessment-question-current-scene-id', next_assessment_data_current_scene);
                    $('#game_assessment_next_id').attr('data-assessment-question-next-scene-id', next_assessment_data_next_scene);

                    $('#game_scene_previous_id').attr('data-current-scene-id', previous_data_current_scene);
                    $('#game_scene_previous_id').attr('data-next-scene-id', previous_data_next_scene);

                    $('#game_scene_next_id').attr('data-current-scene-id', next_data_current_scene);
                    $('#game_scene_next_id').attr('data-next-scene-id', next_data_next_scene);

                    $('#game_scene_next_id').attr('data-next-scene-type', "");
                }
            }
        }

        
    }

    function update_user_chapter(current_scene, next_scene)
    {
        $.ajax({
            url: '/update_user_chapter',
            type: 'post',
            data: { chapter_list:JSON.stringify(global_chapter_list) },
            dataType: 'json',
            async: false,
            success: function(result)
            {
                if(result['status'] == 200)
                {
                    get_user_chapter();
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

    function update_user_chapter_unlocked()
    {
        $.ajax({
            url: '/update_user_chapter_unlocked',
            type: 'post',
            data: { chapter_list:JSON.stringify(global_chapter_list) },
            dataType: 'json',
            async: false,
            success: function(result)
            {
                if(result['status'] == 200)
                {
                    window.location.href = "/chapter"
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

    function show_game_prompt()
    {
        $('#game_prompt_id').removeClass('customize_hide_element');
    }

    function show_game_prompt_question()
    {
        $('#game_prompt_question_id').removeClass('customize_hide_element');
    }

    function show_game_prompt_assessment()
    {
        $('#game_prompt_assessment_id').removeClass('customize_hide_element');
    }

    function show_game_prompt_assessment_result()
    {
        $('#game_prompt_assessment_result_id').removeClass('customize_hide_element');
    }

    function show_find_object()
    {
        $('#find_object_container_id').removeClass('customize_hide_element');
    }

    function show_character_conversation()
    {
        $('#character_container_id').removeClass('customize_hide_element');
    }

    function show_proceed()
    {
        $('#proceed_id').removeClass('customize_hide_element');
    }

    function show_enter()
    {
        $('#enter_id').removeClass('customize_hide_element');
    }

    function hide_game_prompt()
    {
        $('#game_prompt_id').addClass('customize_hide_element');
    }

    function hide_game_prompt_question()
    {
        $('#game_prompt_question_id').addClass('customize_hide_element');
    }

    function hide_game_prompt_assessment()
    {
        $('#game_prompt_assessment_id').addClass('customize_hide_element');
    }

    function hide_game_prompt_assessment_result()
    {
        $('#game_prompt_assessment_result_id').addClass('customize_hide_element');
    }

    function hide_find_object()
    {
        $('#find_object_container_id').addClass('customize_hide_element');
    }

    function hide_character_conversation()
    {
        $('#character_container_id').addClass('customize_hide_element');
    }

    function hide_proceed()
    {
        $('#proceed_id').addClass('customize_hide_element');
    }

    function hide_enter()
    {
        $('#enter_id').addClass('customize_hide_element');
    }

    function user_enable_button_previous_scene()
    {
        $('#game_scene_previous_id').css('pointer-events', 'auto');
        $('#game_scene_previous_id').css('opacity', 1);
    }

    function user_enable_button_next_scene()
    {
        $('#game_scene_next_id').css('pointer-events', 'auto');
        $('#game_scene_next_id').css('opacity', 1);
    }

    function user_disable_button_previous_scene()
    {
        $('#game_scene_previous_id').css('pointer-events', 'none');
        $('#game_scene_previous_id').css('opacity', 0.3);
    }

    function user_disable_button_next_scene()
    {
        $('#game_scene_next_id').css('pointer-events', 'none');
        $('#game_scene_next_id').css('opacity', 0.3);
    }

    function user_message_show()
    {
        $('#character_user_message_id').css('display', 'block');
    }

    function guide_message_show()
    {
        $('#character_guide_message_id').css('display', 'block');
    }

    function user_message_hide()
    {
        $('#character_user_message_id').css('display', 'none');
    }

    function guide_message_hide()
    {
        $('#character_guide_message_id').css('display', 'none');
    }
});
</script>

@endsection