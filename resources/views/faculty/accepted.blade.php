@extends('faculty.lay')
@section('content')


<div class="row">   
                    <div class="col-sm-12 col-3">
                        <h4 class="page-title">Accepted Request</h4>
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
						
                            <table class="table table-striped custom-table" id="myTable">
                                <thead>
                                        
                                    <tr>
                                        <th>SNo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Student Code</th>
                                        <th>Product Name</th>
                                        <th>Asset Code</th>
                                        <th>Acquire Date</th>
                                        <th>Returned Date</th>
                                        
                                        <!-- <th>Status</th>
                                        <th class="text-right">Action</th> -->
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
                                     
                                        <td>{{date('d-m-Y', strtotime($item->acquire_date)) }}</td>
                                        <td>{{date('d-m-Y', strtotime($item->expire_date)) }}</td>
                                             
                                        <!-- <td>
                                        {{$item->status}}
                                  
                                           
                                        </td> -->
                                        <!-- <td class="text-right">
                                            <div style="display:flex">
                                            <form action="{{route('facSa',$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="acceptFac">
                                            <button type="submit">Accepted</button>
                                            </form>
                                            <form action="{{route('facSa',$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                            <button type="submit">Rejected</button>
                                            </form>
                                          
                                            </div>
                                          
                                        </td> -->
                                    </tr>
                                    @php $is++ @endphp
                                    @endforeach
                                           
                                </tbody>
                            </table>
						
                    </div>
                </div>
            


	<script>
		$(document).ready(function() {
		  var table = $('#myTable').DataTable( {
		    columns: [
                { title: "SNO", data: "SNO", visible: true },
               { title: "Name", data: "Name", visible: true },
               { title: "Email", data: "Email", visible: false },    
                { title: "Student Code", data: "Student Codeame", visible: true },
             
            
             
		      { title: "Product Name", data: "Product Name  ", visible: false },
		      { title: "Asset Code", data: "Asset Code", visible: false },
              { title: "Acquire Date", data: "Acquire Date", visible: true },
              { title: "Returned Date", data: "Returned Date", visible: true },
             
		      // add more columns as needed
		    ],
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














@endsection
