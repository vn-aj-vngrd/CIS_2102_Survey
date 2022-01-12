<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Response_set;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{
    public function registerRespondent(Request $request)
    {
        $request->validate([
            'surveyCode'    => ['required'],
            'email'         => ['required', 'email'],
            'device_name'   => 'required',
        ]);

        $validCode = Survey::where('code', $request->surveyCode)->count();
        if ($validCode == 0) {
            throw ValidationException::withMessages([
                'surveyCode' => ['The provided survey code is invalid.'],
            ]);
        } else {
            $ValidEmail = DB::table('surveys')
                ->join('response_sets', 'response_sets.surveyID', '=', 'surveys.surveyID')
                ->where('surveys.code', '=', $request->surveyCode)
                ->where('response_sets.emailAddress', '=', $request->email)
                ->count();

            if ($ValidEmail == 1) {
                throw ValidationException::withMessages([
                    'email' => ['You have already responded using this email address.'],
                ]);
            } else {
                $survey = Survey::select('surveyID', 'name', 'createdBy')->where('code', $request->surveyCode)->first();
                $company = User::select('name')->where('userID', $survey->createdBy)->first();

                $respondent = new Response_set;
                $respondent->emailAddress = $request->email;
                $respondent->surveyID = $survey->surveyID;
                $respondent->save();

                $ret = array(
                    "token"         => $respondent->createToken($request->device_name)->plainTextToken,
                    "responseSetID" => $respondent->responseSetID,
                    "surveyID"      => $survey->surveyID,
                    "surveyName"    => $survey->name,
                    "name"          => $company->name,
                );
            }
        }
        return response()->json($ret);
    }

    public function submitSurvey(Request $request)
    {
        for ($i = 0; $i < count($request->questions); $i++) {
            $response = new Response;
            $response->responseSetID =  $request->responseSetID;
            $response->questionID = $request->questions[$i];
            $response->rating = $request->ratings[$i];
            $response->save();
        }
        return response()->json("Survey Successfully Submitted");
    }
}
