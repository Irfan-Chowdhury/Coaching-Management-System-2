@extends('admin.master')

@section('title','Student Proile')

@section('main-content')
    <!--Content Start-->

@include('admin.includes.alert')

<div class="container">
    <div class="row">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">{{$students[0]->student_name}}'s Profile</h4>
                </div>
            </div>

            <div class="row ml-0 mr-0">
                <div class="col-md-3">
                    @if (isset($students[0]->student_photo))
                        <img src="{{asset($students[0]->student_photo)}}" alt="Profile Picture">
                    @else
                        <img src="{{asset('admin/assets/images/avatar.jpeg')}}" alt="Profile Picture">
                    @endif
                    
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <a href="#" class="btn btn-block my-btn-submit">Edit Profile</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Student Name</th>
                                <td>{{$students[0]->student_name}}</td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td>{{$students[0]->father_name}}</td>
                            </tr>
                            <tr>
                                <th>Father's Profession</th>
                                <td>{{$students[0]->father_profession}}</td>
                            </tr>
                            <tr>
                                <th>Father's Mobile</th>
                                <td>{{$students[0]->father_mobile}}</td>
                            </tr>
                            <tr>
                                <th>Mother's Name</th>
                                <td>{{$students[0]->mother_name}}</td>
                            </tr>
                            <tr>
                                <th>Mother's Profession</th>
                                <td>{{$students[0]->mother_profession}}</td>
                            </tr>
                            <tr>
                                <th>Mother's Mobile</th>
                                <td>{{$students[0]->mother_mobile}}</td>
                            </tr>
                            <tr>
                                <th>School</th>
                                <td>{{$students[0]->school_name}}</td>
                            </tr>
                            <tr>
                                <th>Class</th>
                                <td>{{$students[0]->class_name}}</td>
                            </tr>
                            <tr>
                                <th>SMS Mobile</th>
                                <td>{{$students[0]->sms_mobile}}</td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td>{{$students[0]->email_address}}</td>
                            </tr>
                            <tr>
                                <th>Student ID</th>
                                <td>{{$students[0]->id}}</td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>{{$students[0]->password}}</td>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle">Course Info</th>
                                <td>
                                    @foreach ($students as $student)
                                        <b>Course:</b> {{$student->student_type}} || <b>Batch:</b> {{$student->batch_name}} || <b>Roll:</b> {{$student->roll_no}}
                                        <br>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!--Content End-->
@endsection