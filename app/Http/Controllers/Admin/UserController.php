<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentRecommendationExport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $users = User::has('enrollments')->with('profile')->where('is_student', 0)->orderBy('created_at', 'DESC');

        $searchValues = $request->keyword;

        if (!empty($searchValues)) {
            $users = $users->whereHas('profile', function ($query) use ($searchValues) {
                $query->where(DB::raw("CONCAT(name_title_mm, name_mm)"), 'like', '%' . str_replace(' ', '%', $searchValues) . '%');
                $query->orWhere('date_of_birth' , 'like', '%' . str_replace(' ', '%', $searchValues) . '%');
                $query->orWhere(DB::raw("CONCAT(father_name_title_mm, father_name_mm)"), 'like', '%' . str_replace(' ', '%', $searchValues) . '%');
                $query->orWhere('email' , 'like', '%' . str_replace(' ', '%', $searchValues) . '%');
                $query->orWhere('address' , 'like', '%' . str_replace(' ', '%', $searchValues) . '%');
                $query->orWhere('contact_phone' , 'like', '%' . str_replace(' ', '%', $searchValues) . '%');
            });
        }

        $users = $users->paginate(10);

        return view('admin.students.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showCard(User $user)
    {
        $cardInfo = [
            'image' => $user->image,
            'name' => $user->name,
            'id' => $user->studentId(),
        ];

        return view('admin.students.id_card', compact('cardInfo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function printCard(User $user)
    {
        $cardInfo = [
            'image' => $user->image,
            'name' => $user->name,
            'id' => $user->studentId(),
        ];

        // share data to view
        view()->share('cardInfo', $cardInfo);
        $pdf = PDF::loadView('admin.students.id_card', $cardInfo);

        // download PDF file with download method
        return $pdf->download("{$user->studentId()}.pdf");
    }

    public function showRecommendation(User $user)
    {
        $recommendInfo = [
            'image' => $user->image,
            'name' => $user->profile->name_title_mm . $user->profile->name_mm,
            'nrc' => $user->profile->nrc_mm,
            'father_name' => $user->profile->father_name_mm,
            'id' => $user->studentId(),
        ];

        return view('admin.students.recommendation', compact('recommendInfo'));
    }


    public function printRecommendation(User $user)
    {
        $enrollment = $user->enrollments()->orderBy('created_at', 'DESC')->first();

        $recommendInfo = [
            'image' => $user->image,
            'name_title' => $user->profile->name_title_mm,
            'name' => $user->profile->name_mm,
            'nrc' => implode('/', json_decode($enrollment->user->profile->nrc_mm, true)),
            'birthday' => $user->profile->date_of_birth,
            'father_name_title' => $user->profile->father_name_title_mm,
            'father_name' => $user->profile->father_name_mm,
            'academic_year' => $enrollment->academic_year_from . '-' .$enrollment->academic_year_to,
            'study' => $user->confirmedStudy->study->name,
            'roll_number' => $enrollment->roll_number,
            'id' => $user->studentId(),
        ];

        // share data to view
        view()->share('recommendInfo', $recommendInfo);
        $pdf = PDF::loadView('admin.students.recommendation', $recommendInfo);

        // download PDF file with download method
        return $pdf->download("{$user->studentId()}.pdf");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function printExcelRecommendation(User $user)
    {
        return Excel::download(new StudentRecommendationExport($user), "{$user->studentId()}.xls");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return "view blade";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
