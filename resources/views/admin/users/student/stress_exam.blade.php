@extends('layouts.app')
@section('content')
<link href="{{ asset('css/questions.css') }}" rel="stylesheet">
<section>
     <header>
         <a href="#" class="logo">Logo</a>
         <ul>
             <li><a href="{{ url('stress_exam') }}" class="active">Stress Scale</a></li>
             <li><a href="{{ url('personality_exam') }}" >Personality</a></li>
             <li><a href="{{ url('learner_exam') }}">Learner</a></li>
             <li><a href="{{ url('home') }}">Go to Homepage</a></li>
         </ul>
     </header>
     <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<form method="POST" action="stress_exam" name="stressquestion" id="stressquestion">
@csrf
@foreach ($stress as $question)
<div class="wrapper" >
  <div class="title">{{ $question->question_num }}. {{ $question->question}}</div>
  <div class="box">
      <input type="radio" name="select{{ $question->question_num }}" id="radio1{{ $question->question_num }}" value="0">
      <label for="radio1{{ $question->question_num }}">
        Not at all
      </label>
      <input type="radio" name="select{{ $question->question_num }}" id="radio2{{ $question->question_num }}" value="1" >
      <label for="radio2{{ $question->question_num }}">
        Several days
      </label>
      <input type="radio" name="select{{ $question->question_num }}" id="radio3{{ $question->question_num }}" value="2" >
      <label for="radio3{{ $question->question_num }}">
        More than half the days
      </label>
      <input type="radio" name="select{{ $question->question_num }}" id="radio4{{ $question->question_num }}" value="3">
      <label for="radio4{{ $question->question_num }}">
        Nearly everyday
      </label>
    </div>
    
    </div>
    <div class="container-top">
    <a href="#" class="top"></a>
  </div>
    
    
    <br><br><br>
    
@endforeach
<!-- <p>Total: £ <span id="total">0</span></p> -->
<input type="hidden" id="result_name" name="result_name" value=""/> 
<br><br><br>    <br><br><br>
<center>
<h3>Depression Severity: 0-4 none, 5-9 mild, 10-14 moderate, 15-19 moderately severe, 20-27 severe.</h3>
<br><br>
<button class="resultbutton" type="button" onclick="calculate()">Get Result</button>

</center>

<!-- 
<p>The Result is : <br>
	<span id = "result"></span>
</p> -->
<div id="not-stressmodal">
            <div class="not-stresscard" id="not-stresscard">
                <div class="not-stress-face"></div>
                <div class="back-face">
                <br><br><br>
                    <button type="submit">Submit</button>
                    <br><br><br>
                    <a href="#" onclick="calculate()">close</a>
                   
                </div>
            </div>
        </div>
<div id="stressmodal">
            <div class="stresscard" id="stresscard">
                <div class="stress-face"></div>
                <div class="back-face">
                    <br><br><br>
                    <button type="submit">Submit</button>
                    <br><br><br>
                    <a href="#" onclick="calculate()">close</a>
                   
                </div>
            </div>
        </div>
        <div id="super-stressmodal">
            <div class="super-stresscard" id="super-stresscard">
                <div class="super-stress-face"></div>
                <div class="back-face">
                    <br><br><br>
                    <button type="submit">Submit</button>
                    <br><br><br>
                    <a href="#" onclick="calculate()">close</a>
                    
                </div>
            </div>
        </div>
        </form>
  <input type="hidden" value="{{$questioncount}}" id="noquestions" name="noquestions"/><br>
</section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  

  <script>
  function calculate(){
$(":radio")

    var total = 0;
    let noquestions = document.getElementById('noquestions').value;
    var maxscore = 3*noquestions;
    
    
    $(":radio:checked").each(function(){
        total += Number(this.value);
    });
    $("#total").text(total);
    
    
    var notstress = maxscore*0.25;
    var stress = maxscore*0.50;
    var superstress = maxscore*0.75;
    // $("#result").text(notstress);
    
    if(total <= notstress )
    {
      // var blur = document.getElementById('blur');
      // blur.classList.toggle('active');
      var notstressmodal = document.getElementById('not-stressmodal');
      notstressmodal.classList.toggle('active');
      $("#result_name").val("You are not stress");
      
       
        }

    else if (total <= superstress)
    {
      // var blur = document.getElementById('blur');
      // blur.classList.toggle('active');
      var stressmodal = document.getElementById('stressmodal');
      stressmodal.classList.toggle('active');
      $("#result_name").val("You are stress");
    }
    else if (total > superstress)
    {
      // var blur = document.getElementById('blur');
      // blur.classList.toggle('active');
      var superstressmodal = document.getElementById('super-stressmodal');
      superstressmodal.classList.toggle('active');
   
      $("#result_name").val("You are so stress");
    }

};

  </script>
  <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>


  
@endsection
