@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Result and Suggestion</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Result and Suggestion</li>
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
                       <h3 class="card-title">Result and Suggestion</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Age Group</th>
                                        <th>Position</th>
                                        <th>Result</th>
                                        <th>Suggestion</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                       <tr @if($loop->index % 2 == 0) style="background:#DCDCDC" @endif>
                                            <td style="width: 4%">{{ $result->result_group }}</td>
                                            <td style="width: 10%">{{ $result->position }}</td>
                                            <td style="width: 40%">
                                                @php
                                                    echo $result->result;
                                                @endphp
                                            </td>
                                            <td style="width: 40%">
                                                @php
                                                    echo $result->suggestion;
                                                @endphp
                                            </td>
                                            <td style="width: 6%">
                                                <a class="btn btn-primary" href="{{ route('result-and-suggestion.edit',$result->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                       </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div>
                                {{ $questionnaires->links() }}
                            </div> --}}

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
