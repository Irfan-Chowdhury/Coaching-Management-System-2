@extends('admin.master')

@section('title','Classes List')

@section('main-content')

    <!--Content Start-->
    <section class="container-fluid">
        <div class="row content">
            <div class="col-md-8 offset-md-2 pl-0 pr-0">

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

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Classes List</h4>
                    </div>
                </div>

                <div class="table-responsive p-1">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Class Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($classes as $key => $class)                        
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$class->class_name}}</td>
                            {{-- <td>{{$class->status==1 ? 'Published':'Unpublished'}}</td> --}}
                            @if ($class->status==1)
                                <td class="text-success font-weight-bold">Published</td>
                            @else
                                <td class="text-warning font-weight-bold">Unpublished</td>
                            @endif
    
                            <td>
                            @if ($class->status==1)
                                <a href="{{route('class-unpublished',$class->id)}}" title="Deactivate" class="btn btn-warning fa fa-arrow-alt-circle-down"></a>
                            @else
                                <a href="{{route('class-published',$class->id)}}" title="Activate" class="btn btn-success fa fa-arrow-alt-circle-up"></a>
                            @endif
                                <a href="{{route('class-edit',$class->id)}}" title="Edit" class="btn btn-info fa fa-edit"></a>
                                <a href="{{route('class-delete',$class->id)}}" onclick="return confirm('Are you Sure to delete ?')" class="btn btn-danger fa fa-trash-alt"></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection