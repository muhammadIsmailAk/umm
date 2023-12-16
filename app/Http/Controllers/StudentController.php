<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Supervisor;
use App\Models\Acquire;
use DB;

class StudentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function  aprove($id) {


        $approved = DB::table('acquires')
        ->join('students', 'acquires.user_id', '=','students.student_id')
        ->join('items', 'acquires.product_id', '=', 'items.id')
        ->select('acquires.*', 'items.title','items.assetCode', 'students.name','students.student_code')
        ->where([['acquires.user_id', '=',$id],['acquires.status', '=', 'approved']])
        ->get();




        // $approved=Acquire::where([['status', '=', 'approved'],['user_id', '=',$id]])->get();
        // dump($approved);
        
        // echo $approved[0]->product_id;
        // die;
        return view('student.acquire',compact('approved'));
    }

    public function student()
    {
    
        $items = Items::paginate(15);
        dump($items);
return view('student.index',compact('items'));


    }


    public function  stdpending()
     {
         $pedd = DB::table('acquires')
        ->join('students', 'acquires.user_id', '=','students.student_id')
        ->join('items', 'acquires.product_id', '=', 'items.id')
        ->select('acquires.*', 'items.title','items.assetCode', 'students.name','students.student_code')
        ->where('acquires.status','=','pending')->orWhere('acquires.status','=','acceptFac')
        ->get();
        return view('student/stpend',compact('pedd'));

        // dump($items);
        // dd('df');

        // return view('student.pending',compact('items'));
        
       


        
    }


    public function aquire(Request $request)
    {
        $acq = new Acquire;
        
        $acq->email=$request->email;
        $acq->product_id=$request->prdid;
        $acq->user_id=$request->userid;
        $acq->level=$request->level;
        // $acq->acquire_date=$request->acqdate;
        // echo $acq->acquire_date;
        $date = new \DateTime($request->acqdate); // use your CSV field here.
        $acq->acquire_date= $date->format('Y/m/d');
        $tdate = new \DateTime($request->datee); // use your CSV field here.
        $acq->expire_date= $tdate->format('Y/m/d');
      
        $acq->save();
        
        

        return redirect()
            ->back()
            ->with('success', 'Request For Aquire Product Added successfully.');

  
       
        

    }
}
