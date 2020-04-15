<!-- Modal Start-->
<div class="modal fade" id="studentBasicInfoUpdate" tabindex="-1" role="dialog" aria-labelledby="studentBasicInfoUpdate" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <!-- Modal Title & Button Start-->
            <div class="modal-header">
                <h5 class="modal-title" id="studentBasicInfoUpdate">Student Basic Info Update Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Title & Button End-->

            <!-- Form Start -->

            <form action="{{route('student-basic-info-update')}}" method="post" id="studentTypeInsert" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="studentName" class="col-form-label col-sm-3 text-right">Student Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="student_name" class="form-control" value="{{$students[0]->student_name}}" id="studentName" required>
                            @error('student_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="schoolId" class="col-form-label col-sm-3 text-right">School Name</label>
                        <div class="col-sm-9">
                            <select name="school_id" class="form-control @error('school_id') is-invalid @enderror" id="school" required>
                                <option value="">--Select School--</option>
                                @foreach ($schools as $school)
                                    <option value="{{$school->id}}" {{$students[0]->school_id == $school->id ? 'selected':''}} >{{$school->school_name}}</option>    
                                @endforeach
                            </select>
                            @error('school_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
    
                    <!--Father-->
                    <div class="form-group row">
                        <label for="fatherName" class="col-form-label col-sm-3 text-right">Father's Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="father_name" class="form-control" placeholder="Father's Name" value="{{$students[0]->father_name}}" id="fatherName" required>
                            @error('father_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fatherMobile" class="col-form-label col-sm-3 text-right">Father's Mobile No.</label>
                        <div class="col-sm-9">
                            <input type="text" name="father_mobile" class="form-control" id="fatherMobile" placeholder="8801XXXXXXXXX" value="{{$students[0]->father_mobile}}" minlength="13" maxlength="13" required>
                            @error('father_mobile')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fatherProfession" class="col-form-label col-sm-3 text-right">Father's Profession</label>
                        <div class="col-sm-9">
                            <input type="text" name="father_profession" class="form-control" id="fatherProfession" placeholder="Father's Profession" value="{{$students[0]->father_profession}}" required>
                            @error('father_profession')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Mother -->
                    <div class="form-group row">
                        <label for="motherName" class="col-form-label col-sm-3 text-right">Mother's Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="mother_name" class="form-control " placeholder="Mother's Name" value="{{$students[0]->mother_name}}" id="motherName" required>
                            @error('mother_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="motherMobile" class="col-form-label col-sm-3 text-right">Mother's Mobile No.</label>
                        <div class="col-sm-9">
                            <input type="text" name="mother_mobile" class="form-control" id="motherMobile" placeholder="8801XXXXXXXXX" value="{{$students[0]->mother_mobile}}" minlength="13" maxlength="13" required>
                            @error('mother_mobile')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="motherProfession" class="col-form-label col-sm-3 text-right">Mother's Profession</label>
                        <div class="col-sm-9">
                            <input type="text" name="mother_profession" class="form-control" id="motherProfession" placeholder="Mother's Profession" value="{{$students[0]->mother_profession}}" required>
                            @error('mother_profession')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="emailAddress" class="col-form-label col-sm-3 text-right">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" name="email_address" class="form-control" id="emailAddress" placeholder="example@example.com" value="{{$students[0]->email_address}}">
                            @error('email_address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="smsMobile" class="col-form-label col-sm-3 text-right">SMS Mobile No</label>
                        <div class="col-sm-9">
                            <input type="text" name="sms_mobile" class="form-control" id="smsMobile" placeholder="8801XXXXXXXXX" value="{{$students[0]->sms_mobile}}" minlength="13" maxlength="13" required>
                            @error('sms_mobile')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-form-label col-sm-3 text-right"></label>
                        <div class="col-sm-9">
                            <img class="img-thumbnail" src="@if(isset($students[0]->student_photo)) {{asset($students[0]->student_photo)}} @else {{asset("admin/assets/images/avatar.png")}} @endif" id="studentPhoto" hight="100px" width="100px">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="photo" class="col-form-label col-sm-3 text-right">Student Photo</label>
                        <div class="col-sm-9">
                            <input type="file" name="student_photo" class="form-control" id="photo" onchange="showImage(this,'studentPhoto')">
                            @error('student_photo')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="address" class="col-form-label col-sm-3 text-right">Address</label>
                        <div class="col-sm-9">
                            <input type="text" name="address" class="form-control" id="address" placeholder="Detail Address" value="{{$students[0]->address}}" required/>
                            @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="student_id" value="{{$students[0]->id}}"> <!--In Video-->

                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning" id="reset">Reset</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
            <!-- Form End -->

        </div>
    </div>
</div>
<!-- Modal End-->