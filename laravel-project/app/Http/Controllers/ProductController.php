<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Validator;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $arr = [
        'status' => true,
        'message' => "Danh sách sản phẩm",
        'data'=>\App\Http\Resources\Product::collection($products)
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
          'name' => 'required', 'price' => 'required'
        ]);
        if($validator->fails()){
           $arr = [
             'success' => false,
             'message' => 'Lỗi kiểm tra dữ liệu',
             'data' => $validator->errors()
           ];
           return response()->json($arr, 200);
        }
        $product = \App\Models\Product::create($input);
        $arr = ['status' => true,
           'message'=>"Sản phẩm đã lưu thành công",
           'data'=> new \App\Http\Resources\Product($product)
        ];
        return response()->json($arr, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
           $arr = [
             'success' => false,
             'message' => 'Không có sản phẩm này',
             'dara' => []
           ];
           return response()->json($arr, 200);
        }
        $arr = [
          'status' => true,
          'message' => "Chi tiết sản phẩm ",
          'data'=> new \App\Http\Resources\Product($product)
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
    public function update(Request $request, string $id){
        $input = $request->all();
        $validator = Validator::make($input, [
           'name' => 'required',
           'price' => 'required'
        ]);
        if($validator->fails()){
           $arr = [
             'success' => false,
             'message' => 'Lỗi kiểm tra dữ liệu',
             'data' => $validator->errors()
           ];
           return response()->json($arr, 200);
        }
        $product = Product::find($id);
        $product->name = $input['name'];
        $product->price = $input['price'];
        $product->save();
        $arr = [
           'status' => true,
           'message' => 'Sản phẩm cập nhật thành công',
           'data' => new \App\Http\Resources\Product($product)
        ];
        return response()->json($arr, 200);
      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        $arr = [
           'status' => true,
           'message' =>'Sản phẩm đã được xóa',
           'data' => [],
        ];
        return response()->json($arr, 200);
    }
}
