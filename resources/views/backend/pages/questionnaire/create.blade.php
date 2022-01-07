@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Questionnaire</h1>
                </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Create Questionnaire</li>
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
                        <h3 class="card-title">Create Questionnaire</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            You need to filup title,details,image fields.
                        </div>
                    @endif
                        <form action="{{ route('questionnaire.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title <span>*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Write Details <span>*</span></label>
                                        <textarea placeholder="Write Details" class="form-control" name="details" rows="5">Write Details</textarea>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <label>Image <span>*</span></label>
                                        <input type="file" name="image">
                                        <hr>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="multi-field-wrapper">
                                            <div class="multi-fields">
                                                <div class="row multi-field form-group my-2">
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Question <span>*</span> </label>
                                                                    <input type="text" name="question[]"  class="form-control" placeholder="Enter Question">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Option 1 <span>*</span></label>
                                                                    <input type="text" name="option1[]"  class="form-control" placeholder="Enter Option 1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label>Point <span>*</span></label>
                                                                    <input type="number" name="point1[]"  class="form-control" placeholder="Point">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Option 2 <span>*</span></label>
                                                                    <input type="text" name="option2[]"  class="form-control" placeholder="Enter Option 2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label>Point <span>*</span></label>
                                                                    <input type="number" name="point2[]"  class="form-control" placeholder="Point">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Option 3 <span>*</span></label>
                                                                    <input type="text" name="option3[]"  class="form-control" placeholder="Enter Option 3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label>Point <span>*</span></label>
                                                                    <input type="number" name="point3[]"  class="form-control" placeholder="Point">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Option 4 <span>*</span></label>
                                                                    <input type="text" name="option4[]"  class="form-control" placeholder="Enter Option 4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label>Point <span>*</span></label>
                                                                    <input type="number" name="point4[]"  class="form-control" placeholder="Point">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Option 5 <span>*</span></label>
                                                                    <input type="text" name="option5[]"  class="form-control" placeholder="Enter Option 5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label>Point <span>*</span></label>
                                                                    <input type="number" name="point5[]"  class="form-control" placeholder="Point">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-2 remove-field outline-danger text-white my-auto">
                                                        <span class="text-danger" style="cursor:pointer"><i class=" fas fa-minus-circle"></i> Remove</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="add-field btn-sm btn-info ">Add new field</button>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-12 text-center">
                                      <button class="btn btn-primary" type="submit"> <i class="fa fa-plus-circle"></i> Create Questionnaire</button>
                                  </div>
                            </div>

                        </form>
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

