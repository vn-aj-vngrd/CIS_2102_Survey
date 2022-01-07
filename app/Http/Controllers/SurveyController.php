<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Helpers\Generator;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::orderBy('surveyID', 'desc')->get();
        return response()->json($surveys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function delete($id)
    {
        $survey = Survey::find($id);
        $survey->delete();
        return response()->json("Record Successfuly Deleted.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
