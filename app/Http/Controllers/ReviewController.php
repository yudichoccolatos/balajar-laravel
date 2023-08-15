<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();

        return response()->json($reviews);
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
            'id_member'=>'required',
            'id_produk'=>'required',
            'review'=>'required',
            'rating'=>'required'
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

        $Review = Review::create($input);
        return response()->json([
            'data' => $Review
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $Review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (Review $Review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $Review)
    {
        $validator = Validator::make($request->all(), [
            'id_member'=>'required',
            'id_produk'=>'required',
            'review'=>'required',
            'rating'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->error(), 422
            );
        }
        $input = $request->all();
        if ($request->has('gambar')){
            File::delete('uploads/' . $Review->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time().rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads', $nama_gambar);
            $input['gambar'] = $nama_gambar;
        }
        else {
            unset($input['gambar']);
        }
        $Review->update($input);

        return response()->json([
            'message'   =>'Update Success',
            'data'      => $Review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $Review)
    {
        $Review->delete();

        return response()->json([
            'message'=>'success'
        ]);
    }
}
