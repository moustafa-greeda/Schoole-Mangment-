<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGrades;
use App\Models\Grades\Grade;

class GradeController extends Controller
{
  public function index()
  {
    toastr()->success('Success Message');
    $Grades= Grade::all();
    // return view('pages.Grades.Grades' , compact('Grades'));
    toastr()->success('Success Message');
    return view('pages.Grades.Grades' , compact('Grades'));

  }

  public function create()
  {

  }

  public function store(StoreGrades $request)
  {
    $validated = $request->validated();

    $Grade = new Grade();
    $Grade->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name];
    $Grade->Note = $request->Notes;
    $Grade->save();

    toastr()->success('Success Message');
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

  }

}

?>
