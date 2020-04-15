@extends('admin.master')

@section('title','Student Proile')

@section('main-content')
    <!--Content Start-->

@include('admin.includes.alert')

<div class="container">
    <div class="row">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                {{-- <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">{{$students[0]->student_name}}'s Profile</h4>
                </div> --}}
            </div>

            <div class="row ml-0 mr-0">
                <div class="col-md-3">
                    <h4 class="text-center font-weight-bold pt-2">Profile of <br><span class="font-italic">{{$students[0]->student_name}}</span></h4>
                    @if (isset($students[0]->student_photo))
                        <img src="{{asset($students[0]->student_photo)}}" alt="Profile Picture" height="300" width="250px">
                    @else
                        <img src="{{asset('admin/assets/images/avatar.jpeg')}}" alt="Profile Picture">
                    @endif
                    
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <button data-toggle="modal" data-target="#studentBasicInfoUpdate" class="btn btn-block my-btn-submit">Edit Profile</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-9">
                    @include('admin.student.details.basic-info')
                </div>

            </div>

        </div>
    </div>
</div>
<!--Content End-->

<!--Modal Student Basic Info Update-->
    @include('admin.student.details.modals.basic-info-update')

@endsection