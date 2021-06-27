<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class gameController extends Controller
{
    public function index()
    {
        $this->initiate_list();

        return view('selection_screen');
    }

    public function introduction()
    {
        if(Session::has('character_selection'))
        {
            if( isset(Session::get('character_selection')['is_selected_avatar']) )
            {
                if(Session::get('character_selection')['is_selected_avatar'] == 1)
                {
                    return view('introduction.home');
                }
                else
                {
                    return redirect('/');
                }
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function chapter(Request $request)
    {
        $request_list = $request->all();

        if(Session::has('chapter'))
        {
            if(count($request_list) < 1)
            {
                if(Session::has('character_selection'))
                {
                    if( isset(Session::get('character_selection')['is_selected_avatar']) )
                    {
                        if(Session::get('character_selection')['is_selected_avatar'] == 1)
                        {
                            return view('chapters.home');
                        }
                        else
                        {
                            return redirect('/');
                        }
                    }
                    else
                    {
                        return redirect('/');
                    }
                }
                else
                {
                    return redirect('/');
                }
            }
            else
            {
                if( gettype(Session::get('chapter')) == "array") //data type is array
                {
                    if($request_list['ch'] == 1)
                    {
                        if(Session::has('chapter'))
                        {
                            if( isset(Session::get('chapter')['chapter_one']['is_chapter_unlocked']) )
                            {
                                if(Session::get('chapter')['chapter_one']['is_chapter_unlocked'] == 1)
                                {
                                    return view('chapters.chapter_one.home');
                                }
                                else
                                {
                                    return redirect('/');
                                }
                            }
                            else
                            {
                                return redirect('/');
                            }
                        }
                        else
                        {
                            return redirect('/');
                        }
                    }
                    else if($request_list['ch'] == 2)
                    {
                        if(Session::has('chapter'))
                        {
                            if( isset(Session::get('chapter')['chapter_two']['is_chapter_unlocked']) )
                            {
                                if(Session::get('chapter')['chapter_two']['is_chapter_unlocked'] == 1)
                                {
                                    return view('chapters.chapter_two.home');
                                }
                                else
                                {
                                    return redirect('/');
                                }
                            }
                            else
                            {
                                return redirect('/');
                            }
                        }
                        else
                        {
                            return redirect('/');
                        }
                    }
                    else if($request_list['ch'] == 3)
                    {
                        if(Session::has('chapter'))
                        {
                            if( isset(Session::get('chapter')['chapter_three']['is_chapter_unlocked']) )
                            {
                                if(Session::get('chapter')['chapter_three']['is_chapter_unlocked'] == 1)
                                {
                                    return view('chapters.chapter_three.home');
                                }
                                else
                                {
                                    return redirect('/');
                                }
                            }
                            else
                            {
                                return redirect('/');
                            }
                        }
                        else
                        {
                            return redirect('/');
                        }
                    }
                    else
                    {
                        return "Page Not Found";
                    }
                }
                else //data type is object
                {
                    if($request_list['ch'] == 1)
                    {
                        if(Session::has('chapter'))
                        {
                            if( isset(Session::get('chapter')->chapter_one->is_chapter_unlocked) )
                            {
                                if(Session::get('chapter')->chapter_one->is_chapter_unlocked == 1)
                                {
                                    return view('chapters.chapter_one.home');
                                }
                                else
                                {
                                    return redirect('/');
                                }
                            }
                            else
                            {
                                return redirect('/');
                            }
                        }
                        else
                        {
                            return redirect('/');
                        }
                    }
                    else if($request_list['ch'] == 2)
                    {
                        if(Session::has('chapter'))
                        {
                            if( isset(Session::get('chapter')->chapter_two->is_chapter_unlocked) )
                            {
                                if(Session::get('chapter')->chapter_two->is_chapter_unlocked == 1)
                                {
                                    return view('chapters.chapter_two.home');
                                }
                                else
                                {
                                    return redirect('/');
                                }
                            }
                            else
                            {
                                return redirect('/');
                            }
                        }
                        else
                        {
                            return redirect('/');
                        }
                    }
                    else if($request_list['ch'] == 3)
                    {
                        if(Session::has('chapter'))
                        {
                            if( isset(Session::get('chapter')->chapter_three->is_chapter_unlocked) )
                            {
                                if(Session::get('chapter')->chapter_three->is_chapter_unlocked == 1)
                                {
                                    return view('chapters.chapter_three.home');
                                }
                                else
                                {
                                    return redirect('/');
                                }
                            }
                            else
                            {
                                return redirect('/');
                            }
                        }
                        else
                        {
                            return redirect('/');
                        }
                    }
                    else
                    {
                        return "Page Not Found";
                    }
                }
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function initiate_list()
    {
        $this->character_selection_initiate();
        $this->master_avatar_initiate();
        $this->introduction_initiate();
        $this->chapter_initiate();
    }

    // Transactions

    public function update_user_character_selected(Request $request)
    {

        Session::put('character_selection', [
            'name' => ( strlen($request['name']) < 1 ? "":$request['name'] ),
            'year_level' => ( strlen($request['year_level']) < 1 ? "":$request['year_level'] ),
            'selected_avatar_type' => ( strlen($request['selected_avatar_type']) < 1 ? "":$request['selected_avatar_type'] ),
            'is_selected_avatar' => ( strlen($request['is_selected_avatar']) < 1 ? 0:$request['is_selected_avatar'] ),
            'is_proceed' => ( strlen($request['is_proceed']) < 1 ? 0:$request['is_proceed'] )
        ]);

        return response()->json([
            "status" => 200,
            "message" => "Successfully Updated"
        ]);
    }

    public function update_user_introduction(Request $request)
    {
        $current_scene = $request['current_scene'];
        $next_scene = $request['next_scene'];

        $get_user_introduction = Session::get('introduction');

        $introduction_list_rearrange = array();

        foreach($get_user_introduction as $key => $value)
        {
            $temp_arrange_object = array();

            foreach($value as $sub_key => $sub_value)
            {
                if($sub_key == "is_read")
                {
                    if($key == $current_scene)
                    {
                        $temp_arrange_object[$sub_key] = 1;
                    }
                    else
                    {
                        $temp_arrange_object[$sub_key] = $sub_value;
                    }
                }
                else if($sub_key == "is_current_selected")
                {
                    if($key == $next_scene)
                    {
                        $temp_arrange_object[$sub_key] = 1;
                    }
                    else
                    {
                        $temp_arrange_object[$sub_key] = 0;
                    }
                }
                else
                {
                    $temp_arrange_object[$sub_key] = $sub_value;
                }
            }

            $introduction_list_rearrange[$key] = $temp_arrange_object;
        }

        Session::put('introduction', $introduction_list_rearrange);

        return response()->json([
            "status" => 200,
            "message" => "Successfully Update Introduction Scene"
        ]);
    }

    public function update_user_chapter(Request $request)
    {
        $chapter_list = json_decode($request->chapter_list);

        Session::put('chapter', $chapter_list);

        return response()->json([
            "status" => 200,
            "message" => "Successfully Update Chapter Scene"
        ]);
    }

    public function update_user_chapter_unlocked(Request $request)
    {
        $chapter_list = json_decode($request->chapter_list);

        Session::put('chapter', $chapter_list);

        return response()->json([
            "status" => 200,
            "message" => "Successfully Chapter Unlocked"
        ]);
    }

    // Get Details

    public function get_user_selected_detail()
    {
        $get_user_selected_detail = Session::get('character_selection');

        return response()->json([
            "status" => 200,
            "data" => $get_user_selected_detail
        ]);
    }

    public function get_user_detail_only()
    {
        $get_user_detail = Session::get('character_selection');

        return $get_user_detail;
    }

    public function get_user_introduction(Request $request)
    {
        $get_user_introduction = Session::get('introduction');

        return response()->json([
            "status" => 200,
            "data" => $get_user_introduction,
            "user_avatar" => $this->get_user_avatar()
        ]);
    }

    public function get_user_chapter(Request $request)
    {
        $get_user_chapter = Session::get('chapter');

        return response()->json([
            "status" => 200,
            "data" => $get_user_chapter,
            "user_avatar" => $this->get_user_avatar(),
            "user_detail" => $this->get_user_detail_only()
        ]);
    }

    public function get_user_avatar()
    {
        $get_user_avatar_type = Session::get('character_selection')['selected_avatar_type'];

        $get_avatar_list = Session::get('avatar_list');

        for($i = 0; $i < count($get_avatar_list); $i++)
        {
            if($get_user_avatar_type == $get_avatar_list[$i]['avatar_type'])
            {
                return $get_avatar_list[$i]['avatar_path'];
            }
        }

        return "Girlavatar.png";
    }

    //Initiate list

    public function character_selection_initiate()
    {
        if(!Session::has('character_selection'))
        {
            Session::put('character_selection', [
                'name' => '',
                'year_level' => '',
                'selected_avatar_type' => '',
                'is_selected_avatar' => 0,
                'is_proceed' => 0
            ]);
        }
    }

    public function introduction_initiate()
    {
        if(!Session::has('introduction'))
        {
            Session::put('introduction', [
                'introduction_scene_one' => [
                    'user_message' => '',
                    'guide_message' => 'Welcome to the city of Manila! My name is Lewana, your guide throughout your quest. 
                    This city became a battleground for a decade and these were only the remnants. 
                    Your mission is to search for the lost archive that contains important written works in history called Literature.',
                    'is_read' => 0,
                    'is_current_selected' => 0
                ],
                'introduction_scene_two' => [
                    'user_message' => '',
                    'guide_message' => 'Literature is a reflection of humanity and a way for us to understand each 
                    other. It confirms the real complexity of human conflict. By finding the lost archive, it would 
                    create a gateway to the past and a suggestive path to the future.',
                    'is_read' => 0,
                    'is_current_selected' => 0
                ],
                'introduction_scene_three' => [
                    'user_message' => '',
                    'guide_message' => 'Your task is to unlock the chapters. I know it would be challenging but I am here to 
                    guide you. Are you ready?',
                    'is_read' => 0,
                    'is_current_selected' => 0
                ],
                'introduction_scene_four' => [
                    'user_message' => 'Yes. I promise to bring back the archive. Let’s start this mission!',
                    'guide_message' => 'Your task is to unlock the chapters. I know it would be challenging but I am here to 
                    guide you. Are you ready?',
                    'is_read' => 0,
                    'is_current_selected' => 0
                ]
            ]);
        }
    }

    public function master_avatar_initiate()
    {
        Session::put('avatar_list', [
            [
                'avatar_type' => 'avatar_male',
                'avatar_path' => 'guyavatar.png'
            ],
            [
                'avatar_type' => 'avatar_female',
                'avatar_path' => 'Girlavatar.png'
            ]
        ]);
    }

    public function chapter_initiate()
    {
        if(!Session::has('chapter'))
        {
            Session::put('chapter', [
                'chapter_one' => [
                    'is_chapter_unlocked' => 1,
                    'chapter_scenes' => [
                        [
                            'id' => 1,
                            'chapter_number' => 1,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => 'Translated by Wendy Doniger O’ Flaherty',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'The universe is filled with magical moments that sprinkle life as you find your purpose.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 2,
                            'chapter_number' => 2,
                            'user_message' => '',
                            'guide_message' => 'Find the mystery objects to discover additional information about the literature that we are going to unlock.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 3,
                            'chapter_number' => 3,
                            'user_message' => 'I love mysteries. Let’s go!',
                            'guide_message' => 'Find the mystery objects to discover additional information about the literature that we are going to unlock.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 4,
                            'chapter_number' => 4,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [
                                [
                                    'id' => 1,
                                    'name' => 'Walkie Talkie',
                                    'message' => 'The first piece of literature hidden in this room is called Creation Hymn. It 
                                                   explores the issue of the creation of the universe, which is depicted as a mysterious process.',
                                    'image_path' => 'walkie_talkie.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 2,
                                    'name' => 'Medicine',
                                    'message' => 'This hymn comes from the Rig Veda, one of the four vedas in Indian literature.',
                                    'image_path' => 'medicine.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 3,
                                    'name' => 'Documents',
                                    'message' => 'The “veda” was derived from the word “vid” which means knowledge',
                                    'image_path' => 'documents.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 4,
                                    'name' => 'Pail',
                                    'message' => 'The Vedas are considered to be the central scriptures of Hinduism.',
                                    'image_path' => 'pail.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ]
                            ],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 1,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 5,
                            'chapter_number' => 5,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 1,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 6,
                            'chapter_number' => 6,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => 'CREATION HYMN',
                            'subtitle' => 'Translated by Wendy Doniger O’ Flaherty',
                            'find_object' => [],
                            'prompt_message' => [
                                'There was neither non-existence nor existence then; there was neither the realm of space nor 
                                 the sky which is beyond. What stirred? Where? In whose protection? Was there water, bottomlessly deep?',

                                 'There was neither death nor immortality then. There was no distinguishing sign of night nor 
                                 day. That one breathed, windless, by its own impulse. Other than that was nothing beyond.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 7,
                            'chapter_number' => 7,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'What does realm mean? Give the definition as it is used in the literary piece.',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 8,
                            'chapter_number' => 8,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'Darkness was hidden by darkness in the beginning; with no distinguishing sign, all this was water. 
                                 The life that was covered with emptiness, that one arose through the power of heat.',
                                'Desire came upon that one in the beginning; that was the first seed of minds. Poets seeking 
                                 in their heart with wisdom found the bond of existence in nonexistence.' 
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 9,
                            'chapter_number' => 9,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'What word could you draw out from this definition “the first seed of minds?” Why did you say so?',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.'
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 10,
                            'chapter_number' => 10,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'Their cord was extended across. Was there below? Was there above? Here were see-placers; there were powers. There was impulse beneath; there was giving-forth above.',
                                'Who really knows? Who will here proclaim it? Whence was it produced? Whence is this 
                                 creation? The gods came afterwards, with the creation of this universe. Who then knows 
                                 whence it has arisen?'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 11,
                            'chapter_number' => 11,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'If you were to describe the author’s feeling in these lines, what would it be and why?',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.'
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 12,
                            'chapter_number' => 12,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'Whence this creation has arisen-perhaps it formed itself, or perhaps it did not- the one who 
                                 looks down on it, in the highest heaven, only he knows-or perhaps he does not know.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 13,
                            'chapter_number' => 13,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'Think of a word that would explain the concept of creation expressed in this literary 
                                               piece. Discuss your answer.',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.'
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 14,
                            'chapter_number' => 14,
                            'user_message' => '',
                            'guide_message' => 'Great job! You have unlocked the first piece of literature from the lost archive called the 
                                                Creation Hymn.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 15,
                            'chapter_number' => 15,
                            'user_message' => 'The poem is interesting because it discussed that all creation has its origin, without a 
                                               cause there is no creation.',
                            'guide_message' => 'Great job! You have unlocked the first piece of literature from the lost archive called the 
                                                Creation Hymn.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 16,
                            'chapter_number' => 16,
                            'user_message' => '',
                            'guide_message' => 'It seems like you are a fast learner. That’s great because in order to proceed to chapter 
                                                2, you need to answer 10 questions.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 17,
                            'chapter_number' => 17,
                            'user_message' => '',
                            'guide_message' => 'Your task is to identify the correct definition of the given 
                                                words. Remember to pass the assessment by answering at least 6 correct items or else we will 
                                                start again.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 18,
                            'chapter_number' => 18,
                            'user_message' => 'I’m excited! Don’t worry, I can ace the assessment',
                            'guide_message' => 'Your task is to identify the correct definition of the given 
                                                words. Remember to pass the assessment by answering at least 6 correct items or else we will 
                                                start again.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 19,
                            'chapter_number' => 19,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 1,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 20,
                            'chapter_number' => 20,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [
                                [
                                    'id' => 1,
                                    'question' => 'The Sanskrit term Veda as a common noun means',
                                    'a' => 'Ability',
                                    'b' => 'Knowledge',
                                    'c' => 'God',
                                    'd' => 'Religion',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 2,
                                    'question' => 'There was neither the realm of space nor the sky which is beyond. What does
                                                   beyond mean?',
                                    'a' => 'More distant',
                                    'b' => 'Outside the understanding',
                                    'c' => 'Superior to anyone',
                                    'd' => 'Limitless space',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 3,
                                    'question' => 'What does hymn mean?',
                                    'a' => 'A religious song',
                                    'b' => 'Poem for beauty',
                                    'c' => 'Musical piece played with or without accompaniment',
                                    'd' => 'A form of language that has no formal metrical structure',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 4,
                                    'question' => 'There was neither death nor immortality then. What does immortality mean?',
                                    'a' => 'Gone by in time',
                                    'b' => 'Impermanence',
                                    'c' => 'Eternal life',
                                    'd' => 'Blissful living',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 5,
                                    'question' => 'What was depicted to be a mysterious and unknowable process?',
                                    'a' => 'Universe',
                                    'b' => 'God',
                                    'c' => 'Religion',
                                    'd' => 'Creation',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 6,
                                    'question' => 'What does realm mean in the poem?',
                                    'a' => 'A kingdom ruled by the gods and goddesses',
                                    'b' => 'A space beyond what we see that is ruled powerful being',
                                    'c' => 'Eternal truths that exist in mind',
                                    'd' => 'The world that operates on the laws of physics',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 7,
                                    'question' => 'Poets seeking in their heart with wisdom. What does wisdom mean?',
                                    'a' => 'Common sense and insight',
                                    'b' => "Ability to discern what's right from what's wrong",
                                    'c' => 'Omniscience of a divine being',
                                    'd' => 'Understanding the fundamental nature of reality',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 8,
                                    'question' => 'That one breathed, windless, by its own impulse. What is the meaning of impulse?',
                                    'a' => 'Forceful wind',
                                    'b' => "Power of god",
                                    'c' => 'Strong Desire',
                                    'd' => 'Chasing dreams',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 9,
                                    'question' => 'What is the meaning of beneath?',
                                    'a' => 'Below',
                                    'b' => "Above",
                                    'c' => 'Over',
                                    'd' => 'High',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 10,
                                    'question' => 'What is the meaning of cord?',
                                    'a' => 'Thin string',
                                    'b' => "Jumping rope",
                                    'c' => 'Window glass',
                                    'd' => 'Source of light',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ]
                            ],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 1,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ]
                    ],
                    'assessment_answer_keys' => [
                        [
                            'id' => 1,
                            'answer' => 'b'
                        ],
                        [
                            'id' => 2,
                            'answer' => 'a'
                        ],
                        [
                            'id' => 3,
                            'answer' => 'a'
                        ],
                        [
                            'id' => 4,
                            'answer' => 'b'
                        ],
                        [
                            'id' => 5,
                            'answer' => 'd'
                        ],
                        [
                            'id' => 6,
                            'answer' => 'b'
                        ],
                        [
                            'id' => 7,
                            'answer' => 'd'
                        ],
                        [
                            'id' => 8,
                            'answer' => 'c'
                        ],
                        [
                            'id' => 9,
                            'answer' => 'a'
                        ],
                        [
                            'id' => 10,
                            'answer' => 'a'
                        ]
                    ]
                ],
                'chapter_two' => [
                    'is_chapter_unlocked' => 0,
                    'chapter_scenes' => [
                        [
                            'id' => 1,
                            'chapter_number' => 1,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => 'NIGHTMARE OF THE LABYRINTH',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'Struggles are needed in life in order to draw a meaningful journey towards your goal.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 2,
                            'chapter_number' => 2,
                            'user_message' => '',
                            'guide_message' => 'You know the drill, look for the mystery objects to gain additional information.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 3,
                            'chapter_number' => 3,
                            'user_message' => 'Of course! I’m always ready for this.',
                            'guide_message' => 'You know the drill, look for the mystery objects to gain additional information.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 4,
                            'chapter_number' => 4,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [
                                [
                                    'id' => 1,
                                    'name' => 'Stop sign',
                                    'message' => 'The second piece of literature is entitled Annabel Lee by Edgar Allan Poe.',
                                    'image_path' => 'stop_sign.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 2,
                                    'name' => 'Present',
                                    'message' => 'Edgar Allan Poe was one of the most influential American writers of the 19th century.',
                                    'image_path' => 'present.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 3,
                                    'name' => 'Pine cone',
                                    'message' => 'Annabel Lee was published in the New York Tribune on Oct. 9, 1849, two days 
                                                  after his death.',
                                    'image_path' => 'pine_cone.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 4,
                                    'name' => 'Blanket',
                                    'message' => "This poem expresses one of Poe's recurrent themes—the death of a young, beautiful, and dearly beloved woman.",
                                    'image_path' => 'blanket.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ]
                            ],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 1,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 5,
                            'chapter_number' => 5,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 1,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 6,
                            'chapter_number' => 6,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => 'ANNABEL LEE',
                            'subtitle' => 'Edgar Allan Poe',
                            'find_object' => [],
                            'prompt_message' => [
                                'It was many and many a year ago,<br/>
                                 In a kingdom by the sea,<br/>
                                 That a maiden there lived whom you may know<br/>
                                 By the name of Annabel Lee;<br/>
                                 And this maiden she lived with no other thought<br/>
                                 Than to love and be loved by me.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 7,
                            'chapter_number' => 7,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'Have you been in love or do you have a crush? Choose a word that best describes the person and explain.',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 8,
                            'chapter_number' => 8,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'I was a child and she was a child,<br/>
                                 In this kingdom by the sea,<br/>
                                 But we loved with a love that was more than love—<br/>
                                 I and my Annabel Lee—<br/>
                                 With a love that the winged seraphs of Heaven<br/>
                                 Coveted her and me.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 9,
                            'chapter_number' => 9,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'What do winged seraphs mean? What is the significance of this word in this stanza?',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 10,
                            'chapter_number' => 10,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'And this was the reason that, long ago,<br/>
                                In this kingdom by the sea,<br/>
                                A wind blew out of a cloud, chilling<br/>
                                My beautiful Annabel Lee;<br/>
                                So that her highborn kinsmen came<br/>
                                And bore her away from me,<br/>
                                To shut her up in a sepulchre<br/>
                                In this kingdom by the sea.',

                                'The angels, not half so happy in Heaven,<br/>
                                Went envying her and me—<br/>
                                Yes!—that was the reason (as all men know,<br/>
                                In this kingdom by the sea)<br/>
                                That the wind came out of the cloud by night,<br/>
                                Chilling and killing my Annabel Lee.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 11,
                            'chapter_number' => 11,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'What is a sepulchre? What does it symbolize?',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 12,
                            'chapter_number' => 12,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'But our love it was stronger by far than the love<br/>
                                Of those who were older than we—<br/>
                                Of many far wiser than we—And neither the angels in Heaven above<br/>
                                Nor the demons down under the sea<br/>
                                Can ever dissever my soul from the soul<br/>
                                Of the beautiful Annabel Lee;',

                                'For the moon never beams, without bringing me dreams<br/>
                                Of the beautiful Annabel Lee;<br/>
                                And the stars never rise, but I feel the bright eyes<br/>
                                Of the beautiful Annabel Lee;<br/>
                                And so, all the night-tide, I lie down by the side<br/>
                                Of my darling—my darling—my life and my bride,<br/>
                                In her sepulchre there by the sea—<br/>
                                In her tomb by the sounding sea.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 13,
                            'chapter_number' => 13,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'What was the narrator’s feeling toward the ending of the poem? Why?',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 14,
                            'chapter_number' => 14,
                            'user_message' => '',
                            'guide_message' => 'You’ve got your brain in gear! You have unlocked the second piece of literature called Annabel Lee.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 15,
                            'chapter_number' => 15,
                            'user_message' => 'I like that it highlights the idea that one may be gone from the sight but will never be gone from the heart.',
                            'guide_message' => 'You’ve got your brain in gear! You have unlocked the second piece of literature called Annabel Lee.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 16,
                            'chapter_number' => 16,
                            'user_message' => '',
                            'guide_message' => 'Excellent! We are halfway there. Your task is to complete the sentences by filling in 
                                                correct words based on the passage. Get at least 6 correct items!',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 17,
                            'chapter_number' => 17,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 1,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 18,
                            'chapter_number' => 18,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [
                                [
                                    'id' => 1,
                                    'question' => 'A _____________ named Annabel Lee lived in a/an _________ by the sea.',
                                    'a' => 'Unmarried woman; house',
                                    'b' => 'Old-fashioned girl; palace',
                                    'c' => 'Young and attractive woman; empire',
                                    'd' => 'A princess; castle',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 2,
                                    'question' => '“Many many years ago” underlines the love that is defined by its _______________.',
                                    'a' => 'Strong and passionate love',
                                    'b' => 'Timeless act of desire',
                                    'c' => 'Fleeting relationship',
                                    'd' => 'Ability to survive eternally',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 3,
                                    'question' => 'In the first line, it talks about their love for each other. Love is given as a/an __________- freely, willingly and without expectation.',
                                    'a' => 'Gift',
                                    'b' => 'Achievement',
                                    'c' => 'Award',
                                    'd' => 'Donation',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 4,
                                    'question' => 'Their love went beyond the normal love so the ___________ from heaven __________ for their relationship.',
                                    'a' => 'Soldiers ; killed',
                                    'b' => 'Parents ; separated',
                                    'c' => 'Angels ; yearn',
                                    'd' => 'Kinsmen ; jealous',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 5,
                                    'question' => 'The speaker was traumatized by his _____ because she was _______ by the kinsmen.',
                                    'a' => 'Lost ; carried',
                                    'b' => 'Loss ; taken away',
                                    'c' => 'Loose; separated',
                                    'd' => 'Lose ; flown away',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 6,
                                    'question' => 'The __________ served as a reminder of the love he shared with Annabel Lee.',
                                    'a' => 'Demons',
                                    'b' => 'Sepulcher',
                                    'c' => 'Kingdom',
                                    'd' => 'Natural world',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 7,
                                    'question' => 'The demons under the sea can never __________ his soul from the soul of the _______ Annabel Lee.',
                                    'a' => 'Separate ; charming',
                                    'b' => "Connect ; lovely",
                                    'c' => 'Taken ; elderly',
                                    'd' => 'Die ; young',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 8,
                                    'question' => 'The poem shows that the author experienced _________ and he ________ to let go.',
                                    'a' => 'Happiness; accepted',
                                    'b' => "Grief; refused",
                                    'c' => 'Woe ; canceled',
                                    'd' => 'Pain ; assumed',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 9,
                                    'question' => 'As the moon _________, it brings back Annabel Lee’s _________.',
                                    'a' => 'Shines, memories',
                                    'b' => "Smiles ; pain",
                                    'c' => 'Lights; vision',
                                    'd' => 'Laugh ; souvenir',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 10,
                                    'question' => 'The speaker proved that love is the greatest __________ in the universe not even death can ____________ it.',
                                    'a' => 'Accomplishment ; kill',
                                    'b' => "Desire ; build",
                                    'c' => 'Force ; destroy',
                                    'd' => 'Goal ; prevent',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ]
                            ],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 1,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ]
                    ],
                    'assessment_answer_keys' => [
                        [
                            'id' => 1,
                            'answer' => 'c'
                        ],
                        [
                            'id' => 2,
                            'answer' => 'd'
                        ],
                        [
                            'id' => 3,
                            'answer' => 'a'
                        ],
                        [
                            'id' => 4,
                            'answer' => 'c'
                        ],
                        [
                            'id' => 5,
                            'answer' => 'b'
                        ],
                        [
                            'id' => 6,
                            'answer' => 'd'
                        ],
                        [
                            'id' => 7,
                            'answer' => 'a'
                        ],
                        [
                            'id' => 8,
                            'answer' => 'b'
                        ],
                        [
                            'id' => 9,
                            'answer' => 'a'
                        ],
                        [
                            'id' => 10,
                            'answer' => 'c'
                        ]
                    ]
                ],
                'chapter_three' => [
                    'is_chapter_unlocked' => 0,
                    'chapter_scenes' => [
                        [
                            'id' => 1,
                            'chapter_number' => 1,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => 'EMERGING FROM THE ASHES',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                'The greatest power that you possess is not being undefeated but the courage to rise in every time you fall.'
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 2,
                            'chapter_number' => 2,
                            'user_message' => '',
                            'guide_message' => 'You made it this far. I’m so proud of you.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 3,
                            'chapter_number' => 3,
                            'user_message' => 'Thank you. You are a great guide. I guess we will be looking for other mystery objects.',
                            'guide_message' => 'You made it this far. I’m so proud of you.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 4,
                            'chapter_number' => 4,
                            'user_message' => '',
                            'guide_message' => 'You are right!',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 5,
                            'chapter_number' => 5,
                            'user_message' => 'I feel like I can be a detective now. Just kidding!',
                            'guide_message' => 'You are right!',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 6,
                            'chapter_number' => 6,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [
                                [
                                    'id' => 1,
                                    'name' => 'Telescope',
                                    'message' => 'The last piece of literature hidden in this room is a poem “Like the Molave” by Rafael Zulueta da Costa.',
                                    'image_path' => 'telescope.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 2,
                                    'name' => 'Ship’s steering wheel',
                                    'message' => 'Rafael Zulueta da Costa, born in 1915, is a Filipino poet.',
                                    'image_path' => 'steering.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 3,
                                    'name' => 'Stethoscope',
                                    'message' => 'His most famous work is Like the Molave and Other Poems, which won the Commonwealth Literary Award for Poetry in 1940.',
                                    'image_path' => 'stethoscope.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 4,
                                    'name' => 'Rod',
                                    'message' => "Like The Molave is a lyric poetry, a short, highly musical verse that conveys powerful feelings.",
                                    'image_path' => 'rod.png',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ]
                            ],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 1,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 7,
                            'chapter_number' => 7,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 1,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 8,
                            'chapter_number' => 8,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => 'LIKE THE MOLAVE',
                            'subtitle' => 'Rafael Zulueta da Costa',
                            'find_object' => [],
                            'prompt_message' => [
                                "Not yet, Rizal, not yet. Sleep not in peace;<br/>
                                There are a thousand waters to be spanned;<br/>
                                There are a thousand mountains to be crossed;<br/>
                                There are a thousand crosses to be borne,<br/>
                                Our shoulders are not strong; our sinews are<br/>
                                Grown flaccid with dependence, smug with ease<br/>
                                Under another's wing.",

                                "Rest not in peace;<br/>
                                Not yet, Rizal, not yet. The land has need<br/>
                                Of young blood and, what younger than your own,<br/>
                                Forever spilled in the great name of freedom,<br/>
                                Forever oblate on the altar of<br/>
                                The free?<br/>
                                Not you alone, Rizal"
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 9,
                            'chapter_number' => 9,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'If you were to write a short letter to Rizal regarding our situation, what would you say?',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 10,
                            'chapter_number' => 10,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                "O souls<br/>
                                And spirits of the martyred brave, arise!<br/>
                                Arise and scour the land! Shed once again<br/>
                                Your willing blood! Infuse the vibrant red<br/>
                                Into our thin, anemic veins; until<br/>
                                We pick up your Promethean tools and, strong,<br/>
                                Out of the depthless matrix of your faith<br/>
                                In us, and on the silent cliffs of freedom,<br/>
                                We carve for all the time your marmoreal dream!<br/>
                                Until your people, seeing, are become<br/>
                                Like the molave, firm, resilient, staunch,<br/>
                                Rising on the hillside unafraid,<br/>
                                Strong in its own fibre; yes, like the molave!"
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 11,
                            'chapter_number' => 11,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'What inspiration can we get from the author’s description of the molave? Explain your answer.',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 12,
                            'chapter_number' => 12,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                "We, the Filipinos of today, are soft,<br/>
                                easy going, parasitic, frivolous<br/>
                                Inconstant, indolent, inefficient.<br/>
                                Would you have me sugarcoat you?<br/>
                                I would be happier to shower praise upon<br/>
                                my countrymen... but let us be realists...<br/>
                                let us strip ourselves…"
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 13,
                            'chapter_number' => 13,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'Do you think the descriptions still represent the Filipinos? Choose three descriptions and defend your answer.',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 14,
                            'chapter_number' => 14,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [
                                "Youth of the land, you are a bitter pill to swallow.<br/>
                                This is a testament of youth borne on the four pacific winds;<br/>
                                This is a parable of seed four ways sown in stone;<br/>
                                This is a chip not only on the President's shoulder,<br/>
                                The nation of our fathers shivers with long longing expectation"
                            ],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 1,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 15,
                            'chapter_number' => 15,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => [
                                'question' => 'As the youth of the land, what characteristics do you have that could make our country better? How?',
                                'answer' => '',
                                'note' => 'Note: Take a screenshot of your answer and place it in a folder. You will send it later to my email.',
                            ],
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 1,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 16,
                            'chapter_number' => 16,
                            'user_message' => '',
                            'guide_message' => 'Outstanding! We found all the literature. Like the Molave is the last poem in the lost archive. What have you learned?',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 17,
                            'chapter_number' => 17,
                            'user_message' => 'I learned that Filipinos must be like the Molave, we need to stand firm and resilient especially during this time of pandemic.',
                            'guide_message' => 'Outstanding! We found all the literature. Like the Molave is the last poem in the lost archive. What have you learned?',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 18,
                            'chapter_number' => 18,
                            'user_message' => '',
                            'guide_message' => 'Very good! Now, your task is to analyze the correct usage of words in an analogy and a sentence.',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 19,
                            'chapter_number' => 19,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [
                                [
                                    'id' => 1,
                                    'question' => 'Peace: Tranquility :: Sinews : _______________',
                                    'a' => 'Ligament',
                                    'b' => 'Strength',
                                    'c' => 'Bones',
                                    'd' => 'Body',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 2,
                                    'question' => 'Allegory : Animal Farm :: Parable : _______________',
                                    'a' => 'Religious Principle',
                                    'b' => 'Moral Story',
                                    'c' => 'Boy Who Cried Wolf',
                                    'd' => "A wolf in sheep's clothing",
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 3,
                                    'question' => 'Dove : Freedom:: Molave : _____________',
                                    'a' => 'Power',
                                    'b' => 'Life',
                                    'c' => 'Heroism',
                                    'd' => 'Indolent',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 4,
                                    'question' => 'Tool: Shovel :: Parasitic : ___________',
                                    'a' => 'Butterfly',
                                    'b' => 'Lion',
                                    'c' => 'Tapeworm',
                                    'd' => 'Snake',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 5,
                                    'question' => 'Which is a correct form of analogy?',
                                    'a' => 'Indolent : Lazy :: Soft : Hard',
                                    'b' => 'Pill : Swallow :: Rice : Chew',
                                    'c' => 'Sugarcoat : Realist ::Idealist : Truth',
                                    'd' => 'Nation : President :: Country : Father',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 6,
                                    'question' => 'Which is a correct form of analogy?',
                                    'a' => 'Stone : Land ::Faith : Church',
                                    'b' => 'Promethean : Creative :: Rizalian : Brave',
                                    'c' => 'Blood: Body : Ocean: Water',
                                    'd' => 'Brave :: Unafraid :: Strong : Firm',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 7,
                                    'question' => 'The passage used the word flaccid to describe the sinews. Which sentence shows the correct use of “flaccid?”',
                                    'a' => 'Paralyzed muscles lose tone and became flaccid.',
                                    'b' => "A construction worker must have flaccid arms to build a house.",
                                    'c' => 'A flaccid arm gripped her hand that caused her to stop.',
                                    'd' => 'I picked up her wrist. It was firm and flaccid.',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 8,
                                    'question' => "The passage said that “smug with ease under another's wing.” Based on this context, which sentence shows the correct use of “smug?”",
                                    'a' => 'She is very smug even though she got the top mark on the test.',
                                    'b' => "He rose from very smug beginnings to become one of the richest men in his country.",
                                    'c' => 'The Pope was greeted by a crowd of thousands of his smug followers.',
                                    'd' => 'Gregory was smug after he easily eliminated his rival during the kickboxing competition.',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 9,
                                    'question' => 'Arise and scour the land! In this context, which sentence shows the correct use of “scour?”',
                                    'a' => 'There is a huge scour in the market due to heat.',
                                    'b' => "I wanted to scour different places in the world.",
                                    'c' => 'Our punishment was to scour the vandal off of school property.',
                                    'd' => 'My mother scoured the house because it was cleaned by the helpers today.',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ],
                                [
                                    'id' => 10,
                                    'question' => 'The poem described the FIlipinos as frivolous, indolent, and soft. Which sentence shows the correct usage of the word “frivolous?”',
                                    'a' => 'I know you love her because you realize that your relationship is frivolous.',
                                    'b' => "My mother often spends her monthly pension on frivolous purchases she never uses.",
                                    'c' => 'The candidates showed that they are worthy of the prize because they are frivolous.',
                                    'd' => 'This event is frivolous so I need to prepare for the week.',
                                    'answer' => '',
                                    'is_read' => 0,
                                    'is_current_selected' => 0
                                ]
                            ],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 1,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 20,
                            'chapter_number' => 20,
                            'user_message' => '',
                            'guide_message' => 'I never doubted your ability and knowledge in this mission. Thank you for bringing back the archive',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 21,
                            'chapter_number' => 21,
                            'user_message' => 'You are welcome. I know these written works will allow us to understand the culture of the world.',
                            'guide_message' => 'I never doubted your ability and knowledge in this mission. Thank you for bringing back the archive',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 1,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 0,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                        [
                            'id' => 22,
                            'chapter_number' => 22,
                            'user_message' => '',
                            'guide_message' => '',
                            'title' => '',
                            'subtitle' => '',
                            'find_object' => [],
                            'prompt_message' => [],
                            'poem_question_and_answer' => null,
                            'assessment' => [],
                            'is_conversation' => 0,
                            'is_prompt' => 0,
                            'is_find_object' => 0,
                            'is_poem_proceed' => 0,
                            'is_poem_question' => 0,
                            'is_assessment_proceed' => 0,
                            'is_assessment_question' => 0,
                            'is_awarding' => 1,
                            'is_read' => 0,
                            'is_current_selected' => 0
                        ],
                    ],
                    'assessment_answer_keys' => [
                        [
                            'id' => 1,
                            'answer' => 'a'
                        ],
                        [
                            'id' => 2,
                            'answer' => 'c'
                        ],
                        [
                            'id' => 3,
                            'answer' => 'c'
                        ],
                        [
                            'id' => 4,
                            'answer' => 'c'
                        ],
                        [
                            'id' => 5,
                            'answer' => 'b'
                        ],
                        [
                            'id' => 6,
                            'answer' => 'd'
                        ],
                        [
                            'id' => 7,
                            'answer' => 'a'
                        ],
                        [
                            'id' => 8,
                            'answer' => 'd'
                        ],
                        [
                            'id' => 9,
                            'answer' => 'c'
                        ],
                        [
                            'id' => 10,
                            'answer' => 'b'
                        ]
                    ]
                ]
            ]);
        }
    }

    //Master List

    public function master_avatar_list()
    {
        $get_avatar_list = Session::get('avatar_list');

        return response()->json([
            "status" => 200,
            "data" => $get_avatar_list
        ]);
    }

    //Clear session

    public function resetgame()
    {
        Session::flush();

        return redirect('/');
    }
}
