<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use illuminate\support\facades\file;
use illuminate\support\facades\storage;
use App\Http\Requests\getClientOriginalExtension;
use App\Models\Studentdata;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function form_submit(Request $request)
    {
        try {
            $add = new Studentdata;
    
            if ($request->isMethod('post')) {
                $add->name = $request->get('name');
                $add->age = $request->get('age');
                $add->city = $request->get('city');
                $add->save();
                
                return response()->json([
                    "message" => "Successfully added record",
                ], 201); // HTTP status code 201 for a successful creation
            } else {
                return response()->json([
                    "message" => "Method not allowed",
                ], 405); // HTTP status code 405 for method not allowed
            }
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error: " . $e->getMessage(),
            ], 500); // HTTP status code 500 for internal server error
        }
    }
    

    public function display_form()
    {
        // $students=studentdata::all();
        // return response($students,200); //first method to display data

        return Studentdata::all();//second method to display data
    }

    Public function delete_data($id)
    {
        $studentdata = Studentdata::find($id);
       $studentdata->delete();
       return ["msg" => "Successfully deleted"];
    }

    // public function fetch_data($id)
    // {
    //     if(Studentdata::where('id',$id)->exists())
    //     {
    //         $stud=studentdata::where('id',$id)->get();
    //         return response($stud,200);
    //     }
    //     else
    //     {
    //         return response()->json([
    //             "msg" => "data not fetched"
    //         ],202);
    //     }
    // }

    // public function edit_data(Request $request,$id="")
    // {
    //     if(Studentdata::where('id',$id)->exists())
    //     {
    //         $stud = studentdata::find($id);
    //         $stud->name=$request->get('name');
    //         $stud->age=$request->get('age');
    //         $stud->city=$request->get('city');
    //         $stud->save();
    //         return ["message" => "Record updated successfully"];
    //     }
    //     else
    //     {
    //         return ["message" => "Record NOT updated successfully"];
    //     }
    // }

    public function UpdateRecord(Request $request)
    {
    
        $id = $request->get('id');
        $stud = Studentdata::find($id);
    
            $stud->name = $request->get('name');
            $stud->age = $request->get('age');
            $stud->city = $request->get('city');
            $stud->save();
    
            return ["message" => "Record updated successfully"];
       
    }

    public function SearchRecord($search)
    {
        $data = Studentdata::where("name","LIKE","%".$search."%")->exists();
        if($data)
        {
            return response()->json($data); 
        }
        else
        {
            return ["msg" => "Not searched"];
        }
    }

    public function FileUpload(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $filename = time().'.'.$ext;
        
        if($filename)
        {
            return $file->storeAs('FileUpload', $filename);
        }
        else
        {
            return ["msg" => "Failed to upload file"];
        }
           
    }

    public function Carbon_function()
    {
        // return Carbon::now()->format("Y-m-d H:i:s"); this is UTC time format 
        // echo"<br>";
        $currenttime = Carbon::now('Asia/Kolkata');
        echo $currenttime;
        echo"<hr>";
       
    }
}
