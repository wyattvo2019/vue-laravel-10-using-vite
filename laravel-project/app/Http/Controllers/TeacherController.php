<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Validator;
use App\Models\Teacher;
use App\Http\Resources\Teacher as TeacherResource;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    // protected $teacher;
    // public function __contruct(){
    //     $this->teacher = new Teacher();
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        $arr = [
            'status' => true,
            'message' => "Danh sách giáo viên",
            'data'=>\App\Http\Resources\Teacher::collection($teachers)
        ];
         return response()->json($arr, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'name' => 'required', 'age' => 'required'
        ]);
        if($validator->fails()){
            $arr = [
            'success' => false,
            'message' => 'Lỗi kiểm tra dữ liệu TC',
            'data' => $validator->errors()
            ];
            return response()->json($arr, 200);
        }
        $product = \App\Models\Teacher::create($input);
        $arr = ['status' => true,
            'message'=>"Giáo viên đã lưu thành công",
            'data'=> new \App\Http\Resources\Teacher($product)
        ];
        return response()->json($arr, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::find($id);
        if (is_null($teacher)) {
           $arr = [
             'success' => false,
             'message' => 'Không có giáo viên này',
             'dara' => []
           ];
           return response()->json($arr, 200);
        }
        $arr = [
          'status' => true,
          'message' => "Chi tiết giáo viên",
          'data'=> new \App\Http\Resources\Teacher($teacher)
        ];
        return response()->json($arr, 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
           'name' => 'required',
           'age' => 'required'
        ]);
        if($validator->fails()){
           $arr = [
             'success' => false,
             'message' => 'Lỗi kiểm tra dữ liệu',
             'data' => $validator->errors()
           ];
           return response()->json($arr, 200);
        }
        $teacher = Teacher::find($id);
        $teacher->name = $input['name'];
        $teacher->age = $input['age'];
        $teacher->save();
        $arr = [
           'status' => true,
           'message' => 'Giáo viên cập nhật thành công',
           'data' => new \App\Http\Resources\Teacher($teacher)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        $arr = [
           'status' => true,
           'message' =>'Giáo viên đã được xóa',
           'data' => [],
        ];
        return response()->json($arr, 200);
    }
}
