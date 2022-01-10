<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Response;
use App\Models\Response_set;
use Illuminate\Http\Request;
use App\Helpers\Generator;
use Illuminate\Support\Facades\DB;

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

        $data = Survey::select('surveyID')->orderBy('surveyID', 'desc')->first();

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
        $survey = Survey::findOrFail($request->id);
        $survey->name = $request->name;
        $survey->touch();
        $survey->save();

        foreach ($request->questions as $val) {
            $question = Question::findOrFail($val['questionID']);
            $question->text = $val['text'];
            $question->save();
        }

        return response()->json("Survey Successfully Updated.");
    }

    public function delete($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();
        return response()->json("Survey Successfully Deleted.");
    }

    public function getQuestions($id)
    {
        $questions = Question::where('surveyID', $id)->orderBy('questionID', 'asc')->get();
        return response()->json($questions);
    }

    public function getSurveyInfo($id)
    {
        $survey = Survey::where('surveyID', $id)->get();
        return response()->json($survey);
    }

    public function getData($id)
    {
        $data = DB::table('responses')
            ->select('responses.rating', 'responses.responseID', 'responses.questionID')
            ->join('response_sets', 'responses.responseSetID', '=', 'response_sets.responseSetID')
            ->where('response_sets.surveyID', '=', $id)
            ->groupBy('responses.rating', 'responses.responseID', 'responses.questionID')
            ->orderBy('responses.responseID')
            ->get();

        $questionCount = Question::where('surveyID', $id)->count();
        $customerCount = Response_set::where('surveyID', $id)->count();

        $ret = array(
            "data" => $data,
            "questionCount" => $questionCount,
            "customerCount" => $customerCount,
        );
        return response()->json($ret);
    }
}
