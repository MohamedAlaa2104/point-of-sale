<?php

namespace App\Http\Controllers\Dashboard\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use DataTables;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.payments.index')->with('id', $id);
    }

    public function paymentsTable($id)
    {
        return DataTables::eloquent(Payment::where('contract_id', $id)->orderBy('id', 'desc'))
            ->addColumn('duration', function($row) {
                if ($row->Contract->Category->renting_duration == 0) {
                    $duration = trans('dashboard.day');
                }
                if ($row->Contract->Category->renting_duration == 1) {
                    $duration = trans('dashboard.month');
                }
                if ($row->Contract->Category->renting_duration == 2) {
                    $duration = trans('dashboard.year');
                }
                $duration = $row -> renting_duration . ' ' . $duration;
                return $duration;
            })
            ->addColumn('start', function ($row){
                return date('Y-m-d', strtotime($row->created_at));
            })
            ->addColumn('end', function ($row){
                return date('Y-m-d', strtotime($row->end_at));
            })
            ->addIndexColumn()
            ->toJson();
    }
}
