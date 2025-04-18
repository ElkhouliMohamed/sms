<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:accountant|admin');
    }

    public function index()
    {
        $payments = Payment::with('student')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $students = Student::all();
        return view('payments.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_type' => 'required|in:tuition,transport,other',
            'status' => 'required|in:pending,completed,failed',
        ]);

        Payment::create($request->all());
        return redirect()->route('payments.index')->with('success', 'Payment recorded.');
    }
}
