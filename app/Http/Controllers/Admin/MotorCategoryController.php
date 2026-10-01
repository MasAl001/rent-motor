<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMotorCategoryRequest;
use App\Models\MotorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MotorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = MotorCategory::withCount('motors')->latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
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
    public function store(StoreMotorCategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        MotorCategory::create($validated);

        return back()->with('success', 'Kategori motor berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MotorCategory $motorCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MotorCategory $motorCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MotorCategory $motorCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MotorCategory $motorCategory)
    {
        //
    }
}
