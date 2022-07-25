@extends('layouts.app')

@section('content')
<section>
  
     <header>
         <a href="#" class="logo">Logo</a>
         <ul>
         <li><a href="{{ url('home') }}">Home</a></li>
             <li><a href="{{ url('viewquestions') }}">Questions</a></li>
             <li><a href="{{ url('viewtime')  }}" class="active">List of Appointments</a></li>
             <li><a href="{{ url('myfinishappointments') }}">Completed Appointments</a></li>
         </ul>
     </header>
     <form method="POST" action="viewtime" >
      @csrf
            <div class="examscard">          
                <div class="card-body"> 
                <table class="table table-striped">
<thead>
<tr>
<center>
<td>ID Number </td>
<td> Name </td>
<td>Date </td>
<td>Time </td>
<td>Action </td>
</center>
</tr>
</thead>
<tbody id="dynamic-row">

@foreach($timescheds as $t)
<tr>
<center>
<input type="hidden" class="btn_val_id" value="{{ $t->id }}">
<td><input type="text" name="user_idnum" value="{{ $t->user_idnum }}" ></td>
<td><input type="text" name="user_fname" value="{{ $t->user_fname }} "></td>
<td><input type="text" name="date" value="{{ $t->date }} "></td>
<td><input type="text" name="time" value="{{ $t->time }} "></td>
<td>
  @if ($t->status==1)
  <a href="{{url ('change-status/'.$t->id) }}" class="btn btn-success">Accepted</a>
  @else
  <a href="{{url ('change-status/'.$t->id) }}" class="btn btn-danger">Pending</a>
  @endif
</form>
  <button type="submit">Done</button>
    </td> 
</center>
</tr>
@endforeach

</tbody>
</table>
@endsection
