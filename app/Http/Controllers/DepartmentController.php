<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\CourierSecurity;
use App\Models\Department;
use App\Models\DepartmentSecurity;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function index(){
        $departments = Department::join('users', 'users.id', '=' , 'departments.user_id')->get(['departments.*', 'users.name as head']);

        $users = User::get();

        $user_departments = Department::where('user_id', auth()->user()->id)->get();
        return view('pages/department/index')
        ->with('departments', $departments)
        ->with('users', $users)
        ->with('user_departments', $user_departments);
    }


    public function create(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'user_id' => 'required'
        ]);
        $message = '';
        $error = false;


        if ($this->checkDepartmentName($fields['name'])) {

            try {
                Department::create($fields);
                $message = 'Department created successfully';

            } catch (\Throwable $th) {
                $message= $th->getMessage();
                $error = true;
            }

        }else{
            $message= "This department name already exists";
            $error = true;
        }


        if ($error) {
            return redirect()->back()->with('error', $message);

        } else {
            return redirect()->back()->with('success', $message);
        }

    }


    public function checkDepartmentName($name){
        if (Department::where('name', $name)->count() > 0) {
            return false;
        }else {
            return true;
        }
    }

    public function view(Request $request){

        $questions = Question::get();
        $documents = Courier::where('department_id', $_GET['id'])->where('status', 0)->get();
        $securities = DepartmentSecurity::where('department_id', $_GET['id'])
        ->join('questions', 'questions.id', '=' , 'department_securities.question_id')
        ->join('departments', 'departments.id', '=' , 'department_securities.department_id')
        ->get(['department_securities.*', 'questions.description as description', 'questions.title as title','questions.id as question_id', 'departments.id as department_id']);
        $user_departments = Department::where('user_id', auth()->user()->id)->get();
        if (isset($_GET['document'])) {
            $doc = Courier::where('id', $_GET['document'])->get()[0];
            return view('pages/department/view')
            ->with('securities', $securities)
            ->with('questions', $questions)
            ->with('documents', $documents)
            ->with('doc', $doc)
            ->with('user_departments', $user_departments);
        }
        return view('pages/department/view')
        ->with('securities', $securities)
        ->with('questions', $questions)
        ->with('documents', $documents)
        ->with('user_departments', $user_departments);
    }

    public function createDepartmentSecurity(Request $request){
        $fields = $request->validate([
            'question_id' => 'required',
            'department_id' => 'required',
        ]);
        $message = '';
        $error = false;

        if ($this->checkDepartmentSecurity($fields['department_id'], $fields['question_id'])) {

            try {
                DepartmentSecurity::create($fields);
                $message = 'creation successfully';

            } catch (\Throwable $th) {
                //throw $th;
                $message= $th->getMessage();
                $error = true;
            }

        }else{
            $message= "This question already exists in the department";
            $error = true;
        }



        if ($error) {
            return redirect()->back()->with('error', $message);

        } else {
            return redirect()->back()->with('success', $message);
        }
    }

    public function checkDepartmentSecurity($department, $question){
        if (DepartmentSecurity::where('department_id', $department)->where('question_id', $question)->count() > 0) {
            return false;
        }else {
            return true;
        }
    }

    public function createCourierSecurity(Request $request){
        $fields = $request->validate([
            'courier_id' => 'required',
            'department_id' => 'required',
        ]);



        $securities = DepartmentSecurity::where('department_id', $fields['department_id'])->get();

        foreach ($securities as $security) {
            $data = $fields;
            $data += [
                'department_security_id' => $security->id,
                'question_id' => $security->question_id,
            ];

            if ($request[$security->id] == 1) {
                $data += [
                    'status' => $request[$security->id]
                ];
            }

            CourierSecurity::create($data);
        }

        $courier = Courier::find($fields['courier_id']);
        $courier->status = 1;
        $courier->save();

        return redirect()->back()->with('success', "Successful update");

    }

}
