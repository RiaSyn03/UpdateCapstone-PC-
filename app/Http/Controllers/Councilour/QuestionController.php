<?php

namespace App\Http\Controllers\Councilour;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\Result;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all(); 
        $stressquestions = Question::where('question_type','stress')->get();
        $personalityquestions = Question::where('question_type','personality')->get(); 
        $learnersquestions = Question::where('question_type','learners')->get(); 
        
        return view('admin.users.councilour.questions.viewquestions', compact('questions','stressquestions','personalityquestions','learnersquestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'question_num' => 'required',
            'question' => 'required',
            'question_type' => 'required',
          ]);

        $question = new Question;
        $question->question_num = $request->input('question_num');
        $question->question = $request->input('question');
        $question->question_type = $request->input('question_type');
        $question->save();
        

        return redirect()->route('viewquestions')->with('success','Question Added');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $this->validate($request,[
            'result_name' => 'required',
          ]);

        $result = new Result;
        $result->user_id = $request->user()->id;
        $result->result_name = $request->input('result_name');
        $result->save();

        // return view('admin.users.student.exam_result');
        return redirect()->route('stress_exam')->with('success','Exam Added');
    }

    public function pstore(Request $request)
    {       
        $this->validate($request,[
            'result_name' => 'required',
          ]);

        $result = new Result;
        $result->user_id = $request->user()->id;
        $result->result_name = $request->input('result_name');
        $result->save();

        // return view('admin.users.student.exam_result');
        return redirect()->route('personality_exam');
    }

    public function lstore(Request $request)
    {       
        $this->validate($request,[
            'result_name' => 'required',
          ]);

        $result = new Result;
        $result->user_id = $request->user()->id;
        $result->result_name = $request->input('result_name');
        $result->save();

        // return view('admin.users.student.exam_result');
        return redirect()->route('learner_exam');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question_delete = Question::findorFail($id);
        $question_delete->delete();
        return response()->json(['status' => 'Delete Successful !']);
    }
    
    public function personality(Request $request)
    {
        $questioncount = Question::where('question_type','personality')->get()->count(); 
        $personality = Question::where('question_type','personality')->get();
        return view('admin.users.student.personality_exam', compact('personality', 'questioncount'));

        
    }
    public function learner(Request $request)
    {
        $questioncount = Question::where('question_type','learners')->get()->count(); 
        $learner = Question::where('question_type','learners')->get();
        return view('admin.users.student.learner_exam', compact('learner', 'questioncount'));
     
    }

    public function stress(Request $request)
    {
        $questioncount = Question::where('question_type','stress')->get()->count(); 
        $stress = Question::where('question_type','stress')->get();       
        return view('admin.users.student.stress_exam', compact('stress', 'questioncount'));

    }
    public function showexam()
    {
        $id = auth()->user()->id;
        $myexams = Result::where('user_id',$id)->get();
        
        return view('admin.users.student.exams_history', compact('myexams'));
    }
    public function result(Request $request)
    {
       
        $stress = Result::all();       
        return view('admin.users.student.exam_result', compact('stress'));

    }
}


