<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $student;
    public function __contruct(){
        $this->student = new Student();
    }
    // public function index()
    // {
    //     return $this->student->get()->toArray();
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->student->create($request->all());
        // return $request->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return $this->student->find($id);
        $this->student->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = $this->student->find($id);
        $student->update($request->all());
        return $student;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = $this->student->find($id);
        return $student->delete();
    }
}
