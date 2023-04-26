<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use App\Models\subjects;
use Illuminate\Http\Request;

class subjectController extends Controller
{
    public function addSubject()
    {
        $subjects = subjects::where('school_id', auth()->user()->school_id)->get();
        return view('schooladmin.subjects.addOrEditSubjects', compact('subjects'));
    }

    public function editSubject($id)
    {
        $subjects = subjects::where('school_id', auth()->user()->school_id)->get();
        $formData = $subjects->where('id',$id)->first();
        return view('schooladmin.subjects.addOrEditSubjects', compact('subjects','formData'));
    }

    public function submitSubject(Request $request, $id = "")
    {
        $newSubject = $id != "" ? subjects::find($id) : new subjects;
        $newSubject->subject_name = $request->subject_name;
        $newSubject->school_id = auth()->user()->school_id;
        $newSubject->save();
        return redirect()->route('schooladmin.subject.add');
    }
}
