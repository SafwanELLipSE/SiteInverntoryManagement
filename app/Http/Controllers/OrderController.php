<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use App\Order_product;
use Cart;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class OrderController extends Controller
{
  public function createPointOfSell(Request $request)
    {
        $products = Product::get();
        return view("sells.cart",[
          'products' => $products,
        ]);
    }
    public function saveCreatedCart(Request $request)
    {
          $data = array();
          $data['id'] = $request->id;
          $data['name'] = $request->name;
          $data['price'] = $request->price;
          $data['qty'] = $request->qty;
          $data['weight'] = $request->qty;
          $add = Cart::add($data);

          if($add) {
            Alert::success('Success', 'Successfully Product Added to Cart');
            return redirect()->route('sell.create');
          }
    }
    public function updateCart(Request $request)
    {
        $rowId = $request->post('id');
        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);

        if($update){
          Alert::success('Success', 'Successfully Cart has been updated');
        }
        return redirect()->route('sell.create');
    }
    public function removeCartItem(Request $request, $rowId)
    {
        $remove = Cart::remove($rowId);

        Alert::success('Success', 'Successfully Item remove from Cart');
        return redirect()->route('sell.create');
    }
    public function invoiceCartItem(Request $request)
    {

      $validator = Validator::make($request->all(), [
            'customer_id'   => 'required',
            'vat_amount'   => 'required',
         ]);
        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }

        $productLists = Cart::content();

        $amount = Cart::subtotal();
        $cut = explode(",",$amount);
        $convert = (int)join("",$cut);

        $order = new Order();
        $order->ref_number = date("YmdHis");
        $order->customer_id = $request->customer_id;
        $order->vat = $request->vat_amount;
        $order->total_amount = $convert+($convert*($request->vat_amount/100));
        $order->created_by = Auth::user()->id;
        $order->save();

        if(count($productLists)){
          foreach($productLists as $item)
          {
              $product = new Order_product();
              $product->order_id = $order->id;
              $product->product_id = $item->id;
              $product->quantity = $item->qty;
              $product->save();
          }
        }

        $customerId = $request->customer_id;
        $vatAmount = $request->vat_amount;
        $customer = Customer::where('id',$customerId)->first();
        return view('sells.invoice',[
          'customer' => $customer,
          'vatAmount' => $vatAmount,
        ]);
    }
    public function getOrderList(Request $request)
    {
        $orders = Order::get();
        return view("sells.order_list",[
          'orders' => $orders,
        ]);
    }
    public function orderInvoice(Request $request,$id)
    {
      $getOrder = Order::where('id',$id)->first();
      $customerId = Order::where('id',$id)->pluck('customer_id');
      $customer = Customer::where('id',$customerId)->first();
      $getProduct = Order_product::where('order_id',$id)->get();

      return view('sells.invoice_main',[
        'getOrder' => $getOrder,
        'customer' => $customer,
        'getProduct' => $getProduct,
      ]);
    }
    public function deleteOrder(Request $request)
    {
          $orderId = $request->post('order_id');
          $delete_product = Order_product::where('order_id',$orderId)->delete();
          $delete_order = Order::where('id',$orderId)->delete();

          Alert::success('Success', 'Successfully Removed');
          return redirect()->route('sell.all_orders');
    }
    public function orderHTMLToPDF(Request $request)
    {
        $id = $request->post('order_id');

        $getOrder = Order::where('id',$id)->first();
        $customerId = Order::where('id',$id)->pluck('customer_id');
        $customer = Customer::where('id',$customerId)->first();
        $getProduct = Order_product::where('order_id',$id)->get();

        $pdf = PDF::loadView('sells.invoice_pdf',[
              'getOrder' => $getOrder,
              'customer' => $customer,
              'getProduct' => $getProduct,
        ])
        ->setPaper('a4');

        return $pdf->download('order_invoice_'.$id.'.pdf');

    }
}
