@extends('supervisor.lay')
@section('content')

<div class="row">   
                    <div class="col-sm-4 col-3">
                    @if(Session::has('success'))
<div  class="alert alert-success" style="width=100%">
<p>{{session('success')}}</p>    

</div>

@endif
                        <h4 class="page-title">Received Items</h4>
                    </div>
                    <!-- <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{route('add')}}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add  Product</a>
                    </div> -->
                </div>
               
                <div class="row">
                    <div class="col-md-12">
						<div class="table-responsive">
                            <table class="table table-striped custom-table" id="myTab" style="background-color: white;">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>User_id</th>
                                        <th>Product_id</th>
                                        <th>level</th>
                                        <th>Acquire_date</th>
                                        <th>Expire_date</th>
                                        <th>Email</th>
                                       
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $is=0;@endphp
                                @foreach($item as $items)
                               

                                    <tr>
                                    <td>{{$is+1}}</td>
                               
										
									
                                        <td>{{$items->user_id}}</td>
                                        <td>{{$items->product_id}}</td>
                                        <td>{{$items->email}}</td>
                                        <td>{{$items->level}}</td>
                                        <td>{{$items->acquire_date}}</td>
                                        <td>{{$items->expire_date}}</td>
                                       
                                        
                                       
                                            
                                        
                                        <td class="text-right">
                                            <button data-toggle="modal" data-target="#exampleModal" onclick="myfunction({{$items->id}})">Add  Received Status</button>
                                        </td>
                                    </tr>
                                    @php $is++ @endphp
                                    @endforeach
                                   
                                    
                                </tbody>
                            </table>
						</div>
                    </div>
                </div>
                



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="color: black;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Received Products Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('statusrec')}}" method="Post">
        @csrf

        
        
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder=" " value="{{Auth::user()->email}}" readonly>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>  
  <div class="form-group">
    <select name="sta" id="" required class="form-control">
    <option value="" default>---Select Received Status---</option>
    <option value="Received">Received</option>    
    <option value="Under Repair">Under Repair</option>
    <option value="Damaged">Damaged</option>
    <option value="Under Maintance">Under Maintance</option>
  
    </select>
    </div>
   
  
  
    <input type="hidden" class="form-control" id="" name="userid" value=" {{Auth::user()->id}}">
     
 
    <input type="hidden" class="form-control" id="prd" name="prdid"  value="">
    <div class="form-group">
    <label for="exampleInputEmail1">Comments</label>
    <span class="text-danger">*</span>
    <br>
    <!-- <input type="text" class="form-control" id="" name="comment" required style="height:100px">  -->
    <textarea name="comment" id="" cols="25" rows="4" class="form-control" required></textarea>
   
  </div>  
    
  <div class="form-group">
    <label for="exampleInputEmail1">Penalty</label>
    <span class="text-danger">if any applicable</span>
    <input type="text" class="form-control" id="" name="pen">
   
  </div>   
 
  
  <button type="submit" class="btn btn-primary" > Submit</button>

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








	<script>
		$(document).ready(function() {
		  var table = $('#myTab').DataTable( {
		    columns: [
                { title: "SNO", data: "SNO", visible: true },
                { title: "Title", data: "Title", visible: true },
               { title: "Asset Code", data: "Asset Code", visible: true },
               { title: "Faculty Incharge", data: "Faculty Incharge", visible: false },    
                { title: "Admin Supervisor", data: "Admin Supervisor", visible: true },
                { title: "Image", data: "Image ", visible: true },
		      { title: "Status", data: "Status", visible: true },
              { title: "Action", data: "Action", visible: true },
            ],
            
             
		   
              
		      // add more columns as needed
		    
		    dom: 'Bfrtip',
		    buttons: [

            
		      {
		        extend: 'copyHtml5',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },
		      {
		        extend: 'pdfHtml5',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },
		      {
		        extend: 'print',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },

              {
		        extend: 'csv',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },
              {
		        extend: 'excel',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },


		      {
		        extend: 'colvis',
		        text: 'Column visibility'
		      }
		    ]
		  } );
		  
		  table.column(1).visible(false); // hide the "Age" column

		  $('#toggleAgeColumn').on('click', function() {
		    var column = table.column(1);
		    column.visible(!column.visible());
		  });
		} );
	</script>
    <script>
   function myfunction(id){
    var c=id;
    //  document.write(c);
    var d=document.getElementById("prd").value=c;
    
    // console.log(c) ;
   }
   
  </script>


                    
@endsection