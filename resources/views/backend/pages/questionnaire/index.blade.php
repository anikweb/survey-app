@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Questionnaires</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Questionnaires</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        Questionnaires
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Questionnare Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questionnaires as $questionnaire)
                                        <tr @if($loop->index % 2 == 0) style="background:#DCDCDC" @endif>
                                            <td style="width:5%">{{ $questionnaires->firstItem() + $loop->index }}</td>
                                            <td style="width:5%">
                                                <img style="width:300px" class="card-img-top" src="{{ asset('backend/images/questionnaire').'/'.$questionnaire->created_at->format('Y/m/d/').$questionnaire->id.'/image/'.$questionnaire->image }}" alt="{{ $questionnaire->title }}">
                                            </td>
                                            <td style="width:35%">{{ $questionnaire->title }}</td>
                                            <td style="width:30%">{{ $questionnaire->details }}</td>
                                            <td style="width:30%">
                                                <a href="{{ route('frontend.question.show',$questionnaire->slug) }}" class="btn btn-info"><i class="fa fa-eye"></i> View</a>
                                                <a href="{{ route('questionnaire.edit',$questionnaire->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                <form class="d-inline" action="{{ route('questionnaire.destroy',$questionnaire->id) }}" method="POST" >
                                                    @method("DELETE")
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{ $questionnaires->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
