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
                                <a class="text-primary" href="{{ route('frontend.global.statistics',$questionnaire->slug) }}"><strong>Click here to see detailed global statistics</strong></a>
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
                <p>
                    @php
                        echo $result_0_25->result;
                    @endphp
                </p>
            </div>
            <div class="col-md-12">
                <h3 class="h4 text-info">Suggestion</h3>
                <p>
                    @php
                        echo $result_0_25->suggestion;
                    @endphp
                </p>
            </div>
        @elseif($score->total_score < 51 && $score->total_score > 25 )
            <div class="col-md-12 mt-3">
                <h3 class="h4 text-info">Result</h3>
                <p>
                    @php
                        echo $result_26_50->result;
                    @endphp
                </p>
            </div>
            <div class="col-md-12">
                <h3 class="h4 text-info">Suggestion</h3>
                <p>
                    @php
                        echo $result_26_50->suggestion;
                    @endphp
                </p>
            </div>
        @elseif($score->total_score < 76 && $score->total_score > 50 )
            <div class="col-md-12 mt-3">
                <h3 class="h4 text-info">Result</h3>
                <p>
                    @php
                        echo $result_51_75->result;
                    @endphp
                </p>
            </div>
            <div class="col-md-12">
                <h3 class="h4 text-info">Suggestion</h3>
                <p>
                    @php
                        echo $result_51_75->suggestion;
                    @endphp
                </p>
            </div>
        @elseif($score->total_score < 101 && $score->total_score > 75 )
            <div class="col-md-12  mt-3">
                <h3 class="h4 text-info">Result</h3>
                <p>
                    @php
                        echo $result_76_100->result;
                    @endphp
                </p>
            </div>
            <div class="col-md-12">
                <h3 class="h4 text-info">Suggestion</h3>
                <p>
                    @php
                        echo $result_76_100->suggestion;
                    @endphp
                </p>
            </div>
        @endif
        <div class="col-md-12">
            <p><strong>Warning and Disclaimer :</strong> This test and the resulting scores and remarks can not be considered as a scientific diagnosis in any way. The test is intended to help individuals find out whether they have a problematic social media usage. We can not be held responsible for any use or misuse of this test score and we disclaim all warranties, express or implied, on the information we provide here.</p>
        </div>
        <div class="col-md-12 mb-2">
            <a href="{{ route('frontend.global.statistics',$questionnaire->slug) }}" class="btn btn-primary"> <i class="fa fa-eye"></i> View Global Statistics</a>
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

