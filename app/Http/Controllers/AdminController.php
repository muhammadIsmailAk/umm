<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Items;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Supervisor;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        return view('admin.index');
    }

    public function addInventory()
    {
        return view('admin.add_inventory');
    }

    public function statusp()
    {
        // $items = Items::all();
        return view('admin.status');

    }

    public function available()
    {
        // $items = Items::all();
        return view('admin.available');

    }
    public function addSup()
    {
        return view('admin.addsup');
    }

    public function addFac()
    {
        return view('admin.addfac');
    }
    public function addStud()
    {
        return view('admin.addstud');
    }
    // public function staStud()
    // {
    //     return view('admin.studSta');
    // }

    // public function staFac() {
    //     return view('admin.facSta');
    // }
    // public function staSup() {
    //     return view('admin.supSta');
    // }
    

    public function store(Request $request)
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
    public function all()
    {
        $items = Items::all();
        return view('admin.inventory', compact('items'));

    }

    public function edit($id)
    {
        $item = Items::find($id);
        return view('admin.edit_inventory', compact('item'));
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

    public function addStudent(Request $request)
    {
        $validated = $request->validate(['name' => 'required|max:150', 'email' => 'required|email
        |unique:users', 'stdcode' => 'required|max:255', 'depart' => 'required',

        ]);
        $user = new User;
        $stu = new Student;
        DB::beginTransaction();
        // echo"dsfajfjha";
        

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 0;
        // echo
        $user->password = Hash::make(1234);
        // $user->name.rand();
        // echo $user->password;
        // die;
        $user->save();

        $stu->name = $request->name;
        $stu->student_id = $user->id;
        $stu->email = $request->email;
        $stu->student_code = $request->stdcode;
        $stu->status = $request->status;
        $stu->department = $request->depart;
        $stu->save();
        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Student created successfully.');

    }

    public function stuedit($id)
    {
        $stu =Student ::find($id);
        return view('admin.edit_stu', compact('stu'));

    }

    public function stuall()
    {
        $stu = Student::all();
        return view('admin.studSta', compact('stu'));

    }
    public function updatestu(Request $request,$id)
    {
        $validated = $request->validate(['name' => 'required|max:150', 'stdcode' => 'required|max:255', 'depart' => 'required',

        ]);
        
        $stu =Student::find($id);
        DB::beginTransaction();
        // echo"dsfajfjha";
        

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->role = 0;
        // // echo
        // $user->password = Hash::make(1234);
        // // $user->name.rand();
        // // echo $user->password;
        // // die;
        // $user->save();

        $stu->name = $request->name;
        
        $stu->student_code = $request->stdcode;
        $stu->status = $request->status;
        $stu->department = $request->depart;
        $stu->save();
        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Student Updated successfully.');



    }
    public function delstu($id)
    {
        // echo"dasfjf";
        // die;
        // $item = Items::find($id);
        $sup= Student::where('id', $id)->delete();
        if ($sup)
        {
            return redirect()->back()
                ->with('success', 'Student   deleted successfully');

        }
    }


    public function affixFac(Request $request)
    {
        $validated = $request->validate(['name' => 'required|max:150', 'email' => 'required|email
        |unique:users', 'facname' => 'required|max:255',

        ]);
        $user = new User;
        $fac = new Faculty;
        DB::beginTransaction();
        // echo"dsfajfjha";
        

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 2;
        // echo
        $user->password = Hash::make(1234);
        // $user->name.rand();
        // echo $user->password;
        // die;
        $user->save();

        $fac->name = $request->name;
        $fac->faculty_id = $user->id;
        $fac->email = $request->email;
        $fac->faculty_name = $request->facname;
        $fac->status = $request->status;
        $fac->save();
        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Faculty created successfully.');

    }

    public function facall()
    {
        $fac = Faculty::all();
        return view('admin.facSta', compact('fac'));

    }

    public function facedit($id)
    {
        $fac =Faculty ::find($id);
        return view('admin.editfac', compact('fac'));
    }


    public function updatefac(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|max:150',
        // 'email' => 'required|email
        // |unique:users',
        'facname' => 'required|max:255',

        ]);
        // $user = User::find($id);
        // dump($user);
        // die;
        $fac = Faculty::find($id);
        DB::beginTransaction();
        // echo"dsfajfjha";
        


        $fac->name = $request->name;
        // $sup->supervisor_id=$user->id;
        // $sup->email = $request->email;
        $fac->faculty_name = $request->facname;
        $fac->status = $request->status;
        $fac->save();
        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Faculty updated successfully.');

    }
    public function facdes($id)
    {
        // echo"dasfjf";
        // die;
        // $item = Items::find($id);
        $fac= Faculty::where('id', $id)->delete();
        if ($fac)
        {
            return redirect()->back()
                ->with('success', 'Faculty member  deleted successfully');

        }
    }


    public function superall()
    {
        $sup= Supervisor::all();
        return view('admin.supSta', compact('sup'));

    }

    public function affixSuper(Request $request)
    {
        $validated = $request->validate(['name' => 'required|max:150', 'email' => 'required|email
        |unique:users', 'department' => 'required|max:255',

        ]);
        $user = new User;
        $sup = new Supervisor;
        DB::beginTransaction();
        // echo"dsfajfjha";
        

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 3;
        // echo
        $user->password = Hash::make(1234);
        // $user->name.rand();
        // echo $user->password;
        // die;
        $user->save();

        $sup->name = $request->name;
        $sup->supervisor_id = $user->id;
        $sup->email = $request->email;
        $sup->depart_name = $request->department;
        $sup->status = $request->status;
        $sup->save();
        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Supervisor created successfully.');

    }

    public function superedit($id)
    {
        $sup = Supervisor::find($id);
        return view('admin.edit_sup', compact('sup'));
    }

    public function updateSuper(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|max:150',
        // 'email' => 'required|email
        // |unique:users',
        'department' => 'required|max:255',

        ]);
        // $user = User::find($id);
        $sup = Supervisor::find($id);
        DB::beginTransaction();
        // echo"dsfajfjha";
        

       

        $sup->name = $request->name;
        // $sup->supervisor_id=$user->id;
        // $sup->email = $request->email;
        $sup->depart_name = $request->department;
        $sup->status = $request->status;
        $sup->save();
        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Supervisor updated successfully.');

    }

    public function supdes($id)
    {
        // echo"dasfjf";
        // die;
        // $item = Items::find($id);
        $sup= Supervisor::where('id', $id)->delete();
        if ($sup)
        {
            return redirect()->back()
                ->with('success', 'Superviosr   deleted successfully');

        }
    }


}

