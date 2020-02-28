<!-- Modal Start-->
<div class="modal fade" id="studentTypeEditModal" tabindex="-1" role="dialog" aria-labelledby="studentTypeEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <!-- Modal Title & Button Start-->
            <div class="modal-header">
                <h5 class="modal-title" id="studentTypeEditModalTitle">Student Type Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Title & Button End-->

            <!-- Form Start -->
            <form action="{{route('student-type-update')}}" method="POST" id="studentTypeUpdate">
                @csrf
                <div class="modal-body">
                    {{-- <div class="form-group row">
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
                    </div> --}}
    
                    <div class="form-group row">
                        <label for="studentType" class="col-form-label col-sm-3 text-right">Student Type</label>
                        <div class="col-sm-9">
                            <input type="text" name="student_type" id="studentType" class="form-control @error('student_type') is-invalid @enderror" required>
                            @error('student_type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="type_id" id="typeId">

                </div>
                <div class="modal-footer">
                    <button type="reset" class="d-none" id="reset">Reset</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <!-- Form End -->

        </div>
    </div>
</div>
<!-- Modal End-->