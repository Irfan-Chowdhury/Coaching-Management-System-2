@extends('admin.master')

@section('title','Schools List')

@section('main-content')
@if (Session::get('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Message: </strong>{{Session::get('success_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
@elseif (Session::get('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Message: </strong>{{Session::get('error_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Schools List</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>#SL</th>
                        <th>School Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($schools as $key => $school)                        
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{$school->school_name}}</td>
                        {{-- <td>{{$school->status==1 ? 'Published':'Unpublished'}}</td> --}}
                        @if ($school->status==1)
                            <td class="text-success font-weight-bold">Published</td>
                        @else
                            <td class="text-warning font-weight-bold">Unpublished</td>
                        @endif

                        <td>
                        @if ($school->status==1)
                            <a href="{{route('school-unpublished',$school->id)}}" title="Deactivate" class="btn btn-warning fa fa-arrow-alt-circle-down"></a>
                        @else
                            <a href="{{route('school-published',$school->id)}}" title="Activate" class="btn btn-success fa fa-arrow-alt-circle-up"></a>
                        @endif
                            <a href="{{route('school-edit',$school->id)}}" title="Edit" class="btn btn-info fa fa-edit"></a>
                            <a href="{{route('school-delete',$school->id)}}" onclick="return confirm('Are you Sure to delete ?')" class="btn btn-danger fa fa-trash-alt"></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--Content End-->
@endsection