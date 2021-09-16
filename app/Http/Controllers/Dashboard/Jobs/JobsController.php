<?php

namespace App\Http\Controllers\Dashboard\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\Request;
use Image;
use DataTables;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['hasAnyPermission']);
        $this->middleware(['can:read jobs'])->only(['index','jobsTable', 'showApplicant', 'applicantsTable', 'showCV']);
        $this->middleware(['can:create jobs'])->only(['store']);
        $this->middleware(['can:edit jobs'])->only(['update']);
        $this->middleware(['can:delete jobs'])->only(['destroy', 'deleteApplicant']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.jobs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jobs.create');
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
            'title_en'=>'required',
            'title_ar'=>'required',
            'content_ar'=>'required',
            'content_en'=>'required',
            'active'=>'required',
            'mainImg'=>'required|mimes:jpg,png,jpeg,gif,svg|max:10000',
        ]);

        $job = Job::create([
            'title_en'=>$request->title_en,
            'title_ar'=>$request->title_ar,
            'small_description_en'=>$request->small_description_en,
            'small_description_ar'=>$request->small_description_ar,
            'content_en'=>$request->content_en,
            'content_ar'=>$request->content_ar,
            'active'=>$request->active,
            'slug'=>str_replace(' ', '-',$request->title_en),
        ]);

        if ($request->hasFile('mainImg'))
        {
            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(1920,1080);
            $mainImg->save($name.'.jpg');
            $job->addMedia(public_path($name.'.jpg'))->toMediaCollection('cover');
        }

        return redirect()->route('dashboard.jobs.index')->with('success', 'Your record has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('dashboard.jobs.show')->with('job',$job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('dashboard.jobs.edit')->with('job',$job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title_en'=>'required|unique:jobs,title_en,'.$job->id,
            'title_ar'=>'required',
            'content_ar'=>'required',
            'content_en'=>'required',
            'active'=>'required',
            'mainImg'=>'mimes:jpg,png,jpeg,gif,svg|max:10000',
        ]);

        $job->update([
            'title_en'=>$request->title_en,
            'title_ar'=>$request->title_ar,
            'small_description_en'=>$request->small_description_en,
            'small_description_ar'=>$request->small_description_ar,
            'content_en'=>$request->content_en,
            'content_ar'=>$request->content_ar,
            'active'=>$request->active,
            'slug'=>str_replace(' ', '-',$request->title_en),
        ]);

        if ($request->hasFile('mainImg'))
        {
            $job->clearMediaCollection('main');
            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(1920,1080);
            $mainImg->save($name.'.jpg');
            $job->addMedia(public_path($name.'.jpg'))->toMediaCollection('cover');
        }

        return redirect()->route('dashboard.jobs.index')->with('success', 'Your record has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->clearMediaCollection();
        $job->delete();
        return redirect()->route('dashboard.jobs.index')->with('success', 'Your record has been deleted successfully');
    }

    public function showApplicant(Applicant $applicant)
    {
        return view('dashboard.jobs.show-applicant', compact('applicant'));
    }

    public function showCV(Applicant $applicant)
    {
        return response()->file($applicant->getFirstMediaPath('cv'));
    }

    public function jobsTable()
    {
        return DataTables::eloquent(Job::query())
            ->addColumn('action', function ($row){
                return view('dashboard.jobs.jobs-datatable')->with('row',$row);
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function applicantsTable($id)
    {
        return DataTables::eloquent(Applicant::where('job_id', $id))
            ->addColumn('action', function ($row){
                return view('dashboard.jobs.applicants-datatable')->with('row',$row);
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function deleteApplicant (Applicant $applicant)
    {
        $applicant->clearMediaCollection('cv');
        $applicant->delete();
        return back()->with('success', 'The record has been deleted successfully');
    }
}
