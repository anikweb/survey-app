@extends('frontend.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Country Based Statistics</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.country.statistics.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @if (isset($Cquestionnaire->id))
                                    <input type="hidden" name="qustionnaire_id" value="{{ $Cquestionnaire->id }}">
                                @endif
                                @if (isset($questionnaire->id))
                                    <input type="hidden" name="qustionnaire_id" value="{{ $questionnaire->id }}">
                                @endif
                                <label for="country_id"><strong>Search You Country <span>*</span></strong></label>
                                <select name="country_id" class="form-control" id="country_id">
                                    @foreach ($countries as $country)
                                        <option @if(isset($Cselected_country->id))  @if($Cselected_country->id == $country->id ) selected @endif  @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (isset($Ctotal_perticipants))
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Total {{ $Cselected_country->name }} Statistics
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Total {{ $Cselected_country->name }} Participants So Far</th>
                                    <th>{{ $Ctotal_perticipants->count()}}</th>
                                </tr>
                                <tr>
                                    <th>{{ $Cselected_country->name }} Average Score So Far</th>
                                    <th>{{ round($Ctotal_perticipants->avg('total_score'))}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5">{{ $Cselected_country->name }} Statistics By Gender Segments
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Gender</th>
                                        <th>Participants</th>
                                        <th>Average Score</th>
                                    </tr>
                                    <tr>
                                        <td>Male</td>
                                        <td>{{ $Cmale_perticipants->count() }}</td>
                                        <td>@if($Cmale_perticipants->avg('total_score')) {{ $Cmale_perticipants->avg('total_score') }} @else 0 @endif</td>

                                    </tr>
                                    <tr>
                                        <td>Female</td>
                                        <td>{{ $Cfemale_perticipants->count() }}</td>
                                        <td>@if($Cfemale_perticipants->avg('total_score')) {{ $Cfemale_perticipants->avg('total_score') }} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td>{{ $Cother_perticipants->count() }}</td>
                                        <td>@if($Cother_perticipants->avg('total_score')) {{ $Cother_perticipants->avg('total_score') }} @else 0 @endif</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5">{{ $Cselected_country->name }} Statistics By Gender And Age Segments</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Age Groups</th>
                                        <th colspan="2">Male</th>
                                        <th colspan="2">Female</th>
                                        <th colspan="2">Other</th>
                                    </tr>
                                    <tr>
                                        <td>Total Participants</th>
                                        <td>Average Score</th>
                                        <td>Total Participants</th>
                                        <td>Average Score</th>
                                        <td>Total Participants</th>
                                        <td>Average Score</th>
                                    </tr>
                                    <tr>
                                        <td>01-13</th>
                                        <td> @if ($Cperticipants_male_1_13->count()){{ $Cperticipants_male_1_13->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_male_1_13->avg('total_score')){{ round($Cperticipants_male_1_13->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_1_13->count()){{ $Cperticipants_female_1_13->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_1_13->avg('total_score')){{ round($Cperticipants_female_1_13->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_1_13->count()){{ $Cperticipants_other_1_13->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_1_13->avg('total_score')){{ round($Cperticipants_other_1_13->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td>14-24</th>
                                        <td> @if ($Cperticipants_male_14_24->count()){{ $Cperticipants_male_14_24->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_male_14_24->avg('total_score')){{ round($Cperticipants_male_14_24->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_14_24->count()){{ $Cperticipants_female_14_24->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_14_24->avg('total_score')){{ round($Cperticipants_female_14_24->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_14_24->count()){{ $Cperticipants_other_14_24->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_14_24->avg('total_score')){{ round($Cperticipants_other_14_24->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td>25-35</th>
                                        <td> @if ($Cperticipants_male_25_35->count()){{ $Cperticipants_male_25_35->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_male_25_35->avg('total_score')){{ round($Cperticipants_male_25_35->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_25_35->count()){{ $Cperticipants_female_25_35->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_25_35->avg('total_score')){{ round($Cperticipants_female_25_35->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_25_35->count()){{ $Cperticipants_other_25_35->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_25_35->avg('total_score')){{ round($Cperticipants_other_25_35->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td>36-46</th>
                                        <td> @if ($Cperticipants_male_36_46->count()){{ $Cperticipants_male_36_46->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_male_36_46->avg('total_score')){{ round($Cperticipants_male_36_46->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_36_46->count()){{ $Cperticipants_female_36_46->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_36_46->avg('total_score')){{ round($Cperticipants_female_36_46->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_36_46->count()){{ $Cperticipants_other_36_46->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_36_46->avg('total_score')){{ round($Cperticipants_other_36_46->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td>47-57</th>
                                        <td> @if ($Cperticipants_male_47_57->count()){{ $Cperticipants_male_47_57->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_male_47_57->avg('total_score')){{ round($Cperticipants_male_47_57->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_47_57->count()){{ $Cperticipants_female_47_57->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_47_57->avg('total_score')){{ round($Cperticipants_female_47_57->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_47_57->count()){{ $Cperticipants_other_47_57->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_47_57->avg('total_score')){{ round($Cperticipants_other_47_57->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td>58-68</th>
                                        <td> @if ($Cperticipants_male_58_68->count()){{ $Cperticipants_male_58_68->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_male_58_68->avg('total_score')){{ round($Cperticipants_male_58_68->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_58_68->count()){{ $Cperticipants_female_58_68->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_58_68->avg('total_score')){{ round($Cperticipants_female_58_68->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_58_68->count()){{ $Cperticipants_other_58_68->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_58_68->avg('total_score')){{ round($Cperticipants_other_58_68->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                    <tr>
                                        <td>69+</th>
                                        <td> @if ($Cperticipants_male_69_plus->count()){{ $Cperticipants_male_69_plus->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_male_69_plus->avg('total_score')){{ round($Cperticipants_male_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_69_plus->count()){{ $Cperticipants_female_69_plus->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_female_69_plus->avg('total_score')){{ round($Cperticipants_female_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_69_plus->count()){{ $Cperticipants_other_69_plus->count() }} @else 0 @endif </th>
                                        <td> @if ($Cperticipants_other_69_plus->avg('total_score')){{ round($Cperticipants_other_69_plus->avg('total_score')) }} @else 0 @endif </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="Ctabs">
                    <ul>
                      <li><a href="#Ctabs-1">{{ $Cselected_country->name }} Chart</a></li>
                      <li><a href="#Ctabs-2">{{ $Cselected_country->name }} Chart based on gender</a></li>
                      <li><a href="#Ctabs-3">{{ $Cselected_country->name }} Chart based on age</a></li>
                    </ul>
                    <div id="Ctabs-1">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <canvas id="CmyChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <figure class="highcharts-figure">
                                    <div id="Cchart2"></div>
                                    {{-- <p class="highcharts-description">
                                        Bar chart showing horizontal columns. This chart type is often
                                        beneficial for smaller screens, as the user can scroll through the data
                                        vertically, and axis labels are easy to read.
                                    </p> --}}
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div id="Ctabs-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <canvas id="CgGender"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <figure class="highcharts-figure">
                                    <div id="Cchart3"></div>
                                    {{-- <p class="highcharts-description">
                                        Bar chart showing horizontal columns. This chart type is often
                                        beneficial for smaller screens, as the user can scroll through the data
                                        vertically, and axis labels are easy to read.
                                    </p> --}}
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div id="Ctabs-3">
                        <div class="row">
                            <div class="col-md-4">
                                <figure class="highcharts-figure">
                                    <div id="Cchart4"></div>
                                    {{-- <p class="highcharts-description">
                                        Bar chart showing horizontal columns. This chart type is often
                                        beneficial for smaller screens, as the user can scroll through the data
                                        vertically, and axis labels are easy to read.
                                    </p> --}}
                                </figure>
                            </div>
                            <div class="col-md-4">

                                <figure class="highcharts-figure">
                                    <div id="Cchart5"></div>
                                    {{-- <p class="highcharts-description">
                                        Bar chart showing horizontal columns. This chart type is often
                                        beneficial for smaller screens, as the user can scroll through the data
                                        vertically, and axis labels are easy to read.
                                    </p> --}}
                                </figure>
                            </div>
                            <div class="col-md-4">

                                <figure class="highcharts-figure">
                                    <div id="Cchart6"></div>
                                    {{-- <p class="highcharts-description">
                                        Bar chart showing horizontal columns. This chart type is often
                                        beneficial for smaller screens, as the user can scroll through the data
                                        vertically, and axis labels are easy to read.
                                    </p> --}}
                                </figure>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>

    @endif
</div>

@endsection
@if (isset($Ctotal_perticipants))
    @section('footer_js')
        <script>
            $( function() {
                $( "#Ctabs" ).tabs();
            } );
            // Chart
        // Yearly Report Chart Start

            const Cctx_1 = document.getElementById('CmyChart').getContext('2d');
            const Cdata = new Chart(Cctx_1, {
                type: 'pie',
                data: {
                    labels: [
                        '{{ $Cselected_country->name }} Participants So Far',
                        '{{ $Cselected_country->name }} Average Score So Far',
                    ],
                    datasets: [{
                        label: '{{ $Cselected_country->name }} Chart',
                        data: [
                            {{ round($Ctotal_perticipants->avg("total_score")) }},
                            {{ $Ctotal_perticipants->count() }},
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                }
            });

            Highcharts.chart('Cchart2', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '{{ $Cselected_country->name }} Participants So Far',
                        '{{ $Cselected_country->name }} Average Score So Far',
                    ],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: '{{ $Cselected_country->name }} Statistics',
                    data: [{{ $Ctotal_perticipants->count() }}, {{ round($Ctotal_perticipants->avg('total_score')) }}]
                }]
            });

            const Cctx_2 = document.getElementById('CgGender').getContext('2d');
            const CyearlyReport = new Chart(Cctx_2, {
                type: 'pie',
                data: {
                    labels: [
                        'Male Participants',
                        'Female Participants',
                        'Others Participants',
                    ],
                    datasets: [{
                        label: 'Global Chart',
                        data: [
                            {{ $Cmale_perticipants->count() }},
                            {{ $Cfemale_perticipants->count() }},
                            {{ $Cother_perticipants->count() }},
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',

                        ],
                        borderWidth: 1
                    }]
                }
            });

            Highcharts.chart('Cchart3', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        'Male',
                        'Female',
                        'Others',
                    ],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Participants',
                    data: [{{ $Cmale_perticipants->count() }}, {{ $Cfemale_perticipants->count() }},{{ $Cother_perticipants->count() }}]
                },{
                    name: 'Average Score',
                    data: [{{ round($Cmale_perticipants->avg('total_score')) }},{{ round($Cfemale_perticipants->avg('total_score')) }},{{ round($Cother_perticipants->avg('total_score')) }}]
                }]
            });


            Highcharts.chart('Cchart4', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Male'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '01-13',
                        '14-24',
                        '25-35',
                        '36-46',
                        '47-57',
                        '58-68',
                        '69+'
                    ],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Total Participants',
                    data: [
                        {{ $Cperticipants_male_1_13->count() }},
                        {{ $Cperticipants_male_14_24->count() }},
                        {{ $Cperticipants_male_25_35->count() }},
                        {{ $Cperticipants_male_36_46->count() }},
                        {{ $Cperticipants_male_47_57->count() }},
                        {{ $Cperticipants_male_58_68->count() }},
                        {{ $Cperticipants_male_69_plus->count() }},
                    ]
                },{
                    name: 'Average Score',
                    data: [
                        {{ round($Cperticipants_male_1_13->avg('total_score')) }},
                        {{ round($Cperticipants_male_14_24->avg('total_score')) }},
                        {{ round($Cperticipants_male_25_35->avg('total_score')) }},
                        {{ round($Cperticipants_male_36_46->avg('total_score')) }},
                        {{ round($Cperticipants_male_47_57->avg('total_score')) }},
                        {{ round($Cperticipants_male_58_68->avg('total_score')) }},
                        {{ round($Cperticipants_male_69_plus->avg('total_score')) }},
                    ]
                }]
            });

            Highcharts.chart('Cchart5', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Female'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '01-13',
                        '14-24',
                        '25-35',
                        '36-46',
                        '47-57',
                        '58-68',
                        '69+'
                    ],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Total Participants',
                    data: [
                        {{ $Cperticipants_female_1_13->count() }},
                        {{ $Cperticipants_female_14_24->count() }},
                        {{ $Cperticipants_female_25_35->count() }},
                        {{ $Cperticipants_female_36_46->count() }},
                        {{ $Cperticipants_female_47_57->count() }},
                        {{ $Cperticipants_female_58_68->count() }},
                        {{ $Cperticipants_female_69_plus->count() }},
                    ]
                },{
                    name: 'Average Score',
                    data: [
                        {{ round($Cperticipants_female_1_13->avg('total_score')) }},
                        {{ round($Cperticipants_female_14_24->avg('total_score')) }},
                        {{ round($Cperticipants_female_25_35->avg('total_score')) }},
                        {{ round($Cperticipants_female_36_46->avg('total_score')) }},
                        {{ round($Cperticipants_female_47_57->avg('total_score')) }},
                        {{ round($Cperticipants_female_58_68->avg('total_score')) }},
                        {{ round($Cperticipants_female_69_plus->avg('total_score')) }},
                    ]
                }]
            });
            Highcharts.chart('Cchart6', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Other'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '01-13',
                        '14-24',
                        '25-35',
                        '36-46',
                        '47-57',
                        '58-68',
                        '69+'
                    ],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Total Participants',
                    data: [
                        {{ $Cperticipants_other_1_13->count() }},
                        {{ $Cperticipants_other_14_24->count() }},
                        {{ $Cperticipants_other_25_35->count() }},
                        {{ $Cperticipants_other_36_46->count() }},
                        {{ $Cperticipants_other_47_57->count() }},
                        {{ $Cperticipants_other_58_68->count() }},
                        {{ $Cperticipants_other_69_plus->count() }},
                    ]
                },{
                    name: 'Average Score',
                    data: [
                        {{ round($Cperticipants_other_1_13->avg('total_score')) }},
                        {{ round($Cperticipants_other_14_24->avg('total_score')) }},
                        {{ round($Cperticipants_other_25_35->avg('total_score')) }},
                        {{ round($Cperticipants_other_36_46->avg('total_score')) }},
                        {{ round($Cperticipants_other_47_57->avg('total_score')) }},
                        {{ round($Cperticipants_other_58_68->avg('total_score')) }},
                        {{ round($Cperticipants_other_69_plus->avg('total_score')) }},
                    ]
                }]
            });
        </script>
    @endsection

@endif
