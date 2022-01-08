@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit <strong>{{ $result->position }}</strong> Position</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('result-and-suggestion.index') }}">Result and Suggestion</a></li>
                        <li class="breadcrumb-item active">Edit <strong>{{ $result->position }}</strong> Position</li>
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
                       <h3 class="card-title">Edit <strong>{{ $result->position }}</strong> Position</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <span>You need to fill up the required field.</span>
                            </div>
                        @endif
                        <form action="{{ route('result-and-suggestion.update',$result->id) }}" method="POST">
                            <input type="hidden" name="result_id" value="{{ $result->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @method("PUT")
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="result">Result <span>*</span></label>
                                        <textarea placeholder="Write Result" name="result" id="result" class="form-control" rows="10">{{ $result->result }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="suggestion">Suggestion <span>*</span></label>
                                        <textarea name="suggestion" id="suggestion" class="form-control" rows="10">{{ $result->suggestion }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
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
        CKEDITOR.replace( 'result' );
        CKEDITOR.replace( 'suggestion' );
    </script>
@endsection
