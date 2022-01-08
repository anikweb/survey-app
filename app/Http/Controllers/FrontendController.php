<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Models\country;
use App\Models\CountryScore;
use App\Models\Questionnaire;
use App\Models\Question;
use App\Models\ResultSuggestion;
use App\Models\score;
use Illuminate\Http\Request;
use Share;

class FrontendController extends Controller
{
    public function index()
    {
        if(Cookie::get('survey') == ''){
            $cookie_name = 'survey';
            $cookie_value = time().'-'.Str::random(10);
            $cookie_duration = 43200;
            Cookie::queue($cookie_name, $cookie_value, $cookie_duration);
        }
        return view('frontend.pages.home',[
            'questionnaire' => Questionnaire::all(),
        ]);
    }
    public function showQuestion($slug)
    {
        $questionnaire = Questionnaire::where('slug',$slug)->first();
        $question = Question::where('questionnaire_id',$questionnaire->id)->get();
        $countries = country::all();
        $SocialShare = Share::page(route('frontend.question.show',$questionnaire->slug),$questionnaire->title)
        ->facebook()
        ->linkedin()
        ->twitter()
        ->whatsapp()
        ->telegram()->getRawLinks();

        return view('frontend.pages.question',compact(['questionnaire','question','countries','SocialShare']));
    }
    public function storeQuestion(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        foreach ($request->index as $key => $value) {
            if(!isset($request->question[$value])){
                return back()->with('error','You need to submit all question.');
            }
        }
        $questionnaire = Questionnaire::find($request->questionnaire_id);
        $score = new score;
        $score->questionnaire_id = $request->questionnaire_id;
        $score->question_slug = $questionnaire->slug;
        $score->cookie_id = Cookie::get('survey');
        $totalScore = 0;

        foreach ($request->index as $key => $value) {
            $totalScore = $totalScore + $request->question[$value];
        }
        $score->total_score =  $totalScore;
        $score->age =  $request->age;
        $score->gender =  $request->gender;
        $score->education =  $request->education;
        $score->income =  $request->income;
        $score->country_id = $request->country_id;
        $score->save();
        session()->put('score_id',$score->id);

        if(CountryScore::where('questionnaire_id',$score->questionnaire_id)->where('country_id',$score->country_id)->exists()){
            $countryPerticipants = CountryScore::where('questionnaire_id',$score->questionnaire_id)->where('country_id',$score->country_id)
            ->increment('total_perticipants',1);
            $countryScore = CountryScore::where('country_id',$score->country_id)
            ->increment('total_score',$score->total_score);

        }else{
            $countryScore = new CountryScore;
            $countryScore->country_id = $score->country_id;
            $countryScore->questionnaire_id = $score->questionnaire_id;
            $countryScore->total_perticipants = 1;
            $countryScore->total_score = $score->total_score;
            $countryScore->save();
        }
        return redirect()->route('frontend.question.submit',$questionnaire->slug);
    }
    public function submitQuestion($slug){


        $score = score::find(session()->get('score_id'));
        $questionnaire = Questionnaire::find($score->questionnaire_id);
        $score = score::where('questionnaire_id',$score->questionnaire_id)->latest()->first();
        $total_perticipants = score::where('questionnaire_id',$score->questionnaire_id)->get();

        $SocialShare = Share::page(route('frontend.question.submit',$questionnaire->slug),'Score of '.$questionnaire->title.' test')
        ->facebook()
        ->linkedin()
        ->twitter()
        ->whatsapp()
        ->telegram()->getRawLinks();
        return view('frontend.pages.submit',compact([
            'score',
            'questionnaire',
            'score',
            'total_perticipants',
            'SocialShare'
        ]),[
            'result_0_25' => ResultSuggestion::where('result_group','0-25')->first(),
            'result_26_50' => ResultSuggestion::where('result_group','26-50')->first(),
            'result_51_75' => ResultSuggestion::where('result_group','51-75')->first(),
            'result_76_100' => ResultSuggestion::where('result_group','76-100')->first(),
        ]);
    }
    // public function countryStatistics($id){
    //     // return
    //     return view('frontend.pages.country-statistics',[
    //         'countries' => country::orderBy('name','asc')->get(),
    //         'questionnaire' => Questionnaire::find($id),
    //     ]);
    // }
    public function countryStatisticsShow($slug){

        $countries = country::orderBy('name','asc')->get();
        $Cselected_country = country::orderBy('name','asc')->find(session()->get('country_id'));
        $Cquestionnaire = Questionnaire::where('slug',$slug)->first();
        $Ctotal_perticipants = score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->get();
        $Cmale_perticipants = score::where('questionnaire_id',$Cquestionnaire->id)->where('gender','male')->where('country_id',session()->get('country_id'))->get();
        $Cfemale_perticipants = score::where('questionnaire_id',$Cquestionnaire->id)->where('gender','female')->where('country_id',session()->get('country_id'))->get();
        $Cother_perticipants = score::where('questionnaire_id',$Cquestionnaire->id)->where('gender','other')->where('country_id',session()->get('country_id'))->get();

        $countryScore = CountryScore::where('questionnaire_id',$Cquestionnaire->id)->orderBy('total_score','desc')->limit(10)->get();

        $SocialShare = Share::page(route('frontend.country.statistics.show',$Cquestionnaire->id),'Statistics of '.$Cquestionnaire->title.' test')
        ->facebook()
        ->linkedin()
        ->twitter()
        ->whatsapp()
        ->telegram()->getRawLinks();

        return view('frontend.pages.global-statistics',compact([
            'countries',
            'countryScore',
            'Cselected_country',
            'Cquestionnaire',
            'Ctotal_perticipants',
            'Cmale_perticipants',
            'Cfemale_perticipants',
            'Cother_perticipants',
            'SocialShare',

        ]),[

            'Cperticipants_male_1_13' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',0)->where('age','<',14)->where('gender','male')->get(),
            'Cperticipants_female_1_13' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',0)->where('age','<',14)->where('gender','female')->get(),
            'Cperticipants_other_1_13' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',0)->where('age','<',14)->where('gender','other')->get(),
            'Cperticipants_all_1_13' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',0)->where('age','<',14)->get(),

            'Cperticipants_male_14_24' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',13)->where('age','<',25)->where('gender','male')->get(),
            'Cperticipants_female_14_24' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',13)->where('age','<',25)->where('gender','female')->get(),
            'Cperticipants_other_14_24' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',13)->where('age','<',25)->where('gender','other')->get(),
            'Cperticipants_all_14_24' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',13)->where('age','<',25)->get(),

            'Cperticipants_male_25_35' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',24)->where('age','<',36)->where('gender','male')->get(),
            'Cperticipants_female_25_35' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',24)->where('age','<',36)->where('gender','female')->get(),
            'Cperticipants_other_25_35' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',24)->where('age','<',36)->where('gender','other')->get(),
            'Cperticipants_all_25_35' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',24)->where('age','<',36)->get(),

            'Cperticipants_male_36_46' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',35)->where('age','<',47)->where('gender','male')->get(),
            'Cperticipants_female_36_46' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',35)->where('age','<',47)->where('gender','female')->get(),
            'Cperticipants_other_36_46' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',35)->where('age','<',47)->where('gender','other')->get(),
            'Cperticipants_all_36_46' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',35)->where('age','<',47)->get(),

            'Cperticipants_male_47_57' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',46)->where('age','<',58)->where('gender','male')->get(),
            'Cperticipants_female_47_57' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',46)->where('age','<',58)->where('gender','female')->get(),
            'Cperticipants_other_47_57' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',46)->where('age','<',58)->where('gender','other')->get(),
            'Cperticipants_all_47_57' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',46)->where('age','<',58)->get(),

            'Cperticipants_male_58_68' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',57)->where('age','<',69)->where('gender','male')->get(),
            'Cperticipants_female_58_68' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',57)->where('age','<',69)->where('gender','female')->get(),
            'Cperticipants_other_58_68' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',57)->where('age','<',69)->where('gender','other')->get(),
            'Cperticipants_all_58_68' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',57)->where('age','<',69)->get(),

            'Cperticipants_male_69_plus' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',68)->where('gender','male')->get(),
            'Cperticipants_female_69_plus' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',68)->where('gender','female')->get(),
            'Cperticipants_other_69_plus' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',68)->where('gender','other')->get(),
            'Cperticipants_all_69_plus' => score::where('questionnaire_id',$Cquestionnaire->id)->where('country_id',session()->get('country_id'))->where('age','>',68)->get(),

            // Global Statictics
            'questionnaire' => Questionnaire::where('slug',$slug)->first(),
            'total_perticipants' => score::where('questionnaire_id',$Cquestionnaire->id)->get(),
            'male_perticipants' => score::where('questionnaire_id',$Cquestionnaire->id)->where('gender','male')->get(),
            'female_perticipants' => score::where('questionnaire_id',$Cquestionnaire->id)->where('gender','female')->get(),
            'other_perticipants' => score::where('questionnaire_id',$Cquestionnaire->id)->where('gender','other')->get(),

            'perticipants_male_1_13' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',0)->where('age','<',14)->where('gender','male')->get(),
            'perticipants_female_1_13' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',0)->where('age','<',14)->where('gender','female')->get(),
            'perticipants_other_1_13' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',0)->where('age','<',14)->where('gender','other')->get(),
            'perticipants_all_1_13' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',0)->where('age','<',14)->get(),

            'perticipants_male_14_24' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',13)->where('age','<',25)->where('gender','male')->get(),
            'perticipants_female_14_24' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',13)->where('age','<',25)->where('gender','female')->get(),
            'perticipants_other_14_24' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',13)->where('age','<',25)->where('gender','other')->get(),
            'perticipants_all_14_24' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',13)->where('age','<',25)->get(),

            'perticipants_male_25_35' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',24)->where('age','<',36)->where('gender','male')->get(),
            'perticipants_female_25_35' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',24)->where('age','<',36)->where('gender','female')->get(),
            'perticipants_other_25_35' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',24)->where('age','<',36)->where('gender','other')->get(),
            'perticipants_all_25_35' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',24)->where('age','<',36)->get(),

            'perticipants_male_36_46' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',35)->where('age','<',47)->where('gender','male')->get(),
            'perticipants_female_36_46' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',35)->where('age','<',47)->where('gender','female')->get(),
            'perticipants_other_36_46' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',35)->where('age','<',47)->where('gender','other')->get(),
            'perticipants_all_36_46' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',35)->where('age','<',47)->get(),

            'perticipants_male_47_57' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',46)->where('age','<',58)->where('gender','male')->get(),
            'perticipants_female_47_57' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',46)->where('age','<',58)->where('gender','female')->get(),
            'perticipants_other_47_57' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',46)->where('age','<',58)->where('gender','other')->get(),
            'perticipants_all_47_57' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',46)->where('age','<',58)->get(),

            'perticipants_male_58_68' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',57)->where('age','<',69)->where('gender','male')->get(),
            'perticipants_female_58_68' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',57)->where('age','<',69)->where('gender','female')->get(),
            'perticipants_other_58_68' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',57)->where('age','<',69)->where('gender','other')->get(),
            'perticipants_all_58_68' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',57)->where('age','<',69)->get(),

            'perticipants_male_69_plus' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',68)->where('gender','male')->get(),
            'perticipants_female_69_plus' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',68)->where('gender','female')->get(),
            'perticipants_other_69_plus' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',68)->where('gender','other')->get(),
            'perticipants_all_69_plus' => score::where('questionnaire_id',$Cquestionnaire->id)->where('age','>',68)->get(),
        ]);
    }

    public function countryStatisticsStore(Request $request){

        session()->put('country_id',$request->country_id);
        $questionnaire = Questionnaire::find($request->qustionnaire_id);
        return redirect()->route('frontend.country.statistics.show',$questionnaire->slug);

    }
    public function globalStatistics($slug){


        $countries = country::orderBy('name','asc')->get();
        $questionnaire = Questionnaire::where('slug',$slug)->first();
        $total_perticipants = score::where('questionnaire_id',$questionnaire->id)->get();
        $male_perticipants = score::where('questionnaire_id',$questionnaire->id)->where('gender','male')->get();
        $female_perticipants = score::where('questionnaire_id',$questionnaire->id)->where('gender','female')->get();
        $other_perticipants = score::where('questionnaire_id',$questionnaire->id)->where('gender','other')->get();

        $countryScore = CountryScore::where('questionnaire_id',$questionnaire->id)->orderBy('total_score','desc')->limit(10)->get();


        $SocialShare = Share::page(route('frontend.global.statistics',$questionnaire->slug),'Statistics of '.$questionnaire->title.' test')
        ->facebook()
        ->linkedin()
        ->twitter()
        ->whatsapp()
        ->telegram()->getRawLinks();

        return view('frontend.pages.global-statistics',compact([
            'countries',
            'countryScore',
            'questionnaire',
            'total_perticipants',
            'total_perticipants',
            'male_perticipants',
            'female_perticipants',
            'other_perticipants',
            'SocialShare',
            ]),[

            'perticipants_male_1_13' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',0)->where('age','<',14)->where('gender','male')->get(),
            'perticipants_female_1_13' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',0)->where('age','<',14)->where('gender','female')->get(),
            'perticipants_other_1_13' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',0)->where('age','<',14)->where('gender','other')->get(),
            'perticipants_all_1_13' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',0)->where('age','<',14)->get(),

            'perticipants_male_14_24' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',13)->where('age','<',25)->where('gender','male')->get(),
            'perticipants_female_14_24' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',13)->where('age','<',25)->where('gender','female')->get(),
            'perticipants_other_14_24' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',13)->where('age','<',25)->where('gender','other')->get(),
            'perticipants_all_14_24' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',13)->where('age','<',25)->get(),

            'perticipants_male_25_35' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',24)->where('age','<',36)->where('gender','male')->get(),
            'perticipants_female_25_35' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',24)->where('age','<',36)->where('gender','female')->get(),
            'perticipants_other_25_35' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',24)->where('age','<',36)->where('gender','other')->get(),
            'perticipants_all_25_35' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',24)->where('age','<',36)->get(),

            'perticipants_male_36_46' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',35)->where('age','<',47)->where('gender','male')->get(),
            'perticipants_female_36_46' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',35)->where('age','<',47)->where('gender','female')->get(),
            'perticipants_other_36_46' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',35)->where('age','<',47)->where('gender','other')->get(),
            'perticipants_all_36_46' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',35)->where('age','<',47)->get(),

            'perticipants_male_47_57' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',46)->where('age','<',58)->where('gender','male')->get(),
            'perticipants_female_47_57' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',46)->where('age','<',58)->where('gender','female')->get(),
            'perticipants_other_47_57' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',46)->where('age','<',58)->where('gender','other')->get(),
            'perticipants_all_47_57' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',46)->where('age','<',58)->get(),

            'perticipants_male_58_68' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',57)->where('age','<',69)->where('gender','male')->get(),
            'perticipants_female_58_68' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',57)->where('age','<',69)->where('gender','female')->get(),
            'perticipants_other_58_68' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',57)->where('age','<',69)->where('gender','other')->get(),
            'perticipants_all_58_68' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',57)->where('age','<',69)->get(),

            'perticipants_male_69_plus' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',68)->where('gender','male')->get(),
            'perticipants_female_69_plus' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',68)->where('gender','female')->get(),
            'perticipants_other_69_plus' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',68)->where('gender','other')->get(),
            'perticipants_all_69_plus' => score::where('questionnaire_id',$questionnaire->id)->where('age','>',68)->get(),
        ]);
    }

}
