@extends('admin.master')

@section('title','Edit Batch Form')

@section('main-content')
    <!--Content Start-->
    <section class="container-fluid">
        <div class="row content">
            <div class="col-md-8 offset-md-2 pl-0 pr-0">

                @if(Session::get('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Message : </strong> {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Edit Batch Form</h4>
                    </div>
                </div>

                <form action="{{ route('batch-update',$batch->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="table-responsive p-1">
                        <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="schoolName" class="col-form-label col-sm-3 text-right">Class Name</label>
                                        <div class="col-sm-9">
                                            <select name="class_id" id="classId" class="form-control @error('class_id') is-invalid @enderror" required>
                                                <option value="">--Select Class--</option>

                                            @foreach ($classes as $class)
                                                <option value="{{$class->id}}" {{ $batch->class_id == $class->id ?'selected':''}}>{{ $class->class_name}}</option>    
                                            @endforeach
                                                @error('class_id')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="schoolName" class="col-form-label col-sm-3 text-right">Student Type</label>
                                        <div class="col-sm-9">
                                            <select name="student_type_id" id="studentTypeId" class="form-control @error('class_id') is-invalid @enderror" required>
                                                <option value="{{$batch_student_type_id_and_type->student_type_id}}">{{$batch_student_type_id_and_type->student_type}}</option>                                           
                                                @error('student_type_id')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="schoolName" class="col-form-label col-sm-3 text-right">Batch Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('batch_name') is-invalid @enderror" name="batch_name" value="{{ $batch->batch_name }}" id="batchName" required>
                                            @error('batch_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>
                           
                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="studentCapacity" class="col-form-label col-sm-3 text-right">Student Capacity</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control @error('student_capacity') is-invalid @enderror" name="student_capacity" value="{{ $batch->student_capacity }}" id="studenCapacity" placeholder="Input Student Capacity" required>
                                            @error('student_capacity')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <tr><td><button type="submit" class="btn btn-block my-btn-submit">Update</button></td></tr>

                        </table>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--Content End-->

    <style>#overlay .loader{display: none}</style>
    @include('admin.includes.loader')

    <script>
        $('#classId').change(function() 
        {   
            var classId = $(this).val();

            if (classId) 
            {
                $('#overlay .loader').show();

                $.get("{{route('class-wise-student-type')}}",{class_id:classId}, function (data) 
                {
                    $('#overlay .loader').hide(); //when the view return then loader will be off
                    console.log(data);
                    $('#studentTypeId').empty().html(data);
                });
            }
            else{
                $('#studentTypeId').empty().html('<option>--Select Student Type--</option>');
            }
        })
    </script>
@endsection
