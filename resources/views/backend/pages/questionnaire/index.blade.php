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
                                        <th>Questionnare Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questionnaires as $questionnaire)
                                       <tr>
                                            <td>{{ $loop->index +1 }}</td>
                                            <td>{{ $questionnaire->title }}</td>
                                            <td><a href="{{ route('frontend.question.show',$questionnaire) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View</a></td>
                                       </tr>
                                    @endforeach
                                </tbody>
                            </table>

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
@section('footer_js')
    <script>
        // Notification
        @if (session('success'))
            toastr["success"]("{{ session('success') }}");
        @elseif(session('error'))
            toastr["error"]("{{ session('error') }}");
        @endif
        //  Dynamic Field Add/Remove
        $('.multi-field-wrapper').each(function(){
        var $wrapper = $('.multi-fields', this);
        $('.add-field').click(function(){
            $('.multi-field:first-child').clone(true).appendTo($wrapper).find('.q').val(1);
            // $('.multi-field:first-child').clone(true).appendTo($wrapper).find('.q').val(1);

        });
        $('.remove-field').click(function(){
            if($('.multi-field', $wrapper).length >1){
                $(this).parent('.multi-field').remove();
            }
        });
    });

    </script>
@endsection
