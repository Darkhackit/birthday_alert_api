<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request,[
            'first_name' => ['required','max:100','min:3'],
            'last_name' => ['required','max:100','min:3'],
            'email' => ['required','email','unique:employees'],
            'gender' => ['required'],
            'branch_id' => ['required'],
            'dob' => ['required','date']
        ]);

        $employee = new Employee();
        $employee->firstname = $request->first_name;
        $employee->lastname = $request->last_name;
        $employee->middlename = $request->middle_name;
        $employee->email = $request->email;
        $employee->gender = $request->gender;
        $employee->branch_id = $request->branch_id;
        $employee->dob = $request->dob;
        $employee->user_id = auth()->id();
        $employee->save();

        return response()->json(new EmployeeResource($employee),200);
    }
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(EmployeeResource::collection(Employee::orderBy('created_at','desc')->get()));
    }
    public function show(Employee $employee): \Illuminate\Http\JsonResponse
    {
        return response()->json(new EmployeeResource($employee),200);
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'first_name' => ['required','max:100','min:3'],
            'last_name' => ['required','max:100','min:3'],
            'email' => ['required','unique:employees,email,'.$request->id],
            'gender' => ['required'],
            'branch_id' => ['required'],
            'dob' => ['required','date']
        ]);

        $employee =  Employee::where('id',$request->id);
        $employee->firstname = $request->first_name;
        $employee->lastname = $request->last_name;
        $employee->middlename = $request->middle_name;
        $employee->email = $request->email;
        $employee->gender = $request->gender;
        $employee->branch_id = $request->branch_id;
        $employee->dob = $request->dob;
        $employee->update();

        return response()->json(new EmployeeResource($employee),200);
    }
    public function delete(Employee $employee): \Illuminate\Http\JsonResponse
    {
        $employee->delete();
        return response()->json(['success' => true]);
    }
    public function get_this_month_employees(): \Illuminate\Http\JsonResponse
    {
        $employees = Employee::whereMonth('dob',Carbon::now()->format('m'))->get();
        return response()->json(EmployeeResource::collection($employees));
    }
    public function get_tomorrow_employees(): \Illuminate\Http\JsonResponse
    {
        $employees = Employee::whereMonth('dob',Carbon::now()->format('m'))
                     ->whereDay('dob', Carbon::now()->addDay()->format('d'))->get();
        return response()->json(EmployeeResource::collection($employees));
    }
    public function get_today_employees(): \Illuminate\Http\JsonResponse
    {
        $employees = Employee::whereMonth('dob',Carbon::now()->format('m'))
            ->whereDay('dob', Carbon::now()->format('d'))->get();
        return response()->json(EmployeeResource::collection($employees));
    }
}
