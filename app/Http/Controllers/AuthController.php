<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Session;
use DB;
use App\Models\User;
use App\Models\Student;
use Hash;
use Illuminate\Support\Arr;
use tidy;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crudpage.login');
    }

    public function registration()
    {
        return view('crudpage.registration');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Password is Wrong..!!');
            }
        } else {
            return back()->with('fail', 'This Email is Wrong..!!');
        }

        // $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) 
        // {
        //     return redirect()->intended('dashboard')
        //     ->withSuccess('You have Successfully loggedin');
        // }

        // return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        // $data = $request->all();
        // $check = $this->create($data);
        if ($res) {
            return back()->with('success', 'Great! You have Successfully Register');
        } else {
            return back()->with('fail', 'Great! You have Successfully Register');
        }
    }

    public function dashboard()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard', compact('data'));
    }

    // public function create(array $data)
    // {
    //     return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password'])
    //     ]);
    // }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crudpage.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->course = $request->input('course');

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/students/', $filename);
            $student->profile_image = $filename;
        }
        $student->save();
        return redirect()->back()->with('status', 'Student Data are SuccessFully saved...');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showdata()
    {
        //
        // $data = DB::table('students')->paginate(2);
        $data = Student::paginate(2);

        return view('showdata', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Student::find($id);
        return view('edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $data = Student::find($request->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->course = $request->course;

        if ($request->hasfile('profile_image')) {
            $destination = 'uploads/students/' . $data->profile_image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/students/', $filename);
            $data->profile_image = $filename;
        }

        $data->update();
        return redirect('showdata')->with('status', 'Student Image Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $data = Student::find($id);
        $data->delete();
        return redirect('showdata');
    }
    // public function search()
    // {
    //     $search_text = $_GET['query'];
    //     $data = Student::where('name', 'email', 'course', 'LIKE', '%' . $search_text . '%')->get();

    //     return view('search', compact('data'));
    // }
}