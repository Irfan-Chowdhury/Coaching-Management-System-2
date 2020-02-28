@extends('admin.master')

@section('title','Student Type List')

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

            <!-- Content Title Start-->
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Student Type List
                    <!--Modal Button-->
                    <button type="button" class="ml-5 btn btn-primary text-light" data-toggle="modal" data-target="#studentTypeAddModal">
                        Add New <b>+</b>
                    </button> 
                    </h4>
                </div>
            </div>
            <!-- Content Title End-->


            <!-- Modal Start-->
            <div class="modal fade" id="studentTypeAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                       
                        <!-- Modal Title & Button Start-->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Student Type Add</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Modal Title & Button End-->

                        <!-- Form Start -->
                        <form action="{{route('student-type-add')}}" method="POST" id="studentTypeInsert">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="schoolName" class="col-form-label col-sm-3 text-right">Class Name</label>
                                    <div class="col-sm-9">
                                        <select name="class_id" class="form-control @error('class_id') is-invalid @enderror" id="classId" required>
                                            <option value="">--Select Class--</option>
                                            @foreach ($classes as $class)
                                                <option value="{{$class->id}}">{{$class->class_name}}</option>    
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                
                                <div class="form-group row">
                                    <label for="studentType" class="col-form-label col-sm-3 text-right">Student Type</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('student_type') is-invalid @enderror" name="student_type" value="{{ old('student_type') }}" id="studentType" placeholder="Write Student Type here" required>
                                        @error('student_type')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-warning" id="reset">Reset</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <!-- Form End -->

                    </div>
                </div>
            </div>
            <!-- Modal End-->


            <!-- Table Start-->
            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Class Name</th>
                        <th>Student Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="studentTypeTable">
                        @include('admin.settings.student-type.student-type-table')
                    </tbody>
                </table>
            </div>
            <!-- Table End-->

        </div>
    </div>
</section>
<!-- Content End-->



<script>
    $('#studentTypeInsert').submit(function (element) {
        element.preventDefault();
        var url    = $(this).attr('action');        
        var data   = $(this).serialize();        
        var method = $(this).attr('method');   
        $('#studentTypeAddModal #reset').click();
        $('#studentTypeAddModal').modal('hide');
        
        $.ajax({
            type : method,
            url  : url,
            data : data,          
            success:function(){
                $.get("{{route('student-type-list')}}",function (data) {
                    $('#studentTypeTable').empty().html(data); //প্রথমে studentTypeTable আইডিটাকে ধরে empty করে দিবে, দেন ঐটার ভিত্রে ডাটা পাস করাবে ।
                });
            }
        });     
    });

</script>
<!--Content End-->
@endsection