@extends('frontend.master')
@section('meta_tag')
    <meta property="og:url"                content="{{ url()->current() }}" />
    <meta property="og:type"               content="survey" />
    @if (isset($Ctotal_perticipants))
        <meta property="og:title"              content="Global Statistics of {{ $questionnaire->title }}" />
    @else
        <meta property="og:title"              content="Global & Country Statistics of {{ $questionnaire->title }}" />
    @endif
    <meta property="og:description"        content="{{ $questionnaire->details }}" />
    <meta property="og:image"              content="{{ asset('backend/images/questionnaire').'/'.$questionnaire->created_at->format('Y/m/d/').$questionnaire->id.'/image/'.$questionnaire->image }}" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <h3> Global {{ $questionnaire->title }} </h3>
            <p>The calculation of the score scale is based on a 100-point-scale. The higher your score, the more likely you have a social media addiction. Please note that this test score can not be considered as a scientific diagnosis in any way.
            </p>
            <a href="{{ route('frontend.question.show',$questionnaire->slug) }}"> Click here to take the test</a>
            <hr>
        </div>
        <div class="col-md-12 my-2">
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
                                <tr>
                                    <td style="background: #DCDCDC">26-50</td>
                                    <td style="background-color:brown; color:white">Tolerant Addiction</td>
                                </tr>
                                <tr>
                                    <td>51-75</td>
                                    <td style="background-color:orange; color:black">Emerging Addiction</td>
                                </tr>
                                <tr>
                                    <td style="background: #DCDCDC">76-100</td>
                                    <td style="background-color:red; color:white">Intensive Addiction</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Total Global Statistics --}}
        <div class="col-md-12 my-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Total Global Statistics
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background: #DCDCDC">
                                    <th>Total Global Participants So Far</th>
                                    <th>{{ $total_perticipants->count() }}</th>
                                </tr>
                                <tr>
                                    <th>Global Average Score So Far</th>
                                    <th>{{ round($total_perticipants->avg('total_score')) }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12 my-2">
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-2"> Chart based on gender</a></li>
                    <li><a href="#tabs-3">Chart based on age group</a></li>
                    <li><a href="#tabs-4">Top 10 countries</a></li>
                </ul>
                <div id="tabs-2">
                    <div class="row">
                        <div class="col-12 col-md-6 mx-auto">
                            <div>
                                <canvas id="gGender"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-3">
                    <div class="row">
                        <div class="col-12 col-md-6 mx-auto">
                            <div>
                                <canvas  id="gAge"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-4">
                    <div class="row">
                        <div class="col-12 col-md-6 mx-auto">
                            <div>
                                <canvas  id="topCountries"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 my-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Global Statistics By Gender Segments
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background: #DCDCDC">
                                    <th>Gender</th>
                                    <th>Participants</th>
                                    <th>Average Score</th>
                                </tr>
                                <tr>
                                    <td>Male</td>
                                    <td>{{ $male_perticipants->count() }}</td>
                                    <td>@if($male_perticipants->avg('total_score')) {{ round($male_perticipants->avg('total_score')) }} @else 0 @endif</td>

                                </tr>
                                <tr style="background: #DCDCDC">
                                    <td>Female</td>
                                    <td>{{ $female_perticipants->count() }}</td>
                                    <td>@if($female_perticipants->avg('total_score')) {{ round($female_perticipants->avg('total_score')) }} @else 0 @endif</td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td>{{ $other_perticipants->count() }}</td>
                                    <td>@if($other_perticipants->avg('total_score')) {{ round($other_perticipants->avg('total_score')) }} @else 0 @endif</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 my-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Global Statistics by age group segments</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th style="background: rgba(11, 159, 255, 0.5);color:#000">Age Groups</th>
                                    <td style="background: rgb(255,20,147, 0.7);color:#000">Total Participants</th>
                                    <td style="background: rgb(165,42,42,0.7);color:#000">Average Score</th>
                                </tr>
                                <tr>
                                    <td style="background: rgba(11, 159, 255, 0.5);color:#000">01-13</th>
                                    <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($perticipants_all_1_13->count()){{ $perticipants_all_1_13->count() }} @else 0 @endif </th>
                                    <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($perticipants_all_1_13->avg('total_score')){{ round($perticipants_all_1_13->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: rgba(11, 159, 255, 0.5);color:#000">14-24</th>
                                    <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($perticipants_all_14_24->count()){{ $perticipants_all_14_24->count() }} @else 0 @endif </th>
                                    <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($perticipants_all_14_24->avg('total_score')){{ round($perticipants_all_14_24->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: rgba(11, 159, 255, 0.5);color:#000">25-35</th>
                                    <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($perticipants_all_25_35->count()){{ $perticipants_all_25_35->count() }} @else 0 @endif </th>
                                    <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($perticipants_all_25_35->avg('total_score')){{ round($perticipants_all_25_35->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: rgba(11, 159, 255, 0.5);color:#000">36-46</th>
                                    <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($perticipants_all_36_46->count()){{ $perticipants_all_36_46->count() }} @else 0 @endif </th>
                                    <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($perticipants_all_36_46->avg('total_score')){{ round($perticipants_all_36_46->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: rgba(11, 159, 255, 0.5);color:#000">47-57</th>
                                    <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($perticipants_all_47_57->count()){{ $perticipants_all_47_57->count() }} @else 0 @endif </th>
                                    <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($perticipants_all_47_57->avg('total_score')){{ round($perticipants_all_47_57->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: rgba(11, 159, 255, 0.5);color:#000">58-68</th>
                                    <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($perticipants_all_58_68->count()){{ $perticipants_all_58_68->count() }} @else 0 @endif </th>
                                    <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($perticipants_all_58_68->avg('total_score')){{ round($perticipants_all_58_68->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: rgba(11, 159, 255, 0.5);color:#000">69+</th>
                                    <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($perticipants_all_69_plus->count()){{ $perticipants_all_69_plus->count() }} @else 0 @endif </th>
                                    <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($perticipants_all_69_plus->avg('total_score')){{ round($perticipants_all_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 my-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Global Statistics By Gender And Age Segments</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="background: #ffa500b0;color:#000">Age Groups</th>
                                    <th colspan="2" style="background: #800080d1;color:white">Male</th>
                                    <th colspan="2" style="background: #008000d4;color:white">Female</th>
                                    <th colspan="2" style="background: #0000ffba;color:white">Other</th>
                                </tr>
                                <tr>
                                    <td style="background: #800080d1;color:white">Total Participants</th>
                                    <td style="background: #800080d1;color:white">Average Score</th>
                                    <td style="background: #008000d4;color:white">Total Participants</th>
                                    <td style="background: #008000d4;color:white">Average Score</th>
                                    <td style="background: #0000ffba;color:white">Total Participants</th>
                                    <td style="background: #0000ffba;color:white">Average Score</th>
                                </tr>
                                <tr>
                                    <td style="background: #ffa500b0;color:#000">01-13</th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_1_13->count()){{ $perticipants_male_1_13->count() }} @else 0 @endif </th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_1_13->avg('total_score')){{ round($perticipants_male_1_13->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_1_13->count()){{ $perticipants_female_1_13->count() }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_1_13->avg('total_score')){{ round($perticipants_female_1_13->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_1_13->count()){{ $perticipants_other_1_13->count() }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_1_13->avg('total_score')){{ round($perticipants_other_1_13->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: #ffa500b0;color:#000">14-24</th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_14_24->count()){{ $perticipants_male_14_24->count() }} @else 0 @endif </th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_14_24->avg('total_score')){{ round($perticipants_male_14_24->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_14_24->count()){{ $perticipants_female_14_24->count() }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_14_24->avg('total_score')){{ round($perticipants_female_14_24->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_14_24->count()){{ $perticipants_other_14_24->count() }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_14_24->avg('total_score')){{ round($perticipants_other_14_24->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: #ffa500b0;color:#000">25-35</th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_25_35->count()){{ $perticipants_male_25_35->count() }} @else 0 @endif </th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_25_35->avg('total_score')){{ round($perticipants_male_25_35->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_25_35->count()){{ $perticipants_female_25_35->count() }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_25_35->avg('total_score')){{ round($perticipants_female_25_35->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_25_35->count()){{ $perticipants_other_25_35->count() }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_25_35->avg('total_score')){{ round($perticipants_other_25_35->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: #ffa500b0;color:#000">36-46</th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_36_46->count()){{ $perticipants_male_36_46->count() }} @else 0 @endif </th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_36_46->avg('total_score')){{ round($perticipants_male_36_46->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_36_46->count()){{ $perticipants_female_36_46->count() }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_36_46->avg('total_score')){{ round($perticipants_female_36_46->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_36_46->count()){{ $perticipants_other_36_46->count() }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_36_46->avg('total_score')){{ round($perticipants_other_36_46->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: #ffa500b0;color:#000">47-57</th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_47_57->count()){{ $perticipants_male_47_57->count() }} @else 0 @endif </th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_47_57->avg('total_score')){{ round($perticipants_male_47_57->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_47_57->count()){{ $perticipants_female_47_57->count() }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_47_57->avg('total_score')){{ round($perticipants_female_47_57->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_47_57->count()){{ $perticipants_other_47_57->count() }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_47_57->avg('total_score')){{ round($perticipants_other_47_57->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: #ffa500b0;color:#000">58-68</th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_58_68->count()){{ $perticipants_male_58_68->count() }} @else 0 @endif </th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_58_68->avg('total_score')){{ round($perticipants_male_58_68->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_58_68->count()){{ $perticipants_female_58_68->count() }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_58_68->avg('total_score')){{ round($perticipants_female_58_68->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_58_68->count()){{ $perticipants_other_58_68->count() }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_58_68->avg('total_score')){{ round($perticipants_other_58_68->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                                <tr>
                                    <td style="background: #ffa500b0;color:#000">69+</th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_69_plus->count()){{ $perticipants_male_69_plus->count() }} @else 0 @endif </th>
                                    <td style="background: #800080d1;color:white"> @if ($perticipants_male_69_plus->avg('total_score')){{ round($perticipants_male_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_69_plus->count()){{ $perticipants_female_69_plus->count() }} @else 0 @endif </th>
                                    <td style="background: #008000d4;color:white"> @if ($perticipants_female_69_plus->avg('total_score')){{ round($perticipants_female_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_69_plus->count()){{ $perticipants_other_69_plus->count() }} @else 0 @endif </th>
                                    <td style="background: #0000ffba;color:white"> @if ($perticipants_other_69_plus->avg('total_score')){{ round($perticipants_other_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="country_div" class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Country Based Statistics</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.country.statistics.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                @if (isset($Cquestionnaire->id))
                                    <input type="hidden" name="qustionnaire_id" value="{{ $Cquestionnaire->id }}">
                                @endif
                                @if (isset($questionnaire->id))
                                    <input type="hidden" name="qustionnaire_id" value="{{ $questionnaire->id }}">
                                @endif
                                <label for="country_id"><strong>Select Country <span>*</span></strong></label>
                                <select name="country_id" class="form-control country_input" id="country_id">
                                    @foreach ($countries as $country)
                                        <option @if(isset($Cselected_country->id))  @if($Cselected_country->id == $country->id ) selected @endif  @endif value="{{ $country->id }}">{{ Str::title($country->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary">Select</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="country_statistics"></div>
        @if (isset($Ctotal_perticipants))
        {{-- TotalCountryStatistics --}}
            <div class="col-md-12 my-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5">Total {{ Str::title($Cselected_country->name) }} Statistics</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr style="background: #DCDCDC">
                                        <th>Total {{ Str::title($Cselected_country->name) }} Participants So Far</th>
                                        <th>{{ $Ctotal_perticipants->count()}}</th>
                                    </tr>
                                    <tr>
                                        <th>{{ Str::title($Cselected_country->name) }} Average Score So Far</th>
                                        <th>{{ round($Ctotal_perticipants->avg('total_score'))}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-2">
                <div id="Ctabs">
                    <ul>
                      <li><a href="#Ctabs-2"> Chart based on gender</a></li>
                      <li><a href="#Ctabs-3"> Chart based on age group</a></li>
                    </ul>
                    <div id="Ctabs-2">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div>
                                    <canvas id="CgGender"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Ctabs-3">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div>
                                    <canvas  id="Cage"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5">{{ Str::title($Cselected_country->name) }} Statistics By Gender Segments
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr style="background: #DCDCDC">
                                        <th>Gender</th>
                                        <th>Participants</th>
                                        <th>Average Score</th>
                                    </tr>
                                    <tr>
                                        <td>Male</td>
                                        <td>{{ $Cmale_perticipants->count() }}</td>
                                        <td>@if($Cmale_perticipants->avg('total_score')) {{ round($Cmale_perticipants->avg('total_score')) }} @else 0 @endif</td>

                                    </tr>
                                    <tr style="background: #DCDCDC">
                                        <td>Female</td>
                                        <td>{{ $Cfemale_perticipants->count() }}</td>
                                        <td>@if($Cfemale_perticipants->avg('total_score')) {{ round($Cfemale_perticipants->avg('total_score')) }} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td>{{ $Cother_perticipants->count() }}</td>
                                        <td>@if($Cother_perticipants->avg('total_score')) {{ round($Cother_perticipants->avg('total_score')) }} @else 0 @endif</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5">{{ Str::title($Cselected_country->name) }} Statistics by Age Group Segments</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="background: rgba(11, 159, 255, 0.5);color:#000">Age Groups</th>
                                        <td style="background: rgb(255,20,147, 0.7);color:#000">Total Participants</th>
                                        <td style="background: rgb(165,42,42,0.7);color:#000">Average Score</th>
                                    </tr>
                                    <tr>
                                        <td style="background: rgba(11, 159, 255, 0.5);color:#000">01-13</th>
                                        <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($Cperticipants_all_1_13->count()){{ $Cperticipants_all_1_13->count() }} @else 0 @endif </th>
                                        <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($Cperticipants_all_1_13->avg('total_score')){{ round($Cperticipants_all_1_13->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: rgba(11, 159, 255, 0.5);color:#000">14-24</th>
                                        <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($Cperticipants_all_14_24->count()){{ $Cperticipants_all_14_24->count() }} @else 0 @endif </th>
                                        <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($Cperticipants_all_14_24->avg('total_score')){{ round($Cperticipants_all_14_24->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: rgba(11, 159, 255, 0.5);color:#000">25-35</th>
                                        <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($Cperticipants_all_25_35->count()){{ $Cperticipants_all_25_35->count() }} @else 0 @endif </th>
                                        <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($Cperticipants_all_25_35->avg('total_score')){{ round($Cperticipants_all_25_35->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: rgba(11, 159, 255, 0.5);color:#000">36-46</th>
                                        <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($Cperticipants_all_36_46->count()){{ $Cperticipants_all_36_46->count() }} @else 0 @endif </th>
                                        <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($Cperticipants_all_36_46->avg('total_score')){{ round($Cperticipants_all_36_46->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: rgba(11, 159, 255, 0.5);color:#000">47-57</th>
                                        <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($Cperticipants_all_47_57->count()){{ $Cperticipants_all_47_57->count() }} @else 0 @endif </th>
                                        <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($Cperticipants_all_47_57->avg('total_score')){{ round($Cperticipants_all_47_57->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: rgba(11, 159, 255, 0.5);color:#000">58-68</th>
                                        <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($Cperticipants_all_58_68->count()){{ $Cperticipants_all_58_68->count() }} @else 0 @endif </th>
                                        <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($Cperticipants_all_58_68->avg('total_score')){{ round($Cperticipants_all_58_68->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: rgba(11, 159, 255, 0.5);color:#000">69+</th>
                                        <td style="background: rgb(255,20,147, 0.7);color:#000"> @if ($Cperticipants_all_69_plus->count()){{ $Cperticipants_all_69_plus->count() }} @else 0 @endif </th>
                                        <td style="background: rgb(165,42,42,0.7);color:#000"> @if ($Cperticipants_all_69_plus->avg('total_score')){{ round($Cperticipants_all_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5">{{ Str::title($Cselected_country->name) }} Statistics By Gender And Age Segments</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="background: #ffa500b0;color:#000">Age Groups</th>
                                        <th colspan="2" style="background: #800080d1;color:white">Male</th>
                                        <th colspan="2" style="background: #008000d4;color:white">Female</th>
                                        <th colspan="2" style="background: #0000ffba;color:white">Other</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #800080d1;color:white">Total Participants</th>
                                        <td style="background: #800080d1;color:white">Average Score</th>
                                        <td style="background: #008000d4;color:white">Total Participants</th>
                                        <td style="background: #008000d4;color:white">Average Score</th>
                                        <td style="background: #0000ffba;color:white">Total Participants</th>
                                        <td style="background: #0000ffba;color:white">Average Score</th>
                                    </tr>
                                    <tr>
                                        <td style="background: #ffa500b0;color:#000">01-13</th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_1_13->count()){{ $Cperticipants_male_1_13->count() }} @else 0 @endif </th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_1_13->avg('total_score')){{ round($Cperticipants_male_1_13->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_1_13->count()){{ $Cperticipants_female_1_13->count() }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_1_13->avg('total_score')){{ round($Cperticipants_female_1_13->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_1_13->count()){{ $Cperticipants_other_1_13->count() }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_1_13->avg('total_score')){{ round($Cperticipants_other_1_13->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: #ffa500b0;color:#000">14-24</th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_14_24->count()){{ $Cperticipants_male_14_24->count() }} @else 0 @endif </th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_14_24->avg('total_score')){{ round($Cperticipants_male_14_24->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_14_24->count()){{ $Cperticipants_female_14_24->count() }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_14_24->avg('total_score')){{ round($Cperticipants_female_14_24->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_14_24->count()){{ $Cperticipants_other_14_24->count() }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_14_24->avg('total_score')){{ round($Cperticipants_other_14_24->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: #ffa500b0;color:#000">25-35</th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_25_35->count()){{ $Cperticipants_male_25_35->count() }} @else 0 @endif </th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_25_35->avg('total_score')){{ round($Cperticipants_male_25_35->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_25_35->count()){{ $Cperticipants_female_25_35->count() }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_25_35->avg('total_score')){{ round($Cperticipants_female_25_35->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white" style="background: blue;color:white"> @if ($Cperticipants_other_25_35->count()){{ $Cperticipants_other_25_35->count() }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white" style="background: blue;color:white"> @if ($Cperticipants_other_25_35->avg('total_score')){{ round($Cperticipants_other_25_35->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: #ffa500b0;color:#000">36-46</th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_36_46->count()){{ $Cperticipants_male_36_46->count() }} @else 0 @endif </th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_36_46->avg('total_score')){{ round($Cperticipants_male_36_46->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_36_46->count()){{ $Cperticipants_female_36_46->count() }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_36_46->avg('total_score')){{ round($Cperticipants_female_36_46->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_36_46->count()){{ $Cperticipants_other_36_46->count() }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_36_46->avg('total_score')){{ round($Cperticipants_other_36_46->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: #ffa500b0;color:#000">47-57</th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_47_57->count()){{ $Cperticipants_male_47_57->count() }} @else 0 @endif </th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_47_57->avg('total_score')){{ round($Cperticipants_male_47_57->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white" style="background: green;color:white"> @if ($Cperticipants_female_47_57->count()){{ $Cperticipants_female_47_57->count() }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white" style="background: green;color:white"> @if ($Cperticipants_female_47_57->avg('total_score')){{ round($Cperticipants_female_47_57->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_47_57->count()){{ $Cperticipants_other_47_57->count() }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_47_57->avg('total_score')){{ round($Cperticipants_other_47_57->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: #ffa500b0;color:#000">58-68</th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_58_68->count()){{ $Cperticipants_male_58_68->count() }} @else 0 @endif </th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_58_68->avg('total_score')){{ round($Cperticipants_male_58_68->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_58_68->count()){{ $Cperticipants_female_58_68->count() }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_58_68->avg('total_score')){{ round($Cperticipants_female_58_68->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_58_68->count()){{ $Cperticipants_other_58_68->count() }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_58_68->avg('total_score')){{ round($Cperticipants_other_58_68->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td style="background: #ffa500b0;color:#000">69+</th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_69_plus->count()){{ $Cperticipants_male_69_plus->count() }} @else 0 @endif </th>
                                        <td style="background: #800080d1;color:white"> @if ($Cperticipants_male_69_plus->avg('total_score')){{ round($Cperticipants_male_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_69_plus->count()){{ $Cperticipants_female_69_plus->count() }} @else 0 @endif </th>
                                        <td style="background: #008000d4;color:white"> @if ($Cperticipants_female_69_plus->avg('total_score')){{ round($Cperticipants_female_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_69_plus->count()){{ $Cperticipants_other_69_plus->count() }} @else 0 @endif </th>
                                        <td style="background: #0000ffba;color:white"> @if ($Cperticipants_other_69_plus->avg('total_score')){{ round($Cperticipants_other_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        @endif
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
@section('footer_js')
    <script>
        $( function() {
            $( "#tabs" ).tabs();
        } );
        $('.country_input').select2();

        const gGender_2 = document.getElementById('gGender').getContext('2d');

        const gGender = new Chart(gGender_2, {
            type: 'pie',
            data: {
                labels: [
                    'Male Average Score',
                    'Female Average Score',
                    'Others Average Score',
                ],
                datasets: [{
                    label: 'Country Chart',
                    data: [
                        {{ round($male_perticipants->avg('total_score')) }},
                        {{ round($female_perticipants->avg('total_score')) }},
                        {{ round($other_perticipants->avg('total_score')) }},
                    ],
                    backgroundColor: [
                        'rgba(255, 0, 0)',
                        'rgb(0, 0, 255)',
                        'rgba(255, 161, 0)',
                    ],
                    borderColor: [
                        'rgba(255, 0, 0, 0.5)',
                        'rgb(0, 0, 255, 0.5)',
                        'rgba(255, 161, 0, 0.5)',

                    ],
                    borderWidth: 1
                }]
            }
        });
        @if (isset($countryScore[9]->total_score))
            @php
                $countryScores10 = round($countryScore[9]->total_score/$countryScore[9]->total_perticipants);
                $countryScores9 = round($countryScore[8]->total_score/$countryScore[8]->total_perticipants);
                $countryScores8 = round($countryScore[7]->total_score/$countryScore[7]->total_perticipants);
                $countryScores7 = round($countryScore[6]->total_score/$countryScore[6]->total_perticipants);
                $countryScores6 = round($countryScore[5]->total_score/$countryScore[5]->total_perticipants);
                $countryScores5 = round($countryScore[4]->total_score/$countryScore[4]->total_perticipants);
                $countryScores4 = round($countryScore[3]->total_score/$countryScore[3]->total_perticipants);
                $countryScores3 = round($countryScore[2]->total_score/$countryScore[2]->total_perticipants);
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[9]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[8]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[7]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[6]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[5]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[4]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[3]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[2]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores10 }}",
                            "{{ $countryScores9 }}",
                            "{{ $countryScores8 }}",
                            "{{ $countryScores7 }}",
                            "{{ $countryScores6 }}",
                            "{{ $countryScores5 }}",
                            "{{ $countryScores4 }}",
                            "{{ $countryScores3 }}",
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",

                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                            'rgba(255, 161, 0)',
                            'rgba(128, 0, 128)',
                            'rgb(255,20,147)',
                            'rgb(165,42,42)',
                            'rgba(2, 87, 42,0.1)',
                            'rgb(0, 0, 255, 0.1)',
                            'rgba(128, 0, 128, 0.1)',

                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                            'rgba(2, 87, 42,0.5)',
                            'rgba(255, 161, 0,0.5)',
                            'rgba(128, 0, 128,0.5)',
                            'rgb(255,20,147,0.5)',
                            'rgb(165,42,42,0.5)',
                            'rgba(2, 87, 42)',
                            'rgb(0, 0, 255)',
                            'rgba(128, 0, 128)',

                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[8]->total_score))
            @php
                $countryScores9 = round($countryScore[8]->total_score/$countryScore[8]->total_perticipants);
                $countryScores8 = round($countryScore[7]->total_score/$countryScore[7]->total_perticipants);
                $countryScores7 = round($countryScore[6]->total_score/$countryScore[6]->total_perticipants);
                $countryScores6 = round($countryScore[5]->total_score/$countryScore[5]->total_perticipants);
                $countryScores5 = round($countryScore[4]->total_score/$countryScore[4]->total_perticipants);
                $countryScores4 = round($countryScore[3]->total_score/$countryScore[3]->total_perticipants);
                $countryScores3 = round($countryScore[2]->total_score/$countryScore[2]->total_perticipants);
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[8]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[7]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[6]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[5]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[4]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[3]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[2]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores9 }}",
                            "{{ $countryScores8 }}",
                            "{{ $countryScores7 }}",
                            "{{ $countryScores6 }}",
                            "{{ $countryScores5 }}",
                            "{{ $countryScores4 }}",
                            "{{ $countryScores3 }}",
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                            'rgba(255, 161, 0)',
                            'rgba(128, 0, 128)',
                            'rgb(255,20,147)',
                            'rgb(165,42,42)',
                            'rgba(2, 87, 42,0.1)',
                            'rgb(0, 0, 255, 0.1)',

                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                            'rgba(2, 87, 42,0.5)',
                            'rgba(255, 161, 0,0.5)',
                            'rgba(128, 0, 128,0.5)',
                            'rgb(255,20,147,0.5)',
                            'rgb(165,42,42,0.5)',
                            'rgba(2, 87, 42)',
                            'rgb(0, 0, 255)',

                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[7]->total_score))
            @php
                $countryScores8 = round($countryScore[7]->total_score/$countryScore[7]->total_perticipants);
                $countryScores7 = round($countryScore[6]->total_score/$countryScore[6]->total_perticipants);
                $countryScores6 = round($countryScore[5]->total_score/$countryScore[5]->total_perticipants);
                $countryScores5 = round($countryScore[4]->total_score/$countryScore[4]->total_perticipants);
                $countryScores4 = round($countryScore[3]->total_score/$countryScore[3]->total_perticipants);
                $countryScores3 = round($countryScore[2]->total_score/$countryScore[2]->total_perticipants);
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[7]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[6]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[5]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[4]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[3]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[2]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores8 }}",
                            "{{ $countryScores7 }}",
                            "{{ $countryScores6 }}",
                            "{{ $countryScores5 }}",
                            "{{ $countryScores4 }}",
                            "{{ $countryScores3 }}",
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                            'rgba(255, 161, 0)',
                            'rgba(128, 0, 128)',
                            'rgb(255,20,147)',
                            'rgb(165,42,42)',
                            'rgba(2, 87, 42,0.1)',

                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                            'rgba(2, 87, 42,0.5)',
                            'rgba(255, 161, 0,0.5)',
                            'rgba(128, 0, 128,0.5)',
                            'rgb(255,20,147,0.5)',
                            'rgb(165,42,42,0.5)',
                            'rgba(2, 87, 42)',

                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[6]->total_score))
            @php
                $countryScores7 = round($countryScore[6]->total_score/$countryScore[6]->total_perticipants);
                $countryScores6 = round($countryScore[5]->total_score/$countryScore[5]->total_perticipants);
                $countryScores5 = round($countryScore[4]->total_score/$countryScore[4]->total_perticipants);
                $countryScores4 = round($countryScore[3]->total_score/$countryScore[3]->total_perticipants);
                $countryScores3 = round($countryScore[2]->total_score/$countryScore[2]->total_perticipants);
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[6]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[5]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[4]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[3]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[2]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores7 }}",
                            "{{ $countryScores6 }}",
                            "{{ $countryScores5 }}",
                            "{{ $countryScores4 }}",
                            "{{ $countryScores3 }}",
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                            'rgba(255, 161, 0)',
                            'rgba(128, 0, 128)',
                            'rgb(255,20,147)',
                            'rgb(165,42,42)',

                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                            'rgba(2, 87, 42,0.5)',
                            'rgba(255, 161, 0,0.5)',
                            'rgba(128, 0, 128,0.5)',
                            'rgb(255,20,147,0.5)',
                            'rgb(165,42,42,0.5)',

                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[5]->total_score))
            @php
                $countryScores6 = round($countryScore[5]->total_score/$countryScore[5]->total_perticipants);
                $countryScores5 = round($countryScore[4]->total_score/$countryScore[4]->total_perticipants);
                $countryScores4 = round($countryScore[3]->total_score/$countryScore[3]->total_perticipants);
                $countryScores3 = round($countryScore[2]->total_score/$countryScore[2]->total_perticipants);
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[5]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[4]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[3]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[2]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores6 }}",
                            "{{ $countryScores5 }}",
                            "{{ $countryScores4 }}",
                            "{{ $countryScores3 }}",
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                            'rgba(255, 161, 0)',
                            'rgba(128, 0, 128)',
                            'rgb(255,20,147)',

                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                            'rgba(2, 87, 42,0.5)',
                            'rgba(255, 161, 0,0.5)',
                            'rgba(128, 0, 128,0.5)',
                            'rgb(255,20,147,0.5)',
                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[4]->total_score))
            @php
                $countryScores5 = round($countryScore[4]->total_score/$countryScore[4]->total_perticipants);
                $countryScores4 = round($countryScore[3]->total_score/$countryScore[3]->total_perticipants);
                $countryScores3 = round($countryScore[2]->total_score/$countryScore[2]->total_perticipants);
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[4]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[3]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[2]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores5 }}",
                            "{{ $countryScores4 }}",
                            "{{ $countryScores3 }}",
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                            'rgba(255, 161, 0)',
                            'rgba(128, 0, 128)',

                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                            'rgba(2, 87, 42,0.5)',
                            'rgba(255, 161, 0,0.5)',
                            'rgba(128, 0, 128,0.5)',
                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[3]->total_score))
            @php
                $countryScores4 = round($countryScore[3]->total_score/$countryScore[3]->total_perticipants);
                $countryScores3 = round($countryScore[2]->total_score/$countryScore[2]->total_perticipants);
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {
                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[3]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[2]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores4 }}",
                            "{{ $countryScores3 }}",
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",

                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                            'rgba(255, 161, 0)',
                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                            'rgba(2, 87, 42,0.5)',
                            'rgba(255, 161, 0,0.5)',
                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[2]->total_score))
            @php
                $countryScores3 = round($countryScore[2]->total_score/$countryScore[2]->total_perticipants);
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[2]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores3 }}",
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                            'rgba(2, 87, 42,0.5)',
                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[1]->total_score))
            @php
                $countryScores2 = round($countryScore[1]->total_score/$countryScore[1]->total_perticipants);
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[1]->country_id)->name) }} Average Score',
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores2 }}",
                            "{{ $countryScores1 }}",
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                            'rgb(0, 0, 255,0.5)',
                        ],
                        borderWidth: 1
                    }]
                }
            });
        @elseif(isset($countryScore[0]->total_score))
            @php
                $countryScores1 = round($countryScore[0]->total_score/$countryScore[0]->total_perticipants);
            @endphp

            const topCountries_2 = document.getElementById('topCountries').getContext('2d');
            const topCountries = new Chart(topCountries_2, {
                type: 'pie',
                data: {

                    labels: [
                        '{{ Str::title(App\Models\country::find($countryScore[0]->country_id)->name) }} Average Score',
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            "{{ $countryScores1 }}",
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                        ],
                        borderColor: [
                            'rgba(255, 0, 0,0.5)',
                        ],
                        borderWidth: 1
                    }]
                }
            });
        @endif



        const gAge_2 = document.getElementById('gAge').getContext('2d');
        const gAge = new Chart(gAge_2, {
            type: 'pie',
            data: {
                labels: [
                    '01-13 Average Score',
                    '14-24 Average Score',
                    '25-35 Average Score',
                    '36-46 Average Score',
                    '47-57 Average Score',
                    '58-68 Average Score',
                    '69+ Average Score',
                ],
                datasets: [{
                    label: 'Average Score by age groups',
                    data: [
                        {{ round($perticipants_all_1_13->avg('total_score')) }},
                        {{ round($perticipants_all_14_24->avg('total_score')) }},
                        {{ round($perticipants_all_25_35->avg('total_score')) }},
                        {{ round($perticipants_all_36_46->avg('total_score')) }},
                        {{ round($perticipants_all_47_57->avg('total_score')) }},
                        {{ round($perticipants_all_58_68->avg('total_score')) }},
                        {{ round($perticipants_all_69_plus->avg('total_score')) }},
                    ],
                    backgroundColor: [
                        'rgba(255, 0, 0)',
                        'rgb(0, 0, 255)',
                        'rgba(2, 87, 42)',
                        'rgba(255, 161, 0)',
                        'rgba(128, 0, 128)',
                        'rgb(255,20,147)',
                        'rgb(165,42,42)',
                    ],
                    borderColor: [
                        'rgba(255, 0, 0, 0.5)',
                        'rgb(0, 0, 255, 0.5)',
                        'rgba(2, 87, 42, 0.5)',
                        'rgba(255, 161, 0, 0.5)',
                        'rgba(128, 0, 128, 0.5)',
                        'rgb(255,20,147, 0.5)',
                        'rgb(165,42,42, 0.5)',

                    ],
                    borderWidth: 1
                }]
            }
        });









        @if (isset($Ctotal_perticipants))
            $( function() {
                $( "#Ctabs" ).tabs();
            } );
            const Cctx_2 = document.getElementById('CgGender').getContext('2d');
            const CyearlyReport = new Chart(Cctx_2, {
                type: 'pie',
                data: {
                    labels: [
                        'Male Average Score',
                        'Female Average Score',
                        'Others Average Score',
                    ],
                    datasets: [{
                        label: 'Country Chart',
                        data: [
                            {{ round($Cmale_perticipants->avg('total_score')) }},
                            {{ round($Cfemale_perticipants->avg('total_score')) }},
                            {{ round($Cother_perticipants->avg('total_score')) }},
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(255, 161, 0)',
                        ],
                        borderColor: [
                            'rgba(255, 0, 0, 0.5)',
                            'rgb(0, 0, 255, 0.5)',
                            'rgba(255, 161, 0, 0.5)',

                        ],
                        borderWidth: 1
                    }]
                }
            });

            const Cage_2 = document.getElementById('Cage').getContext('2d');
            const Cage = new Chart(Cage_2, {
                type: 'pie',
                data: {
                    labels: [
                        '01-13 Average Score',
                        '14-24 Average Score',
                        '25-35 Average Score',
                        '36-46 Average Score',
                        '47-57 Average Score',
                        '58-68 Average Score',
                        '69+ Average Score'
                    ],
                    datasets: [{
                        label: 'Average Score by age groups',
                        data: [
                            {{ round($Cperticipants_all_1_13->avg('total_score')) }},
                            {{ round($Cperticipants_all_14_24->avg('total_score')) }},
                            {{ round($Cperticipants_all_25_35->avg('total_score')) }},
                            {{ round($Cperticipants_all_36_46->avg('total_score')) }},
                            {{ round($Cperticipants_all_47_57->avg('total_score')) }},
                            {{ round($Cperticipants_all_58_68->avg('total_score')) }},
                            {{ round($Cperticipants_all_69_plus->avg('total_score')) }},
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgba(2, 87, 42)',
                            'rgba(255, 161, 0)',
                            'rgba(128, 0, 128)',
                            'rgb(255,20,147)',
                            'rgb(165,42,42)',
                        ],
                        borderColor: [
                            'rgba(255, 0, 0, 0.5)',
                            'rgb(0, 0, 255, 0.5)',
                            'rgba(2, 87, 42, 0.5)',
                            'rgba(255, 161, 0, 0.5)',
                            'rgba(128, 0, 128, 0.5)',
                            'rgb(255,20,147, 0.5)',
                            'rgb(165,42,42, 0.5)',

                        ],
                        borderWidth: 1
                    }]
                }
            });

            // $('html, body').animate({
            //     scrollTop: $("#country_div").offset().top
            // }, 2000);
            window.location.href = "{{ url()->current().'#country_statistics' }}";
        @endif
    </script>

@endsection
@section('internal_css')
<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    #container {
        height: 400px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
    rect[Attributes Style] {
        x: 45.5;
        y: 41.5;
        width: 85;
        height: 287;
        fill: red;
        stroke: rgb(255, 255, 255);
        stroke-width: 1;
        opacity: 1;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #17a2b8 !important;
        color: #fff !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
    }
    .select2-container--default .select2-selection--single {
        height: 38px !important;
    }
    .select2-container{
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 3px 11px;
    }
    /* @media screen and (max-width: 992px) {
        body {
            background-color: blue;
        }
    } */

</style>
@endsection
