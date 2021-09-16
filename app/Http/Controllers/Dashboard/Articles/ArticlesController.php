<?php

namespace App\Http\Controllers\Dashboard\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Image;
use DataTables;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['hasAnyPermission']);
        $this->middleware(['can:read articles'])->only(['index','articlesTable']);
        $this->middleware(['can:create articles'])->only(['store']);
        $this->middleware(['can:edit articles'])->only(['update']);
        $this->middleware(['can:delete articles'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.articles.create');
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
           'title_en'=>'required|unique:articles,title_en',
           'title_ar'=>'required|unique:articles,title_en',
           'description_en'=>'required',
           'description_ar'=>'required',
           'content_en'=>'required',
           'content_ar'=>'required',
           'mainImg'=>'required|mimes:jpg,jpeg,png,svg,gif|max:10000',
           'coverImg'=>'required|mimes:jpg,jpeg,png,svg,gif|max:10000',
        ]);

        $article = Article::create([
            'title_en'=>$request->title_en,
            'title_ar'=>$request->title_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'content_en'=>$request->content_en,
            'content_ar'=>$request->content_ar,
            'slug'=>str_replace(' ', '-',$request->title_en),
        ]);

        if ($request->hasFile('mainImg'))
        {
            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(80,55);
            $mainImg->save($name.'.jpg');
            $article->addMedia(public_path($name.'.jpg'))->toMediaCollection('small');

            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(540,370);
            $mainImg->save($name.'.jpg');
            $article->addMedia(public_path($name.'.jpg'))->toMediaCollection('thumb');

            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(1920,1080);
            $mainImg->save($name.'.jpg');
            $article->addMedia(public_path($name.'.jpg'))->toMediaCollection('main');
        }

        if ($request->hasFile('coverImg'))
        {
            $name = rand(1000000,9999999);
            $img = $request->file('coverImg');
            $coverImg = Image::make($img)->resize(1920,1080);
            $coverImg->save($name.'.jpg');
            $article->addMedia(public_path($name.'.jpg'))->toMediaCollection('cover');
        }

        return redirect()->route('dashboard.articles.index')->with('success','Your record has been added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('dashboard.articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title_en'=>'required|unique:articles,title_en,'.$article->id,
            'title_ar'=>'required|unique:articles,title_en,'.$article->id,
            'description_en'=>'required',
            'description_ar'=>'required',
            'content_en'=>'required',
            'content_ar'=>'required',
            'mainImg'=>'mimes:jpg,jpeg,png,svg,gif|max:10000',
            'coverImg'=>'mimes:jpg,jpeg,png,svg,gif|max:10000',
        ]);

        $article->update([
            'title_en'=>$request->title_en,
            'title_ar'=>$request->title_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'content_en'=>$request->content_en,
            'content_ar'=>$request->content_ar,
            'slug'=>str_replace(' ', '-',$request->title_en),
        ]);

        if ($request->hasFile('mainImg'))
        {
            $article->clearMediaCollection('small');
            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(80,55);
            $mainImg->save($name.'.jpg');
            $article->addMedia(public_path($name.'.jpg'))->toMediaCollection('small');

            $article->clearMediaCollection('thumb');
            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(540,370);
            $mainImg->save($name.'.jpg');
            $article->addMedia(public_path($name.'.jpg'))->toMediaCollection('thumb');

            $article->clearMediaCollection('main');
            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(1920,1080);
            $mainImg->save($name.'.jpg');
            $article->addMedia(public_path($name.'.jpg'))->toMediaCollection('main');
        }

        if ($request->hasFile('coverImg'))
        {
            $article->clearMediaCollection('cover');
            $name = rand(1000000,9999999);
            $img = $request->file('coverImg');
            $coverImg = Image::make($img)->resize(1920,1080);
            $coverImg->save($name.'.jpg');
            $article->addMedia(public_path($name.'.jpg'))->toMediaCollection('cover');
        }
        return redirect()->route('dashboard.articles.index')->with('success','Your record has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->clearMediaCollection();
        $article->delete();
        return redirect()->route('dashboard.articles.index')->with('success','Your record has been deleted successfully');
    }

    public function articlesTable()
    {
        return Datatables::eloquent(Article::query())
            ->addColumn('action', function ($row){
                return view('dashboard.articles.article-datatable', compact('row'));
            })
            ->addIndexColumn()
            ->toJson();
    }
}
