@extends('admin.lay')
@section('content')
<style>
   .page-wrapper {
  left: 0;
  /* margin-left: 230px; */
  padding-top: 50px;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  transition: all 0.4s ease;
  color: wheat;
  color: white;
  font-size: large;
  margin: auto;
  border-radius:3px;
}
</style>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                @if(Session::has('success'))
<div  class="alert alert-success" style="margin-left:30rem">
<p>{{session('success')}}</p>    

</div>

@endif
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title" style="color:white;font-size:x-large">Add Student</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{route('addstu')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name </label>
                                        <input class="form-control" type="text" name="name" id="">
                                        <span class="text-danger">
                                            @error('depart')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Student Code <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="stdcode" id="" required>
                                        <span class="text-danger">
                                            @error('stdcode')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" id="" required>
                                        <span class="text-danger">
                                            @error('email')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="depart" id="" required>
                                        <span class="text-danger">
                                            @error('name')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="visibility: hidden;">
                                    <!-- <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="" id="">
                                    </div> -->
                                </div>
                                
                                <div class="col-sm-6" style="visibility: hidden;">
                                    <div class="form-group">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio"  value="active" checked  name="status" id="" value="active" >
									<label class="form-check-label" for="doctor_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio"  value="inactive" name="status" value="inactive" id="">
									<label class="form-check-label" for="doctor_inactive">
									Inactive
									</label>
								</div>
                            </div>
                                
                                 <!-- <div class="col-sm-6">
									<div class="form-group">
										<label>Upload Item Image</label>
										<div class="profile-upload">
											 <div class="upload-img">
												<img alt="" src="" >
											</div> -->
											<!-- <div class="upload-input">
												<input type="file" class="form-control" accept=".png, .jpg, .jpeg">
											</div>
										</div>
									</div>
                                </div>
                            </div> --> 
							<div class="row">
                                <div class="col-sm-12">
                                        
                                <div class="m-t-20 text-center col-sm-12">
                                <button class="btn btn-primary submit-btn">Create Student</button>
                            </div>
                                </div>
                            
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
		
@endsection