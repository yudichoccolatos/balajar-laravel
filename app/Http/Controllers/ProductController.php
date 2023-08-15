<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth:api', ['except'=>'index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
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
        $validator = Validator::make($request->all(), [
            'id_kategori'   => 'required',
            'id_subkategori' =>'required',
            'deskripsi'     =>'required',
            'nama_barang' =>'required',
            'harga'     =>'required',
            'diskon' =>'required',
            'bahan'     =>'required',
            'tags' =>'required',
            'sku'     =>'required',
            'ukuran' =>'required',
            'warna'     =>'required',
            'gambar'        => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->error(), 422
            );
        }
        $input = $request->all();
        if ($request->has('gambar')){
            $gambar = $request->file('gambar');
            $nama_gambar = time().rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads', $nama_gambar);
            $input['gambar'] = $nama_gambar;
        }

        $Product = Product::create($input);
        return response()->json([
            'data' => $Product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $Product)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori'   => 'required',
            'id_subkategori' =>'required',
            'deskripsi'     =>'required',
            'nama_barang' =>'required',
            'harga'     =>'required',
            'diskon' =>'required',
            'bahan'     =>'required',
            'tags' =>'required',
            'sku'     =>'required',
            'ukuran' =>'required',
            'warna'     =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->error(), 422
            );
        }
        $input = $request->all();
        if ($request->has('gambar')){
            File::delete('uploads/' . $Product->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time().rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads', $nama_gambar);
            $input['gambar'] = $nama_gambar;
        }
        else {
            unset($input['gambar']);
        }
        $Product->update($input);

        return response()->json([
            'message'   =>'Update Success',
            'data'      => $Product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $Product)
    {
        File::delete('uploads/' . $Product->gambar);
        $Product->delete();

        return response()->json([
            'message'=>'success'
        ]);
    }
}
