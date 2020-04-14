<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $orderValues = $this->validateOrder();
        $order = Order::create($orderValues['order']);
        $order->syncProducts($orderValues['products'], request()->get('stock_exception'));

        if(request()->ajax()) return response()->json([], 200);
        return redirect('/administracion/pedidos')->with(['info' => 'Se ha guardado con éxito.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view("admin.orders.edit", compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
      $orderValues = $this->validateOrder($order->products);
      $order->update($orderValues['order']);
      $order->syncProducts($orderValues['products'], request()->get('stock_exception'));

      if(request()->ajax()) return response()->json([], 200);
      return back()->with(['info' => 'Se ha guardado con éxito.']);
    }

    /**
     * Update Order Status
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Order $order)
    {
        $request = request()->validate(['status' => 'required|in:1,2,3,4']);
        $order->update(['status' => $request['status']]);

        return back()->with(['info' => "Se ha actualizado el estado a #{$order->status_label} del pedido #{$order->id}"]);
    }

    /**
     * Retrieve Products of a Order
     *
     * @return collection (Json)
     */
    public function getProducts(Order $order)
    {
      return response()->json(['products' => $order->products], 200);
    }

    /**
     * Retrieve requested products values array
     *
     * @return array
     */
    public function validateProductsStock($storedOrderProducts)
    {
      $orderProducts = collect(request()->get('products', []));
      $products = Product::whereIn('id', $orderProducts->pluck('id'))->get();
      $results = ['products' => [], 'stockValidations' => []];

      foreach ($orderProducts as $index => $orderProduct) {
        $product = $storedOrderProducts && $storedOrderProducts->firstWhere('id', $orderProduct['id'])
          ? $storedOrderProducts->firstWhere('id', $orderProduct['id'])
          : $products->firstWhere('id', $orderProduct['id']);
        if(!$product) continue;
        $results['stockValidations']["products.{$index}.quantity"] = 'required|numeric|min:1' .
        (
          !request()->get('stock_exception', false)
          && $product->validate_stock
          ? "|max:{$product->available_stock}"
          : ''
        );
        $results['products'][$product->id] = ['quantity' => $orderProduct['quantity'], 'buyed_price' => floatval($product->price)];
      }

      return $results;
    }


    /**
     * Validate request for store or update
     *
     * @return array of attributes
     */
    public function validateOrder($storedOrderProducts = false)
    {
      $productAttributes = $this->validateProductsStock($storedOrderProducts);

      $validateAttributes = array_merge(
        [
          'name' => 'required',
          'email' => 'required|email',
          'phone' => 'required',
          'address' => 'required',
          'additional_info' => 'sometimes',
          'status' => 'required|in:1,2,3,4',
          'products' => 'required',
          'products.*.id' => 'required|exists:products,id'
        ],
        $productAttributes['stockValidations']
      );

      return ['order' => request()->validate($validateAttributes), 'products' => $productAttributes['products']];
    }

}
