@extends('frontend.master')

@section('meta_tag')
    <meta property="og:url"                content="{{ url()->current() }}" />
    <meta property="og:type"               content="survey" />
    <meta property="og:title"              content="Score of {{ $questionnaire->title }}" />
    <meta property="og:description"        content="{{ $questionnaire->details }}" />
    <meta property="og:image"              content="{{ asset('backend/images/questionnaire').'/'.$questionnaire->created_at->format('Y/m/d/').$questionnaire->id.'/image/'.$questionnaire->image }}" />
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <h3>{{ $questionnaire->title }}</h3>
            <p>The calculation of the score scale is based on a 100-point-scale. The higher your score, the more likely you have a social media addiction. Please note that this test score can not be considered as a scientific diagnosis in any way.
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5">Your Score = {{  $score->total_score }} </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr style="background: #DCDCDC">
                                        <th>Total participants so far</th>
                                        <td>{{ $total_perticipants->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Avarage Score</th>
                                        <td>{{ round($total_perticipants->avg('total_score')) }}</td>
                                    </tr>
                                </thead>
                            </table>
                            <div>
                                <a class="text-primary" href="{{ route('frontend.global.statistics',$questionnaire->id) }}"><strong>Click here to see detailed global statistics</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </p>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Score Descriptions</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background: #DCDCDC">
                                    <th>Score</th>
                                    <th>Descriptions</th>
                                </tr>
                                <tr>
                                    <td>00-25</td>
                                    <td style="background: green;color:white">No Addiction</td>
                                </tr>
                                <tr style="background: #DCDCDC">
                                    <td>26-50</td>
                                    <td style="background-color:brown; color:white">Tolerant Addiction</td>
                                </tr>
                                <tr>
                                    <td>51-75</td>
                                    <td style="background-color:orange; color:black">Emerging Addiction</td>
                                </tr>
                                <tr style="background: #DCDCDC">
                                    <td>76-100</td>
                                    <td style="background-color:red; color:white">Intensive Addiction</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($score->total_score < 26 && $score->total_score > 0)
            <div class="col-md-12 mt-3">
                <h3 class="h4 text-info">Result</h3>
                <p>Based on your score, you fall into <strong>No Addiction</strong> stage. Your score suggests that you have a healthy and balanced behavior in terms of social media usage. Either you are totally absent from the social media platforms or else, you are a random social media user. Whatever the reason, it turns out that you are engaged with real life events, just like the whole humanity was before the arrival of social media. In the excessively digitalized world of today where human beings are facing an online slavery, what you are doing is very precious. Congragulations!.</p>
            </div>
            <div class="col-md-12">
                <h3 class="h4 text-info">Suggestion</h3>
                <p>Actually there is not much that can be suggested to you at this point. As you already maintain a very sustainable social media usage, all we can suggest is that you should strive to keep this healthy and balanced position. Always keep in mind that, with such a balanced social media usage, you are not only the real captain of your time and life, but most probably, you also set a significant example for the people around you, by showing them that a sustainable social media behavior is possible.";</p>
            </div>
        @elseif($score->total_score < 51 && $score->total_score > 25 )
            <div class="col-md-12 mt-3">
                <h3 class="h4 text-info">Result</h3>
                <p>Based on your score, you fall into the <strong >Tolerant Addiction </strong> stage. While things have not gone bad yet, your score does tell us that the warning bells are ringing for the first signs of a possible future social media addiction. Your use of social media seems to have gained certain patterns and regularity. In other words, you now check your social media accounts and get engaged with various forms of interaction (ie. posting, liking, sharing, commenting) on a regular basis. Perhaps, you have also tasted, to some extent, a sense of popularity, a sense of networking with distant friends and foreigners.  As mentioned above, your score does not amount to any social media addiction yet; but it does lay down the grounds for a future possible social media addiction. In a sense, this is a neutral stage, meaning that there are equal possibilities for you to go upwards or downwards.</p>
            </div>
            <div class="col-md-12">
                <h3 class="h4 text-info">Suggestion</h3>
                <p>As you are standing at a borderline position in terms of a possible future social media addiction, you still have plenty of time to take neccessary steps. Our first suggestion would be that you keep things here, still under your control. You should think of imposing yourself certain limits against further social media usage. Combining your current social media behavior with some real life events could bring you a unique satisfaction. A life that is lived both inside and outside social media would perhaps be quite satisfactory. All in all, you should carefully monitor your social media usage, especially the amount of time you spend there. No other radical steps are neccessary for the moment.</p>
            </div>
        @elseif($score->total_score < 76 && $score->total_score > 50 )
            <div class="col-md-12 mt-3">
                <h3 class="h4 text-info">Result</h3>
                <p>Based on your answers to the questions, you fall into the <strong>Emerging Addiction</strong> stage. We can now clearly talk about the fact that you are experiencing a social media addiction to a certain extent. It does not seem to be very severe yet, but it is clearly there with all the implications. Being a step ahead of a regular social media user, you start to push limits with the amount of time you spend on social media. Probably you slowly neglect real life events, family, friends and work for the sake of time on social media. You may as well feel a strong urge to check your social media accounts much more frequently and you might be anxious and unhappy when you have no access to social media. Uncontrolled and unbalanced, your social media usage is problematic.</p>
            </div>
            <div class="col-md-12">
                <h3 class="h4 text-info">Suggestion</h3>
                <p>As the stage of your addiction is not very intensive yet, this tells us that, with a strong determination and concrete decisions, it is within the range of possibility that you can still step back from your current state with your own efforts. Take this test as a first step and make a realistic evaluation of things you do on social media. Ask yourself these questions:<br><br>-What is the most time-consuming thing for you on social media?<br><br>-At what times of the day you are there?<br>-How do you acces your social media accounts<br>-How many social media accounts do you have?<br>-What happens after all that huge time you spend on social media?<br><br>If you sincerely ask and answer these questions, you are half-way done. The answers to these questions will open channels in front of you, through which you can change your social media usage completely. For example, you could:<br><br>-Do less time-consuming things on social media.<br>-Change the times when you are on social media.<br>-Change the way you acces your accounts<br>-Decrease the number of so many social media accounts you have.<br><br>All in all, you have to take action!  </p>
            </div>
        @elseif($score->total_score < 101 && $score->total_score > 75 )
            <div class="col-md-12  mt-3">
                <h3 class="h4 text-info">Result</h3>
                <p>Based on your answers to the questions, you fall into the <strong>Intensive Addiction</strong> stage. Needless to say, you seem to be the most problematic social media user. If your answers reflect the reality, you have almost no life outside social media. You live with it, you travel with it and you sleep and wake up with it. You seem to be quite distant from real world life; family, friends, work and various other daily routine events have probably been left behind. It is even doubtfull whether you are satisfying your basic human needs, such as eating and bathing. Sleeping and eating disorders combined with an ever-increased dependence on social media. Perhaps it would not be an exageration to say that you probably waste your precious time with nonsense on social media. Just compare your case with that of a heavy drug or alcohol addict; you are not any better! You are at a grave situation.</p>
            </div>
            <div class="col-md-12">
                <h3 class="h4 text-info">Suggestion</h3>
                <p>By suggesting you to take immediate action, we assume that you still have some determination to handle your situation. If this is not the case, you should ask your loved ones or people around you for an urgent intervetion to your social media usage. Some very radical steps have to be taken on your behalf and someone should carefully monitor your relation to social media. On the other hand, you should not approach the situation as a kind of disaster. All of us go through such processes in our lives and always keep in mind that with due efforts and decisiveness, you can beat your intensive social media addiction. Take this test as a first step and make a realistic evaluation of things you do on social media. Ask yourself these questions:<br><br>-What is the most time-consuming thing for you on social media?<br>-At what times of the day you are there?<br>-How do you acces your social media accounts<br>-How many social media accounts do you have?<br>-What happens after all that huge time you spend on social media?<br><br>If you sincerely ask and answer these questions, you are half-way done. The answers to these questions will open channels in front of you, through which you can change your social media usage completely. For example, you could:<br><br>-Do less time-consuming things on social media.<br>-Change the times when you are on social media.<br>-Change </p>
            </div>
        @endif
        <div class="col-md-12">
            <p><strong>Warning and Disclaimer :</strong> This test and the resulting scores and remarks can not be considered as a scientific diagnosis in any way. The test is intended to help individuals find out whether they have a problematic social media usage. We can not be held responsible for any use or misuse of this test score and we disclaim all warranties, express or implied, on the information we provide here.</p>
        </div>
        <div class="col-md-12 mb-2">
            <a href="{{ route('frontend.global.statistics',$questionnaire->id) }}" class="btn btn-primary"> <i class="fa fa-eye"></i> View Global Statistics</a>
        </div>
    </div>
     {{-- Social Share  --}}
     <div class="row my-2">
        <div class="col-md-12">
            <h3> Share to <i class="fas fa-share-alt"></i></h3>
            @foreach ($SocialShare as $key => $item)
                @if ($key == 'facebook')
                    <a target="_blank" href="{{ $item }}" class="btn text-white mr-2 my-1" style="background: #4267b2"> <i class="fab fa-facebook"></i> {{ Str::title($key) }}</a>
                @endif
                @if ($key == 'linkedin')
                    <a target="_blank" href="{{ $item }}" class="btn text-white mr-2 my-1" style="background: #0176af"> <i class="fab fa-linkedin-in"></i> {{ Str::title($key) }}</a>
                @endif
                @if ($key == 'twitter')
                    <a target="_blank" href="{{ $item }}" class="btn text-white mr-2 my-1" style="background: #1c99e6"> <i class="fab fa-twitter"></i> {{ Str::title($key) }}</a>
                @endif
                @if ($key == 'whatsapp')
                    <a target="_blank" href="{{ $item }}" class="btn text-white mr-2 my-1" style="background: #44bc54"> <i class="fab fa-whatsapp"></i> {{ Str::title($key) }}</a>
                @endif
                @if ($key == 'telegram')
                    <a target="_blank" href="{{ $item }}" class="btn text-white mr-2 my-1" style="background: #0393d9"> <i class="fab fa-telegram-plane"></i> {{ Str::title($key) }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection

