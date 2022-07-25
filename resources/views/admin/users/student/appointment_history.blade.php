@extends('layouts.app')

@section('content')
<section>
     <header>
         <a href="#" class="logo">Logo</a>
         <ul>
             <li><a href="{{ url('home') }}">Home</a></li>
             <li><a href="{{ url('exams_history') }}">Exam History</a></li>
             <li><a href="{{ url('stdntappointment') }}">Appointment</a></li>
             <li><a href="{{ url('appointment_history') }}"class="active">My Appointments</a></li>
         </ul>
     </header>
            <div class="examscard">          
                <div class="card-body"> 
                <table class="table table-striped">
   <thead>
   <div class="panel-body">
   <tr>
   <th colspan="5"><center><h2>Ongoing Appointments</h2></center></th>
</tr>
   <tr>  
<td>Date </td>
<td>Time </td>
<td>Status </td>
<td>Action </td>

</tr>
  </thead>
  <tbody id="dynamic-row">
  @foreach($mylist as $history)
<tr>
<form method="post" action="appointment_history">
  @csrf
    <input type="hidden" class="btn_val_id" value="{{ $history->id }}">
<td><p>{{ $history->date }}</p></td>
<td><p>{{ $history->time }}</p></td>
<td>
  @if ($history->status==1)
  <p name="status">Accepted</p>
  @else
  <p name="status">Pending</p>
  @endif
</td>
<td>
  <a href="" class="float-left">
</form>
  <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
    </td> 
</tr>
  @endforeach
  <thead>
   <div class="panel-body">
   <tr>
   <th colspan="5"><center><h2>Finish Appointments</h2></center></th>
</tr>
<tr>
<td>Date </td>
<td>Time </td>
<td>Action </td>
<td> </td>
</tr>
</thead>
@foreach($donelist as $d)
<tr>
<input type="hidden" class="btn_val_id" value="{{ $history->id }}">
<td><p>{{ $d->date }} </p></td>
<td><p>{{ $d->time }} </p></td>

<td>
  <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
    </td> 
    <td> </td>
</tr>
@endforeach
</tbody>
</table>
  </div>
  </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $('.btn-sm').click(function (e){
    e.preventDefault();
var delete_id = $(this).closest("tr").find('.btn_val_id').val();
    const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    var data = {
      "_token": $('input[name=_token]').val(),
      "id": delete_id,
    };
    $.ajax({
      type: "DELETE",
      url: '/appointment-delete/'+delete_id,
      data: data,
      success: function (response) {
        swalWithBootstrapButtons.fire(
          response.status,
    )
    .then((result) => {
      location.reload();
    });
      }
    });
    
    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
   });
});
</script>
@endsection