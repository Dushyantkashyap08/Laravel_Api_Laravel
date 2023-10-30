<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use illuminate\support\facades\file;
use illuminate\support\facades\storage;
use App\Http\Requests\getClientOriginalExtension;
use App\Models\Studentdata;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function form_submit(Request $request)
    {
        $add = new Studentdata;

        if($request->isMethod('post'))
        {
            $add->name=$request->get('name');
            $add->age=$request->get('age');
            $add->city=$request->get('city');
            $add->save();
        }
        return response()->json([
            "message" => "Successfully added record",
        ],201);//201 here is called HTTP status code which will tell about status of data inserted or not
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
}
