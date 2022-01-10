<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Response_set;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{
    public function index()
    {
        //
    }

    public function validateAccess(Request $request)
    {
        $request->validate([
            'surveyCode'   => ['required'],
            'email'        => ['required', 'email'],
        ]);

        // check if customer already did the survey

        $codeCount = Survey::where('code', $request->surveyCode)->count();
        if ($codeCount == 0) {
            throw ValidationException::withMessages([
                'surveyCode' => ['The provided credentials are incorrect.'],
            ]);
        }
        $count = DB::table('surveys')
            ->join('response_sets', 'response_sets.surveyID', '=', 'surveys.surveyID')
            ->where('surveys.code', '=', $request->surveyCode)
            ->where('response_sets.emailAddress', '=', $request->email)
            ->get();


        return response()->json($codeCount);
    }
}
