@extends('student.lay')

@section('content')




<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
                            <table class="table table-striped custom-table" id="myTable">
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
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $is=0;@endphp
                                    @foreach($pedd as $item)
                               
                                    <tr>
                                      <td>{{$is+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->student_code}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->assetCode}}</td>
                                     
                                        <td>{{date('d-m-Y', strtotime($item->acquire_date)) }}</td>
                                        <td>{{date('d-m-Y', strtotime($item->expire_date)) }}</td>
                                             
                                        <td>
                                        {{$item->status}}
                                  
                                           
                                        </td>
                                        
                                    </tr>
                                    @php $is++ @endphp
                                    @endforeach
                                           
                                </tbody>
                            </table>
						</div>
                    </div>
                </div>
                <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>
<script>
    document.getElementById("df").addEventListener("submit", function(event) {
  // Prevent the page from reloading
  event.preventDefault();

  // Other form submission logic goes here
});
</script>









@endsection