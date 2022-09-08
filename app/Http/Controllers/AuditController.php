<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\CourierSecurity;
use App\Models\Department;
use App\Models\DepartmentSecurity;
use App\Models\Question;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    //
    public function index()
    {

        $questions = Question::where('title', 0)->get();
        $departments = Department::get();

        $depArray = [];
        $doneDep = [];
        $notDoneDep = [];
        $perDoneDep = [];
        foreach($departments as $dep){
            array_push($depArray, $dep->name);
            array_push($doneDep, CourierSecurity::where('department_id', $dep->id)->where('status', 1)->count());
            array_push($notDoneDep, CourierSecurity::where('department_id', $dep->id)->where('status', 0)->count());
            $totalDep = CourierSecurity::where('department_id', $dep->id)->count();
            if ($totalDep == 0) {
                array_push($perDoneDep, 0);
            }else{
                $percentage = (CourierSecurity::where('department_id', $dep->id)->where('status', 1)->count()/$totalDep)*100;
                array_push($perDoneDep, $percentage);
            }
        }

        foreach ($questions as $question) {
            $total = CourierSecurity::where('question_id', $question->id)->count();
            if ($total == 0) {
                continue;
            }
            $done = CourierSecurity::where('question_id', $question->id)->where('status', 1)->count();
            $percent = round(($done / $total) * 100);
            $evaluation = "";
            $type = "";
            switch ($percent) {
                case $percent < 25:
                    $evaluation = "Very Bad";
                    $type = "gradient-danger";
                    break;
                case $percent < 50:
                    $evaluation = "Bad";
                    $type = "gradient-primary";
                    break;

                case $percent < 75:
                    $evaluation = "Average";
                    $type = "gradient-warning";
                    break;

                case $percent < 80:
                    $evaluation = "Fairly Good";
                    $type = "gradient-info";
                    break;

                case $percent < 100:
                    $evaluation = "Excellent";
                    $type = "gradient-success";
                    break;

                default:
                    $evaluation = "No Comment";
                    $type = "gradient-secondary";
                    break;
            }
            $percent = (string)$percent;

            $question["evaluation"] = $evaluation;
            $question["percent"] = $percent;
            $question["type"] = $type;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $department = Department::find($id);
            if ($department) {
                $departmentQuestions = Question::where('title', 0)->get();

                foreach ($departmentQuestions as $key => $question) {
                    $total = CourierSecurity::where('question_id', $question->id)->where('department_id', $id)->count();
                    if ($total == 0) {
                        unset($departmentQuestions[$key]);
                        continue;
                    }
                    $done = CourierSecurity::where('question_id', $question->id)->where('department_id', $id)->where('status', 1)->count();
                    $percent = round(($done / $total) * 100);
                    $evaluation = "";
                    $type = "";
                    switch ($percent) {
                        case $percent < 25:
                            $evaluation = "Very Bad";
                            $type = "gradient-danger";
                            break;
                        case $percent < 50:
                            $evaluation = "Bad";
                            $type = "gradient-primary";
                            break;

                        case $percent < 75:
                            $evaluation = "Average";
                            $type = "gradient-warning";
                            break;

                        case $percent < 80:
                            $evaluation = "Fairly Good";
                            $type = "gradient-info";
                            break;

                        case $percent < 100:
                            $evaluation = "Excellent";
                            $type = "gradient-success";
                            break;

                        default:
                            $evaluation = "No Comment";
                            $type = "gradient-secondary";
                            break;
                    }
                    $percent = (string)$percent;

                    $question["evaluation"] = $evaluation;
                    $question["percent"] = $percent;
                    $question["type"] = $type;
                }
            } else {
                return redirect()->route('audit.page');
            }

        }

        $securities = DepartmentSecurity::where('department_id', 1)
            ->join('questions', 'questions.id', '=', 'department_securities.question_id')
            ->join('departments', 'departments.id', '=', 'department_securities.department_id')
            ->get(['department_securities.*', 'questions.description as description', 'questions.title as title', 'questions.id as question_id', 'departments.id as department_id']);
        $user_departments = Department::where('user_id', auth()->user()->id)->get();
        if (isset($_GET['id'])) {
            return view('pages/audit/index')
                ->with('securities', $securities)
                ->with('departments', $departments)
                ->with('questions', $questions)
                ->with('depArray', $depArray)
                ->with('doneDep', $doneDep)
                ->with('notDoneDep', $notDoneDep)
                ->with('perDoneDep', $perDoneDep)
                ->with('departmentQuestions', $departmentQuestions)
                ->with('user_departments', $user_departments);
        }else{

            return view('pages/audit/index')
            ->with('securities', $securities)
            ->with('departments', $departments)
            ->with('questions', $questions)
            ->with('depArray', $depArray)
            ->with('doneDep', $doneDep)
            ->with('notDoneDep', $notDoneDep)
            ->with('perDoneDep', $perDoneDep)
            ->with('user_departments', $user_departments);
        }
    }
}
