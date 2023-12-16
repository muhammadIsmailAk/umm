<?php

namespace App\Http\Controllers;
use App\Models\Items;
use App\Models\Acquire;
use Illuminate\Http\Request;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function firstpage()
    {
        $items = Items::where([
       'status' =>'active' ])->get();
return view('welcome',compact('items'));

    }

   

    public function  faculty() {
        return view('faculty.index');
    }

    public function  products() {
        return view('faculty.products');
    }
    

    


    public function  pending() {

        
        $items  = DB::table('acquires')
            ->join('students', 'acquires.user_id', '=','students.student_id')
            ->join('items', 'acquires.product_id', '=', 'items.id')
            ->select('acquires.*', 'items.title','items.assetCode', 'students.name','students.student_code')
            ->where('acquires.status','=','pending')
            ->get();

            // dump($items);

        // $items = Acquire::where([
        //     'status' =>'pending' ])->get();
    


        return view('faculty.pending',compact('items'));
    }



    public function  accepted() {

        
        $items  = DB::table('acquires')
            ->join('students', 'acquires.user_id', '=','students.student_id')
            ->join('items', 'acquires.product_id', '=', 'items.id')
            ->select('acquires.*', 'items.title','items.assetCode', 'students.name','students.student_code')
            ->where('acquires.status','=','acceptFac')
            ->get();

            // dump($items);

        // $items = Acquire::where([
        //     'status' =>'pending' ])->get();
    


        return view('faculty.accepted',compact('items'));
    }


    public function  rejected() {

        
        $items  = DB::table('acquires')
            ->join('students', 'acquires.user_id', '=','students.student_id')
            ->join('items', 'acquires.product_id', '=', 'items.id')
            ->select('acquires.*', 'items.title','items.assetCode', 'students.name','students.student_code')
            ->where('acquires.status','=','rejected')
            ->get();

            // dump($items);

        // $items = Acquire::where([
        //     'status' =>'pending' ])->get();
    


        return view('faculty.rejected',compact('items'));
    }


    public function facacc(Request $request,$id)

    {
        $acc=Acquire::find($id);
        $acc->status=$request->status;
        $acc->save();
        return redirect()
            ->back()
            ->with('success', 'Status updated successfully.');


    }

    public function facrej(Request $request,$id)

    {
        $acc=Acquire::find($id);
        $acc->status=$request->status;
        $acc->save();
        return redirect()
            ->back()
            ->with('success', 'Status updated successfully.');


    }
   
   
  
}
