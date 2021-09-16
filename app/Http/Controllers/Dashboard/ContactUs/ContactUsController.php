<?php

namespace App\Http\Controllers\Dashboard\ContactUs;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use DataTables;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['hasAnyPermission']);
        $this->middleware(['can:read contactus'])->only(['index','contactUsTable']);
        $this->middleware(['can:delete contactus'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.contactus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = ContactUs::findOrFail($id);
        return view('dashboard.contactus.show')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContactUs::findOrFail($id)->delete();
        return redirect()->route('dashboard.contactus.index')->with('success', 'The message has been deleted successfully');
    }

    public function contactUsTable ()
    {
        return DataTables::eloquent(ContactUs::latest())
            ->addColumn('action', function($row) {
                return view('dashboard.contactus.contactus-datatable')->with('row', $row);
            })
            ->addIndexColumn()
            ->toJson();
    }
}
