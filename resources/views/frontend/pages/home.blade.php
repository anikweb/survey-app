@extends('frontend.master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h1 class="text-danger">Social Tests, Polls, Quizes and Surveys</h1>
            <div class="alert" style="background:PaleTurquoise">Social Test Data offers various social tests, polls, quizes and surveys to find out social tendencies all over the world. Test various aspects of your personality, see the results and get suggestions based on your score.</div>
        </div>
        <div class="col-md-12">
            <div class="row">
                @foreach ($questionnaire as $item)
                    <div class="col-md-4 my-2">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('backend/images/questionnaire').'/'.$item->created_at->format('Y/m/d/').$item->id.'/image/'.$item->image }}" alt="{{ $item->title }}">
                            <div class="card-body">
                                <a href="{{ route('frontend.question.show',$item->slug) }}" class="h5">{{ $item->title }}</a>
                                <p class="card-text">{{ $item->details }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
