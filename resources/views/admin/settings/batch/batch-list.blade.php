@extends('admin.master')

@section('title','Class & Student-Type Wise Batch List')

@section('main-content')
<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-md-12 ">
            
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Class & Student-Type Wise Batch List</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group row mb-0">
                                        <label for="schoolName" class="col-form-label col-sm-3 text-right">Class Name</label>
                                        <div class="col-sm-9">
                                            <select name="class_id" id="classId" class="form-control @error('class_id') is-invalid @enderror" >
                                                <option value="">--Select Class--</option>
                                            @foreach ($classes as $class)
                                                <option value="{{$class->id}}">{{$class->class_name}}</option>    
                                            @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group row mb-0">
                                        <label for="studentTypeId" class="col-form-label col-sm-3 text-right">Student Type</label>
                                        <div class="col-sm-9">
                                            <select name="student_type_id" id="studentTypeId" class="form-control @error('class_id') is-invalid @enderror">
                                                <option value="">-- Select Student Type --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="table-responsive">
                <table id="batchList" class="table table-bordered table-hover text-center"></table>
            </div>
        </div>
    </div>
</section>
<!--Content End-->

<style>#overlay .loader{display: none}</style>
@include('admin.includes.loader')


<script>
    //for select List 'Class Name'
   $('#classId').change(function(){
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
        }else{
            $('#studentTypeId').empty().html('<option>--Select Student Type--</option>');
        }
    });
    //for showing Batch List after clicking 'Student Type'
   $('#studentTypeId').change(function() {
        var classId       = $('#classId').val();
        var studentTypeId = $(this).val();

        if (classId && studentTypeId) 
        {
            $('#overlay .loader').show();
            $.get("{{route('batch-list-by-ajax')}}", {class_id:classId, student_type_id:studentTypeId}, function(data) 
            {
                $('#overlay .loader').hide();
                // console.log(data);
                $("#batchList").html(data);
            })
        }
        else{
            $("#batchList").empty();
        }
    })
</script>
@endsection
