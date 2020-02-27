@extends('admin.master')

@section('title','Slide List')

@section('main-content')
    <!--Content Start-->


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


<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Slide List</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Slide Title</th>
                        <th>Slide Description</th>
                        <th>Slide Image</th>
                        <th>Slide Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($slides as $key => $slide)                        
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{$slide->slide_title}}</td>
                        <td>{{$slide->slide_description}}</td>
                        <td><img src="{{asset($slide->slide_image)}}" width="150px" alt="Slide Image"></td>
                        @if ($slide->status==1)
                            <td class="text-success font-weight-bold">Published</td>
                        @else
                            <td class="text-warning font-weight-bold">Unpublished</td>
                        @endif
                        {{-- <td>{{$slide->status==1 ? 'Published':'Unpublished'}}</td> --}}
                        
                        <td>
                        @if ($slide->status==1)
                            <a href="{{route('slide-unpublished',$slide->id)}}" title="Deactivate" class="btn btn-warning fa fa-arrow-alt-circle-down"></a>
                        @else
                            <a href="{{route('slide-published',$slide->id)}}" title="Activate" class="btn btn-success fa fa-arrow-alt-circle-up"></a>
                        @endif
                            <a href="{{route('slide-edit',$slide->id)}}" class="btn btn-info fa fa-edit"></a>
                            <a href="{{route('slide-delete',$slide->id)}}" class="btn btn-danger fa fa-trash-alt" onclick="return confirm('Are you sure to delete ?')"></a>
                            {{-- <form action="{{route('slide-delete',$slide->id)}}" method="post"></form> --}}
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