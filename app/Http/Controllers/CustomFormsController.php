<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomFormsController extends Controller
{
    public function formenrollcheck(Request $request){

        $check = DB::table('form_answer_fields')->where('form_field_id', $request->form_field_id)->where('form_field_value','like', '%'.$request->identity.'%')->exists();
        if($check){
            return "true";
        } else {
            return "false";
        }
    }
    public function masatenisi(Request $request)
    {
        $studentid = $request->session()->get('studentlogin');

        if ($studentid != null) {
            $student = student::where('id', $studentid)->first();
        } else {
            session(['loginpageurl' => $request->url()]);
            return redirect()->route('login');
        }

        $enroll = DB::table('form_answers')->where('student_id', $studentid)->where('form_id', 4)->where('deleted_at', null)->first();

        if ($enroll != null) {
            $enroll_details = DB::table('form_answer_fields')->where('form_answer_id', $enroll->id)->get();
        } else {
            $enroll_details = null;
        }

        return view('customforms/masatenisi', compact('student', 'enroll_details', 'enroll'));
    }
}
