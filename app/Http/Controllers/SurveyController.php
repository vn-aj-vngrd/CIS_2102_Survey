<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Helpers\Generator;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::orderBy('surveyID', 'desc')->get();
        return response()->json($surveys);
    }

    public function create(Request $request)
    {
        $request->validate([
            'id'                    =>  ['required'],
            'name'                  =>  ['required'],
            'questions'             =>  ['required'],
        ]);

        $survey = new Survey;
        $survey->createdBy = $request->id;
        $survey->code = Generator::SurveyCodeGenerate(new Survey, 'surveyID', 5, 'SURVEY');
        $survey->name = $request->name;
        $survey->save();

        $data = Survey::orderBy('surveyID', 'desc')->first();

        foreach ($request->questions as $val) {
            $question = new Question;
            $question->text = $val['text'];
            $question->surveyID = $data->surveyID;
            $question->save();
        }

        return response()->json($survey);
    }

    public function update(Request $request)
    {
        foreach ($request->questions as $val) {
            $question = Question::findOrFail($val['questionID']);
            $question->text = $val['text'];
            $question->save();
        }

        return response()->json("Survey Successfuly Updated.");
    }

    public function delete($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();
        return response()->json("Survey Successfuly Deleted.");
    }

    public function getQuestions($id)
    {
        $questions = Question::where('surveyID', $id)->orderBy('questionID', 'asc')->get();
        return response()->json($questions);
    }
}
