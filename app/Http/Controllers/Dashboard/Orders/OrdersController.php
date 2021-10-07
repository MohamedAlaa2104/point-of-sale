<?php

namespace App\Http\Controllers\Dashboard\Orders;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['hasAnyPermission']);
        $this->middleware(['can:read orders'])->only(['index','ordersTable', 'show']);
        $this->middleware(['can:delete orders'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('dashboard.orders.show', compact('order'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('dashboard.orders.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $customer = Customer::findOrFail( $request->customer_id );

        $order = $customer->Orders()->create();

        $total_price = 0;

        foreach ($request->products as $index=>$product) {

            $product = Product::findOrFail($product);

            $order->Products()->attach($product, ['amount'=>$request->amount[$index], 'price'=>$product->sell_price]);

            $total_price += ($product->sell_price * $request->amount[$index]);

            $product->update(['stock'=>$product->stock - $request->amount[$index]]);

        }

        $order->update(['total_price'=>$total_price]);

        session()->flash('done', trans('dashboard.success_add'));

        return redirect()->route('dashboard.order.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Your record has been deleted!');
    }

    public function ordersTable()
    {
        return DataTables::eloquent(Order::with('products', 'Client')->orderBy('id', 'desc'))
            ->addColumn('action', function($row) {
                return view('dashboard.orders.action')->with('row', $row);
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function productsTable()
    {
        return DataTables::eloquent(Product::with('translation')->when(request()->category_id, function ($q) {
            return $q->where('category_id',request()->category_id );
        }))
            ->addColumn('button', function ($row){
                return '<a id="btn-'.$row->id.'" class="add-product btn btn-success btn-sm" data-id="' .$row->id. '" data-name="'.$row->translate( app()->getLocale() )->name.'" data-price="'.$row->sell_price.'"><i class="fa fa-plus"></i></a>';
            })
            ->rawColumns(['button'])
            ->addIndexColumn()
            ->toJson();
    }
}
