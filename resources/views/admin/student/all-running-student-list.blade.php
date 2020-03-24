@extends('admin.master')

@section('title','All Running Student List')

@section('main-content')
    <!--Content Start-->

@include('admin.includes.alert')


<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">All Running Student List</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Student Name</th>
                        <th>School</th>
                        <th>Class</th>
                        <th>Father's Name</th>
                        <th>Father's Mobile</th>
                        <th>Mother's Name</th>
                        <th>Mother's Mobile</th>
                        <th>SMS Mobile</th>
                        <th colspan="3" style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($students as $key => $student)                        
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{$student->student_name}}</td>
                        <td>{{$student->school_name}}</td>
                        <td>{{$student->class_name}}</td>
                        <td>{{$student->father_name}}</td>
                        <td>{{$student->father_mobile}}</td>
                        <td>{{$student->mother_name}}</td>
                        <td>{{$student->mother_mobile}}</td>
                        <td>{{$student->sms_mobile}}</td>
                        <td>
                            <a href="{{route('student-details',$student->id)}}" target="_blank" class="p-0 btn btn-dark fa fa-eye" title="Details"></a>
                            <a href="#" class="p-0 btn btn-info fa fa-edit" title="Edit"></a>
                            <a href="#" class="p-0 btn btn-danger fa fa-trash-alt" onclick="return confirm('Are you sure to delete ?')" title="Delete"></a>
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