<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\questionniare_option;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 2){
            return view('backend.pages.questionnaire.index',[
                'questionnaires' => Questionnaire::all(),
            ]);
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 2){
            return view('backend.pages.questionnaire.create');
        }else{
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role == 2){

            $request->validate([
                'title' => "required",
                'details'=> "required",
                'image'=> "required",
            ]);
            $questionnare = new Questionnaire;
            $questionnare->title = $request->title;
            $questionnare->details = $request->details;
            $questionnare->save();
            if($request->hasFile('image')){
                // return 'aschi';
                $image = $request->file('image');
                $newImageName = Str::slug($questionnare->title).'-'.date('Y_m_d').time().'.'.$image->getClientOriginalExtension();
                // Create Dynamic Folder Start
                $path = public_path('backend/images/questionnaire').'/'.$questionnare->created_at->format('Y/m/d/').$questionnare->id.'/image/';
                File::makeDirectory($path, $mode = 0777, true, true);
                // Create Dynamic Folder End
                Image::make($image)->save($path.$newImageName);
                $questionnare->image = $newImageName;
                $questionnare->save();
            }
            foreach ($request->question as $key =>  $que) {
                $question = new Question;
                $question->questionnaire_id = $questionnare->id;
                $question->question_title = $que;
                $question->save();
                $options = new questionniare_option;
                $options->question_id =  $question->id;
                $options->option1 = $request->option1[$key];
                $options->point1 = $request->point1[$key];
                $options->option2 = $request->option2[$key];
                $options->point2 = $request->point2[$key];
                $options->option3 = $request->option3[$key];
                $options->point3 = $request->point3[$key];
                $options->option4 = $request->option4[$key];
                $options->point4 = $request->point4[$key];
                $options->option5 = $request->option5[$key];
                $options->point5 = $request->point5[$key];
                $options->save();
            }
            return redirect()->route('questionnaire.index');
        }else{
            return abort(404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        return $questionnaire;
    }
}
