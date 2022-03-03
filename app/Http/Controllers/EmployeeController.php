<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Validator;
use Exception;


class EmployeeController extends Controller
{
    public function getEmployee()
    {
        try {
            $employee = Employee::get();
            return response()->json(['status' => 'success', 'data' => $employee], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function createEmployee(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'start_date' => 'required|date',
            ]);
            if($validator->fails()){
                return response()->json(['error' => $validator->errors()], 400);
            }
            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'start_date' => $request->start_date
            ]);
            return response()->json(['status' => 'success', 'data' => $employee], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function updateEmployee(Request $request)
    {
        try {
            Employee::where('id', $request->id)->firstOrFail();
            Employee::where('id', $request->id)->update($request->data);
            $employee = Employee::where('id', $request->id)->get();
            return response()->json(['status' => 'success', 'data' => $employee], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function removeEmployee(Request $request)
    {
        try {
            Employee::where('id', $request->id)->firstorFail();
            $employee = Employee::where('id', $request->id)->delete();
            return response()->json(['status' => 'success', 'data' => 'Employee successfully removed'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }
}
