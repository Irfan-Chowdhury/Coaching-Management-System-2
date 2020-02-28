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


@include('admin.settings.student-type.modal.add-form')
@include('admin.settings.student-type.modal.edit-form')


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
    //for Data Insert & then Read (show in table) 
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

    //for Unpublish
    function studentTypeUnpublished(id){
        $.get("{{route('student-type-unpublish')}}", {type_id:id}, function (data) {
            console.log(data); //this line only for testing purpose
            $('#studentTypeTable').empty().html(data); //প্রথমে studentTypeTable আইডিটাকে ধরে empty করে দিবে, দেন ঐটার ভিত্রে ডাটা পাস করাবে ।
        });
    }

    //for Publish
    function studentTypePublished(id){
        $.get("{{route('student-type-publish')}}", {type_id:id}, function (data) {
            // console.log(data); //this line only for testing purpose
            $('#studentTypeTable').empty().html(data); //প্রথমে studentTypeTable আইডিটাকে ধরে empty করে দিবে, দেন ঐটার ভিত্রে ডাটা পাস করাবে ।
        });
    }

    //for Edit (show)
    function studentTypeEdit(id,name){
        // alert(name); //just for checking
        $('#studentTypeEditModal').find('#studentType').val(name); //studentTypeEditModal- Modal id
        $('#studentTypeEditModal').find('#typeId').val(id);  //studentTypeEditModal- Modal id
        // $('#studentTypeEditModal').modal('show'); // another option- I call the modal in 'student-type-table.blade.php' file in 'Edit' option
    }

    //for Update data
    $('#studentTypeUpdate').submit(function (e) {  //studentTypeUpdate- Form id
        e.preventDefault();
        var url    = $(this).attr('action');        
        var data   = $(this).serialize();        
        var method = $(this).attr('method');   
        $('#studentTypeEditModal #reset').click();  //studentTypeEditModal- Modal id
        $('#studentTypeEditModal').modal('hide');   //studentTypeEditModal- Modal id
        
        $.ajax({
            type : method,
            url  : url,
            data : data,          
            success:function(data){
                $('#studentTypeTable').empty().html(data);  //studentTypeTable- Table id
            }
        }); 
    });

    //for Dalete Data
    function studentTypeDelete(id){
        // var check = confirm("Are you Sure to Delete ?");  //or,
        var msg = "Are you Sure to Delete ?";

        if (confirm(msg)) 
        {
            $.get("{{route('student-type-delete')}}", {type_id:id}, function (data) {
                $("#studentTypeTable").empty().html(data);
            }) 
        }
    }
</script>
<!--Content End-->
@endsection