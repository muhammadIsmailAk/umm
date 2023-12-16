<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Items;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Supervisor;
use App\Models\Acquire;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    
    public function  supervisor() {
       
        return view('supervisor.index');
    }

    // public function  dash() {
    //     return view('supervisor.');
    // }

    public function  request() {

        
        $items  = DB::table('acquires')
            ->join('students', 'acquires.user_id', '=','students.student_id')
            ->join('items', 'acquires.product_id', '=', 'items.id')
            ->select('acquires.*', 'items.title','items.assetCode', 'students.name','students.student_code')
            ->where('acquires.status','=','acceptFac')
            ->get();

            // dump($items);

        // $items = Acquire::where([
        //     'status' =>'pending' ])->get();
    


        return view('supervisor.request',compact('items'));
    }

    public function  reject() {

        
        $items  = DB::table('acquires')
            ->join('students', 'acquires.user_id', '=','students.student_id')
            ->join('items', 'acquires.product_id', '=', 'items.id')
            ->select('acquires.*', 'items.title','items.assetCode', 'students.name','students.student_code')
            ->where('acquires.status','=','rejectSuper')
            ->get();

            // dump($items);

        // $items = Acquire::where([
        //     'status' =>'pending' ])->get();
    


        return view('supervisor.rejected',compact('items'));
    }

    public function  approved() {

        
        $items  = DB::table('acquires')
            ->join('students', 'acquires.user_id', '=','students.student_id')
            ->join('items', 'acquires.product_id', '=', 'items.id')
            ->select('acquires.*', 'items.title','items.assetCode', 'students.name','students.student_code')
            ->where('acquires.status','=','approved')
            ->get();

            // dump($items);

        // $items = Acquire::where([
        //     'status' =>'pending' ])->get();
    


        return view('supervisor.approved',compact('items'));
    }

    public function Supacc(Request $request,$id,$pid)

    {
        // $CDF=Input::all();
        // echo $CDF;
        // die;
        DB::beginTransaction();
        $acc=Acquire::find($id);
        $acc->status=$request->status;
        $acc->save();
        $item=Items::find($pid);
        $item->status=$request->prd;
        $item->last_used_at=$request->da;
        $item->save();
       
        DB::commit();
        return redirect()
            ->back()
            ->with('success', 'Status updated successfully.');


    }

    public function Suprej(Request $request,$id)

    {
        $acc=Acquire::find($id);
        $acc->status=$request->status;
        $acc->save();
        return redirect()
            ->back()
            ->with('success', 'Status updated successfully.');


    }
    public function supitem()
    {
        return view('supervisor.upload');

    }


    public function edit($id)
    {
        $item = Items::find($id);
        return view('supervisor.edit_item', compact('item'));
    }
    public function destroy($id)
    {
        // echo"dasfjf";
        // die;
        // $item = Items::find($id);
        $Item = Items::where('id', $id)->delete();
        if ($Item)
        {
            return redirect()->back()
                ->with('success', 'Item deleted successfully');

        }

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['title' => 'required|max:255', 'assetcode' => 'required', 'facultyI' => 'required|max:255', 'super' => 'required',

        ]);

        $item = Items::find($id);
        if ($request->hasFile('image'))
        {
            $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048', ]);

            $img = $item->image;
            if (File::exists($img))
            {
                File::delete($img);
            }

            $image = $request->file('image');
            $destinationPath = 'items/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $img = $image->move($destinationPath, $profileImage);
            $item->image = $img;

        }
        $item->title = $request->title;
        $item->assetCode = $request->assetcode;
        $item->facInc = $request->facultyI;
        $item->AdminSup = $request->super;
        $item->Dapart = $request->depart;
        $item->desc = $request->des;
        $item->status = $request->status;

        $item->save();

        return redirect()
            ->back()
            ->with('success', 'Item updated successfully');

    }



    public function received()
    {
       
        $item =Acquire::where('acquires.status', '=', 'approved')->get();
        // dump($item);
        
        return view('supervisor.received',compact('item'));

    }
    public function recstati()
    {
        return view('supervisor.received_stat');

    }
    public function statis()
    {
        $items = Items::all();
       
        return view('supervisor.item',compact('items'));

    }
    public function supstore(Request $request)
    {
        $validated = $request->validate(['title' => 'required|max:255', 'assetcode' => 'required', 'facultyI' => 'required|max:255', 'super' => 'required', 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        $items = new Items;

        $image = $request->file('image');
        // echo"sdjf";
        // die;
        $destinationPath = 'items/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $img = $image->move($destinationPath, $profileImage);
        $items->title = $request->title;
        $items->assetCode = $request->assetcode;
        $items->facInc = $request->facultyI;
        $items->AdminSup = $request->super;
        $items->Dapart = $request->depart;
        $items->image = $img;
        $items->desc = $request->des;
        $items->status = $request->status;

        $items->save();

        return redirect()
            ->back()
            ->with('success', 'Product created successfully.');

        // else{
        //     return redirect()->back()
        //                 ->with('unsccess','Product created not  successfully.');
        // }
        

        
    }

        public function statusrec(Request $request)          
        {
            $id=$request->prdid;   
            $acc=Acquire::find($id);
            $acc->item_status=$request->sta;
            $acc->comment=$request->comment;  
            $acc->penalities=  $request->pen;
            $acc->save();
            return redirect()
            ->back() ->with('success', 'Status Updated successfully.');;

        }
    
   

}
