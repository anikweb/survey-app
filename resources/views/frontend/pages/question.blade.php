@extends('frontend.master')

@section('meta_tag')
    <meta property="og:url"                content="{{ url()->current() }}" />
    <meta property="og:type"               content="survey" />
    <meta property="og:title"              content="{{ $questionnaire->title }}" />
    <meta property="og:description"        content="{{ $questionnaire->details }}" />
    <meta property="og:image"              content="{{ asset('backend/images/questionnaire').'/'.$questionnaire->created_at->format('Y/m/d/').$questionnaire->id.'/image/'.$questionnaire->image }}" />
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-2">{{ $questionnaire->title }}</h2>
            <p>{{ $questionnaire->details }}</p>
            <hr>
            <div class="card">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            You need to submit all question.
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                           {{session('error')}}
                        </div>
                    @endif
                    <form action="{{ route('frontend.question.store') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="questionnaire_id" value="{{ $questionnaire->id }}">
                        @foreach ($question as $item)
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h6">
                                        {{ $loop->index +1 }}. {{ $item->question_title }}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        <input type="hidden" name="index[]" value="{{ $loop->index +1 }}">
                                        <input type="radio" name="question[{{ $loop->index+1 }}]"  value="{{ $item->optionValue->first()->point1 }}">
                                        {{ $item->optionValue->first()->option1 }}
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        <input type="radio" name="question[{{ $loop->index+1 }}]" value="{{ $item->optionValue->first()->point2 }}">
                                        {{ $item->optionValue->first()->option2 }}
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        <input type="radio" name="question[{{ $loop->index+1 }}]" value="{{ $item->optionValue->first()->point3 }}">
                                        {{ $item->optionValue->first()->option3 }}
                                    </label>
                                </div>
                                @if ($item->optionValue->first()->option4)
                                    <div class="col-md-12">
                                        <label>
                                            <input type="radio" name="question[{{ $loop->index+1 }}]" value="{{ $item->optionValue->first()->point4 }}">
                                            {{ $item->optionValue->first()->option4 }}
                                        </label>
                                    </div>
                                @endif
                                @if ($item->optionValue->first()->option5)
                                    <div class="col-md-12">
                                        <label>
                                            <input type="radio" name="question[{{ $loop->index+1 }}]" value="{{ $item->optionValue->first()->point5 }}">
                                            {{ $item->optionValue->first()->option5 }}
                                        </label>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                            <div class="row">
                                <div class="col-md-3 mr-5">
                                    <div class="form-group">
                                        <label for="age"><strong>Your Age <span>*</span></strong></label>
                                        <input type="number" name="age" id="age" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>Your Gender <span>*</span></strong>
                                            <div class="form-group mt-2 mb-0 pb-0">
                                                <label for="male" class="mr-4">
                                                    <input type="radio" name="gender" value='male' id="male"> Male
                                                </label>
                                                <label for="female" class="mr-4">
                                                    <input type="radio" name="gender" value='female' id="female"> Female
                                                </label>
                                                <label for="other" class="mr-4">
                                                    <input type="radio" name="gender" value='other' id="other"> Other
                                                </label>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="country_id"><strong>Your Country <span>*</span></strong></label>
                                    <select class="form-control country_id" name="country_id" id="country_id">
                                        <option value="">-Select-</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ Str::title($country->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 mt-md-0">
                                <div class="col-md-12 text-center text-md-left">
                                    <button type="submit" class="btn-lg btn-primary my-2 mr-md-5 mr-md-0">Submit Test</button>
                                    <button type="button" onClick="location.href=location.href" class="btn-lg text-white my-2 ml-md-5" style="background: gray">Clear Test</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

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
                    <a target="_blank" href="{{ $item }}" class="btn text-white  mr-2 my-1" style="background: #0176af"> <i class="fab fa-linkedin-in"></i> {{ Str::title($key) }}</a>
                @endif
                @if ($key == 'twitter')
                    <a target="_blank" href="{{ $item }}" class="btn text-white  mr-2 my-1" style="background: #1c99e6"> <i class="fab fa-twitter"></i> {{ Str::title($key) }}</a>
                @endif
                @if ($key == 'whatsapp')
                    <a target="_blank" href="{{ $item }}" class="btn text-white  mr-2 my-1" style="background: #44bc54"> <i class="fab fa-whatsapp"></i> {{ Str::title($key) }}</a>
                @endif
                @if ($key == 'telegram')
                    <a target="_blank" href="{{ $item }}" class="btn text-white  mr-2 my-1" style="background: #0393d9"> <i class="fab fa-telegram-plane"></i> {{ Str::title($key) }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection
@section('footer_js')
<script>
    $(document).ready(function() {
        $('.country_id').select2();
    });
</script>

@endsection
@section('internal_css')
<style>
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
</style>
@endsection
