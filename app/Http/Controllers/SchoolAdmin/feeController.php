<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use App\Models\acdamicYear;
use App\Models\FeeManagement;
use App\Models\feeTypes;
use App\Models\masterSettings;
use App\Models\paymentType;
use App\Models\Schools;
use App\Models\students;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class feeController extends Controller
{

    public function showStudents()
    {
        return view('schooladmin.fee.list');
    }

    public function StudentsListDatatable()
    {
        $students = students::where('school_id', auth()->user()->school_id)->orderBy('id', 'DESC')->select('*')->get();
        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('actions', function ($student) {
                return '<a href="' . route('schooladmin.fee.students.pay', ["id" => $student->id]) . '" class="btn btn-xs btn-info">Pay</a>';
            })
            ->addColumn('name', function ($student) {
                return $student->first_name . ' ' . $student->last_name . ' ' . $student->sur_name;
            })
            ->addColumn('gender', function ($student) {
                if ($student->gender == 1) return "Male";
                if ($student->gender == 2) return "Female";
                return "Other";
            })
            ->addColumn('class', function ($student) {
                return $student->getClass->name;
            })
            ->addColumn('section', function ($student) {
                return $student->getSection->name;
            })
            ->rawColumns(['actions', 'class', 'section'])
            ->make(true);
    }

    public function payFee($id)
    {
        $feeTypes = feeTypes::where('school_id', auth()->user()->school_id)->orWhere('school_id', 0)->get();
        $paymentTypes = paymentType::get();
        $acadamicYears = acdamicYear::get();
        $currentAcadamicYear = masterSettings::find(1)->current_academic_year_id;
        $studentData = students::find($id);
        return view('schooladmin.fee.pay', compact('feeTypes', 'paymentTypes', 'id', 'acadamicYears', 'currentAcadamicYear', 'studentData'));
    }

    public function payFeeSubmit(Request $request)
    {
        try {
            $newPayment = new FeeManagement;
            $newPayment->student_id = $request->id;
            $newPayment->fee_type_id = $request->fee_type;
            $newPayment->fee_paid_date = $request->payment_date;
            $newPayment->fee_description = $request->description ? $request->description : "";
            $newPayment->acdamic_year_id = $request->acadamic_year ? $request->acadamic_year : "";;
            $newPayment->payment_amount = $request->payment_amount;
            $newPayment->payment_type_id = $request->payment_type;
            $newPayment->paid_to = auth()->user()->id;
            $newPayment->save();
            return redirect()->route('schooladmin.fee.students.pay', ['id' => $request->id])->with('doneMessage', 'Succesfully Paid');
        } catch (Exception $e) {
            return redirect()->route('schooladmin.fee.students.pay', ['id' => $request->id])->with('errorMessage', 'Something went wrong');
        }
    }

    // Fee Types management
    public function addType()
    {
        $feeTypes = feeTypes::where('school_id', auth()->user()->school_id)->orWhere('school_id', 0)->get();
        return view('schooladmin.fee.fee_type', compact('feeTypes'));
    }

    public function editType($id)
    {
        $feeTypes = feeTypes::where('school_id', auth()->user()->school_id)->orWhere('school_id', 0)->get();
        $formData = feeTypes::where('id', $id)->where('school_id', '!=', 0)->first();
        return view('schooladmin.fee.fee_type', compact('formData', 'feeTypes'));
    }

    public function typeSubmit(Request $request, $id = "")
    {
        $newFeeType = $id != "" ? feeTypes::where('id', $id)->where('school_id', '!=', 0)->first() : new feeTypes;
        $newFeeType->name = $request->name;
        $newFeeType->school_id = auth()->user()->school_id;
        $newFeeType->save();
        return redirect()->route('schooladmin.fee.type.add');
    }

    // Payement History
    private static function getPaymentHistoryObject($student_id, $acadamic_id)
    {
        return $paymentHistory = FeeManagement::where('student_id', $student_id)->where('acdamic_year_id', $acadamic_id)
            ->join('payment_types', 'fee_management.payment_type_id', '=', 'payment_types.id')
            ->join('fee_types', 'fee_management.fee_type_id', '=', 'fee_types.id')
            ->join('users', 'fee_management.paid_to', '=', 'users.id')
            ->select('fee_management.*', 'fee_types.id', 'fee_types.name as fee_type', 'payment_types.id', 'payment_types.name as payment_type', 'users.id', 'users.name as paid_to_staff')
            ->orderBy('fee_management.id', 'DESC');
    }

    public function getPaymentTutionFeeHistory($student_id, $acadamic_id)
    {
        $tutionFeeHistory = $this->getPaymentHistoryObject($student_id, $acadamic_id);
        $tutionFeeHistory = $tutionFeeHistory->where('fee_type_id', env('TUTION_FEE_TYPE_ID'))->get();
        return DataTables::of($tutionFeeHistory)
            ->addIndexColumn()
            ->addColumn('print_recipt', function ($fee) {
                return '<a data-payment-id="{{ $fee->id }}" class=" print-button btn btn-xs btn-info">Print Recipt</a>';
            })
            ->addColumn('description', function ($fee) {
                return $fee->fee_description != "" ? $fee->fee_description : "---";
            })
            ->rawColumns(['print_recipt'])
            ->make(true);
    }

    public function getPaymentOtherFeeHistory($student_id, $acadamic_id)
    {
        $otherFeeHistory = $this->getPaymentHistoryObject($student_id, $acadamic_id);
        $otherFeeHistory = $otherFeeHistory->get();
        return DataTables::of($otherFeeHistory)
            ->addIndexColumn()
            ->addColumn('print_recipt', function ($fee) {
                return '<a data-payment-id="{{ $fee->id }}" class="print-button btn btn-xs btn-info">Print Recipt</a>';
            })
            ->addColumn('description', function ($fee) {
                return $fee->fee_description != "" ? $fee->fee_description : "---";
            })
            ->rawColumns(['print_recipt'])
            ->make(true);
    }

    // Print-receipt
    public function paymentReceiptPrint($payment_id)
    {
        try {
            $schoolData = Schools::find(auth()->user()->school_id);
            $feepayement = FeeManagement::find($payment_id);
            return view('fee-receipt-templates.fee-receipt-template-1', compact('feepayement', 'schoolData'))->render();
        } catch (Exception $e) {
            return '';
        }
    }
}
