<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
     public function create(Request $request): \Illuminate\Http\JsonResponse
     {
         $this->validate($request,[
             'name' => ['required','unique:branches'],
             'code' => ['required']
         ]);

         $branch = new Branch();
         $branch->name = $request->name;
         $branch->code = $request->code;

         $branch->save();
         return response()->json(new BranchResource($branch));
     }
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(BranchResource::collection(Branch::orderBy('created_at','desc')->get()));
    }
    public function show(Branch $branch): \Illuminate\Http\JsonResponse
    {
        return response()->json(new BranchResource($branch));
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => ['required','unique:branches,name,'.$request->id],
            'code' => ['required']
        ]);

        $branch =  Branch::where();
        $branch->name = $request->name;
        $branch->code = $request->code;

        $branch->update();
        return response()->json(new BranchResource($branch));
    }
    public function delete(Branch $branch): \Illuminate\Http\JsonResponse
    {
        $branch->delete();
        return response()->json(['success' => true],200);
    }

    public function get_branch_employees(Branch $branch): \Illuminate\Http\JsonResponse
    {
        return response()->json(BranchResource::collection($branch->employees->loadMissing('employees')));
    }
}
