<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeType;
use DataTables;
use Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        // auth:guard
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return view('pages.employee.action')->with('row', $row);
                    })
                    ->editColumn('employee_type_id', function($row) {
                        return $row->type->name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee_types = EmployeeType::all();

        return view('pages.employee.create')->with('employee_types', $employee_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'mobile_number' => 'required|numeric|min:8',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required'
        ], 
        [
            'type.required' => 'Ажилтны төрөл сонгогдоогүй байна',
            'password.confirmed' => 'Давтаж хийсэн нууц үг таарахгүй байна'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withInput($request->only('first_name', 'last_name', 'email', 'type', 'mobile_number'))
                             ->withErrors($validator->errors()->all());
        }

        $employee = new Employee;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->employee_type_id = explode('.', $request->type)[0];
        $employee->mobile_number = $request->mobile_number;

        $employee->password = Hash::make($request->password);

        if($employee->save())
        {
            return redirect()->route('employees')->with('success', 'Ажилтан амжилттай бүртгэгдлээ');
        }
        else
        {
            return response()->json(['error' => 'error occured']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('pages.employee.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $employee_types = EmployeeType::all();

        return view('pages.employee.edit')
                    ->with(['employee_types' => $employee_types, 'employee' => $employee]);
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => $request->email == Employee::findOrFail($id)->email ? '' : 'required|email|max:255|unique:employees',
            'mobile_number' => 'required|numeric|min:8',
            'password' => trim($request->password) == '' ? '' : 'string|min:8|confirmed' ,
            'type' => 'required'
        ], 
        [
            'type.required' => 'Ажилтны төрөл сонгогдоогүй байна',
            'password.confirmed' => 'Давтаж хийсэн нууц үг таарахгүй байна',
            'email.unique' => 'Имэйл давхцаж байна, өөр имэйл оруулна уу'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withInput($request->only('first_name', 'last_name', 'email', 'type', 'mobile_number'))
                             ->withErrors($validator->errors()->all());
        }

        $employee = Employee::find($id);

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;
        $employee->employee_type_id = explode('.', $request->type)[0];

        if(trim($request->password) != "")
            $employee->password = Hash::make($request->password);

        if($employee->save())
            return redirect()->route('employees')->with('success', 'Ажилчны мэдээлэл амжилттай засварлагдлаа');
        else
            return response()->json(['error' => 'error occured']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Employee::findOrFail($id)->delete())
            return redirect()->route('employees')->with('success', 'Ажилтан амжилттай устлаа');
        else
            return redirect()->route('employees')->with('warning', 'Ажилтан устсангүй');
    }


    // Profile

    public function show_profile()
    {
        return view('pages.employee.profile');
    }

    public function edit_profile()
    {
        return view('pages.employee.edit-profile');
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile_number' => 'required|numeric|min:8',
            'password' => trim($request->password) == '' ? '' : 'string|min:8|confirmed' ,
        ], 
        [
            'password.confirmed' => 'Давтаж хийсэн нууц үг таарахгүй байна'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withInput($request->only('first_name', 'last_name', 'email', 'mobile_number'))
                             ->withErrors($validator->errors()->all());
        }

        $employee = Employee::find(Auth::user()->id);

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;

        if(trim($request->password) != "")
            $employee->password = Hash::make($request->password);

        if($employee->save())
            return redirect()->route('employee.profile.index')->with('success', 'Профайл амжилттай шинэчлэгдлээ');
        else
            return response()->json(['error' => 'error occured']);
    }
}
