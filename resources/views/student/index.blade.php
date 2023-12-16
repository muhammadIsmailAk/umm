@extends('student.lay')
@section('content')


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Indus Valley School of Art and Architecture (IVS) </title>
  </head>
  <style>
    .btn
    {
        background-color: silver!important;

    }
  </style>
 
  <body>


  


<div class="container my-3 my-sm-5">
<div class="row">
               @if(Session::has('success'))
                    <div  class="alert alert-success" style="margin-left:30rem">
                    <p>{{session('success')}}</p>    
                    
                    </div>
                    @endif
               </div>

      <h1 class="mb-sm-4 text-center">Products For Acquisition </h1>
      <p class="lead text-center " style="color:red; visibility: hidden;" >
        These products are only availabe for students and faculty of Indus Valley School of Art and Architecture (IVS) 

      </p>
      
      <div class="row">

      <div class="col-md-12">
						<div class="table-responsive">
                            <table class="table table-striped custom-table" id="myTable" >
                                <thead>
                                        
                                    <tr>
                                        <th>SNO</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Availability</th>
                                        
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $is=0;@endphp
                                    @foreach($items as $item)                                   
                                    <tr>
                                      <td>{{$is+1}}</td>
                                        <!-- <td style="width: 25%; height: 46px;">
                                        <img src="{{asset($item->image)}}" class="figure-img img-fluid img-thumbnail" alt="Figure image" style="object-fit: cover;"/>
                                        </td> -->
                                        <td>{{($item->title)}}</td>
                                        <td>@if($item->status =="active")
                                      <button data-toggle="modal" data-target="#exampleModal"  onclick="myfunction({{$item->id}})" class="btn primary" >Add To Acquire</button>
                                    @else
                                    <button class="btn primary" style="visibility:hidden">Not Available</button>  
                                    </p>
                                    @endif</td>
                                    @if($item->last_used_at==null)
                                    <td>Product is Available for acquire</td>
                                    @else
                                    <td>{{date('F-d-Y', strtotime($item->last_used_at))}}</td>
                                  @endif
                                        
                                    </tr>
                                    @php $is++ @endphp
                                    @endforeach
                                           
                                </tbody>
                            </table>
						    </div>
                    </div>
                </div>
               







      <!-- @foreach($items as $item)
        <div class="col-12 col-md-6 col-lg-4">
          <figure class="figure" style="width:350px;height:390px ">
            <a href=""
              ><img
                src="{{asset($item->image)}}" 
                class="figure-img img-fluid img-thumbnail"
                alt="Figure image" style="height:264px;width: 100%;"
            /></a>
            <figcaption class="figure-caption text-center">
              <h6>Figure caption<small>(12-12-2017)</small></h6>
              <p>
                <input type="hidden" id="itemid" value="{{$item->id}}" >
                @if($item->status =="active")
              <button data-toggle="modal" data-target="#exampleModal"  onclick="myfunction({{$item->id}})" class="btn primary" >Add To Acquire</button>
            @else
            <button class="btn primary">Product is Aquired By Some other Member</button>  
            </p>
            @endif
            </figcaption>
          </figure>
         
        </div>
        
        @endforeach -->



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acquire Products Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('aqu')}}" method="Post">
        @csrf
            
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder=" " value="{{Auth::user()->email}}" readonly>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>   
  
  
    <input type="hidden" class="form-control" id="" name="userid" value=" {{Auth::user()->id}}">
     
 
    <input type="hidden" class="form-control" id="prd" name="prdid"  value="">
    <div class="form-group">
    <label for="exampleInputEmail1">Acquired Date</label>
    <span class="text-danger">*</span>
    <input type="date" class="form-control" id="" name="acqdate" required>
   
  </div>  
    
  <div class="form-group">
    <label for="exampleInputEmail1">Returned Date</label>
    <span class="text-danger">*</span>
    <input type="date" class="form-control" id="" name="datee" required>
   
  </div>   
  <div class="form-group">
    <select name="level" id="" required class="form-control">
    <option value="" name="level" default>---Select level---</option>
        <option value="Student">Student</option>
        <option value="Faculty">Faculty</option>
    </select>
  </div>
  
  
  <button type="submit" class="btn btn-primary">Submit</button>

        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
</div>
       
             
    </div>







    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
              <script>
              let table = new DataTable('#myTable');
              </script>
            


  <script>
   function myfunction(id){
    var c=id;
    //  document.write(c);
    var d=document.getElementById("prd").value=c;
    
    // console.log(c) ;
   }
   
  </script>
</html>

@endsection