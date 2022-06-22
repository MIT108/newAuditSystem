<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    //
    public function index(){
        $couriers = Courier::join('users', 'users.id', '=' , 'couriers.user_id')
        ->join('departments', 'departments.id', '=' , 'couriers.department_id')
        ->get(['couriers.*', 'users.name as creator', 'departments.name as department']);
        // $couriers = Courier::join('users', 'users.id', '=' , 'couriers.user_id')
        // ->get(['couriers.*', 'users.name as creator', 'departments.name as department_name']);
        // $couriers = Depart

        // dd($couriers);

        $departments = Department::get();
        $user_departments = Department::where('user_id', auth()->user()->id)->get();
        return view('pages/courier/index')->with('couriers', $couriers)->with('departments', $departments)->with('user_departments', $user_departments);
    }

    public function create(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|file',
            'department_id' => 'required'
        ]);


        $message = '';
        $error = false;

        $userId = auth()->user()->id;

        $mytime = Carbon::now();

        $serialNumber = strtotime($mytime);

        $imageFullName = $request->file('image')->getClientOriginalName();

        $fileName = $serialNumber.$imageFullName;

        $fields += [
            'user_id' => $userId,
            'serial_number' => $serialNumber,
            'file_name' => $fileName
        ];
        $fields['image'] = $fileName;
        try {
            Courier::create($fields);

            $request->file('image')->storeAs('public/images', $fileName);
            $message = 'Courier created successfully';

        } catch (\Throwable $th) {
            $message= $th->getMessage();
            $error = true;
        }

        if ($error) {
            return redirect()->back()->with('error', $message);

        } else {
            return redirect()->back()->with('success', $message);
        }

    }
}
