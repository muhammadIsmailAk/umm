@extends('supervisor.lay')
@section('content')





<div class="row">   
                    <div class="col-sm-12 col-3">
                        <h4 class="page-title">Pending Request</h4>
                    </div>
                    
                </div>
                <div class="row">
               @if(Session::has('success'))
                    <div  class="alert alert-success" style="margin-left:30rem">
                    <p>{{session('success')}}</p>    
                    
                    </div>
                    @endif
               </div>
                <div class="row">
                    <div class="col-md-12">
						<div class="table-responsive d-flex justify-content-center">
                            <table class="table table-striped custom-table" id="myTab">
                                <thead>
                                        
                                    <tr>
                                    <th>SNO</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Student Code</th>
                                        <th>Product Name</th>
                                        <th>Asset Code</th>
                                        <th>Acquire Date</th>
                                        <th>Returned Date</th>
                                        
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $is=0;@endphp
                                    @foreach($items as $item)
                               
                                    <tr>
                                    <td>{{$is+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->student_code}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->assetCode}}</td>
                                     
                                        <td>{{date('F-d-Y', strtotime($item->acquire_date)) }}</td>
                                        <td>{{date('F-d-Y', strtotime($item->expire_date)) }}</td>
                                             
                                        <td>
                                        {{$item->status}}
                                  
                                           
                                        </td>
                                        <td class="text-right">
                                            <div style="display:flex">
                                            <form action="{{route('supa',['id' =>$item->id,'pid' =>$item->product_id])}}" method="post">
                                            
                                            @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <input type="hidden" name="prd" value="acquire">
                                                <input type="hidden" name="da" value="{{$item->expire_date}}">
                                            <button type="submit">Accepted</button>
                                            </form>
                                            <form action="{{route('suprej',$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="rejectSuper">
                                            <button type="submit">Rejected</button>
                                            </form>
                                          
                                            </div>
                                          
                                        </td>
                                    </tr>
                                    @php $is++ @endphp
                                    @endforeach
                                           
                                </tbody>
                            </table>
						</div>
                    </div>
                </div>
                <script>
		$(document).ready(function() {
		  var table = $('#myTab').DataTable( {
		    columns: [
                { title: "SNO", data: "SNO", visible: true },
                { title: "Name", data: "Name", visible: true },
               { title: "Student Code", data: "Student Code", visible: true },
               { title: "Product Name", data: "Product Name", visible: false },    
                { title: "Asset Code", data: "Asset Code", visible: true },
                { title: "Acquire Date", data: "Acquire Date ", visible: true },
		      { title: "Returned Date", data: "Returned Date", visible: true },
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
    $(document).ready(function() {
        $('#my-button').click(function(e) {
            e.preventDefault(); // prevent default form submission behavior
            
            // get form data
            var formData = {
                // add your form data here
            };
            
            // send data to server using AJAX
            $.ajax({
                type: 'POST',
                url: '/your-url',
                data: formData,
                success: function(response) {
                    // handle success response
                },
                error: function(xhr, status, error) {
                    // handle error response
                }
            });
        });
    });
</script>






@endsection
