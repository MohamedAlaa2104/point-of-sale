<?php

namespace App\Http\Controllers\Dashboard\CategoryController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\Rule;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return Category::with('translation')->first();
        return view('dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'en.name'=>'required|unique:category_translations,name',
            'ar.name'=>'required',
            'renting_duration'=>'required',
            'mainImg'=>'required|mimes:jpg,png,jpeg,svg,gif|max:10000',
        ]);
        $request['slug'] = str_replace(' ', '-', $request->en['name']);

        $agency =  Category::create($request->all());

        if ($request->hasFile('mainImg'))
        {
            $name = rand(1000000,9999999);
            $img = Image::make($request->file('mainImg'))->resize(640,480);
            $img->save($name.'.jpg');
            $agency->addMedia(public_path($name.'.jpg'))->toMediaCollection('main');
        }


        return redirect()->route('dashboard.category.index')->with('success', 'You record has been added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'en.name'=>['required',Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')],
            'ar.name'=>['required',Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')],
            'renting_duration'=>'required',
            'mainImg'=>'mimes:jpg,png,jpeg,svg,gif|max:10000',
        ]);

        $request['slug'] = str_replace(' ', '-', $request->name_en);


        $category->update($request->all());

        if ($request->hasFile('mainImg'))
        {
            $category->clearMediaCollection('main');
            $name = rand(1000000,9999999);
            $img = Image::make($request->file('mainImg'))->resize(640,480);
            $img->save($name.'.jpg');
            $category->addMedia(public_path($name.'.jpg'))->toMediaCollection('main');
        }
        return redirect()->route('dashboard.category.index')->with('success', 'You record has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->clearMediaCollection();
        $category->delete();
        return back()->with('success', 'Your record has been deleted successfully');
    }

    public function CategoryTable()
    {
        return DataTables::eloquent(Category::with('translation'))
            ->addColumn('action', function ($row){
                return view('dashboard.category.agency-datatable', compact('row'));
            })
            ->addIndexColumn()
            ->toJson();
    }
}
