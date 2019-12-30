<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Auth;

class ProductsController extends Controller
{
    public function index() {
        return Product::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request) {


        //file = laravel.log
        //\Log::info($request->all());

        $explod = explode(',', $request->image);
        $decoded =base64_decode($explod[1]);
        if(str_contains($explod[0], 'jpeg'))
            $extension = 'jpeg';
        else
            $extension = 'png';

        $filename = str_random().'.'.$extension;

        $path = public_path().'/'.$filename;

        file_put_contents($path, $decoded);

        $product = Product::create($request->except('image') + [
            'user_id' => Auth::id(),
                'image' => $filename
            ]);
        return $product;
    }

    public function show($id) {

        $product = Product::find($id);

        if(count($product) > 0)
            return response()->json($product);

        return response()->json(['error' => 'Resource not found'], 404);
    }

    public function update(Request $request, $id) {

        $product = Product::find($id);

        $product->update($request->all());

        return response()->json($product);

    }

    public function destroy($id) {

        try {
            Product::destroy($id);
            return response([], 204);
        }
        catch (\Exception $e) {
             return response('problmes to delete file', 500);

        }

    }
}
