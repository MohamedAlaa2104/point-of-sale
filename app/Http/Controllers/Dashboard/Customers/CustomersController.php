<?php

namespace App\Http\Controllers\Dashboard\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Image;
use DataTables;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['hasAnyPermission']);
        $this->middleware(['can:read customers'])->only(['index','customersTable']);
        $this->middleware(['can:create customers'])->only(['store']);
        $this->middleware(['can:edit customers'])->only(['update']);
        $this->middleware(['can:delete customers'])->only(['destroy']);
    }
    public function index()
    {
        //
        return view('dashboard.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.customers.create');
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
            'name_en'=>'required|unique:customers,name_en',
            'name_ar'=>'required|unique:customers,name_ar',
            'mainImg'=>'required|mimes:jpg,jpeg,png,svg,gif|max:10000',
        ]);

        $customer = Customer::create([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
        ]);

        if ($request->hasFile('mainImg'))
        {
            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(190,120);
            $mainImg->save($name.'.jpg');
            $customer->addMedia(public_path($name.'.jpg'))->toMediaCollection('main');
        }


        return redirect()->route('dashboard.customers.index')->with('success','Your record has been added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name_en'=>'required|unique:customers,name_en,'.$customer->id,
            'name_ar'=>'required|unique:customers,name_ar,'.$customer->id,
            'mainImg'=>'mimes:jpg,jpeg,png,svg,gif|max:10000',
        ]);

        $customer->update([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
        ]);

        if ($request->hasFile('mainImg'))
        {
            $customer->clearMediaCollection('main');
            $name = rand(1000000,9999999);
            $img = $request->file('mainImg');
            $mainImg = Image::make($img)->resize(190,120);
            $mainImg->save($name.'.jpg');
            $customer->addMedia(public_path($name.'.jpg'))->toMediaCollection('main');
        }

        return redirect()->route('dashboard.customers.index')->with('success','Your record has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->clearMediaCollection();
        $customer->delete();
        return redirect()->route('dashboard.customers.index')->with('success','Your record has been deleted successfully');
    }

    public function customersTable()
    {
        return Datatables::eloquent(Customer::query())
            ->addColumn('action', function ($row){
                return view('dashboard.customers.customers-datatable', compact('row'));
            })
            ->addIndexColumn()
            ->toJson();
    }
}
