<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use App\Order_product;
use Cart;
use App\User;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\OrderNotification;
use App\Notifications\ApprovedNotification;
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
        $productLists = Cart::content();

        $amount = Cart::subtotal();
        $cut = explode(",",$amount);
        $convert = (int)join("",$cut);

        $order = new Order();
        $order->ref_number = date("YmdHis");
        $order->total_amount = $convert;
        $order->status = 0;
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


        // Notify admin
        $user1 = User::where('access_level', 'master_admin')->first();
        $user1->notify(new OrderNotification($order->id));

        $user = User::where('id',Auth::user()->id)->first();
        $userMaster = User::where('access_level','master_admin')->first();
        return view('sells.invoice',[
            'user' => $user,
            'userMaster' => $userMaster,
        ]);
    }
    public function getOrderList(Request $request)
    {
        $orders = Order::get();
        return view("sells.order_list",[
          'orders' => $orders,
        ]);
    }
    public function getApprovedOrderList(Request $request)
    {
        if(Auth::user()->isMasterAdmin())
        {
            $orders = Order::where('status',1)->get();
        }
        elseif(Auth::user()->isSiteManager())
        {
            $orders = Order::where('created_by',Auth::user()->id)->where('status',1)->get();
        }

        return view("sells.order_approved_list",[
            'orders' => $orders,
        ]);
    }
    public function getNotApprovedOrderList(Request $request)
    {
        if(Auth::user()->isMasterAdmin())
        {
            $orders = Order::where('status',0)->get();
        }
        elseif(Auth::user()->isSiteManager())
        {
            $orders = Order::where('created_by',Auth::user()->id)->where('status',0)->get();
        }

        return view("sells.order_not_approved_list",[
            'orders' => $orders,
        ]);
    }
    public function orderInvoice(Request $request,$id)
    {
      $getOrder = Order::where('id',$id)->first();
      $getProduct = Order_product::where('order_id',$id)->get();
      $user = User::where('id',$getOrder->created_by)->first();
      $userMaster = User::where('access_level','master_admin')->first();

      return view('sells.invoice_main',[
        'getOrder' => $getOrder,
        'getProduct' => $getProduct,
        'user' => $user,
        'userMaster' => $userMaster,
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
    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'order_id' => 'required'
         ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else
        {
          $orderID = $request->post('order_id');
          $get_order = Order::where('id',$orderID)->first();
          $status = $get_order->status;
          $userID = $get_order->created_by;

          //Approved
          if($status == 0) // Not Approved
          {
            $order = order::find($orderID);
            $order->status = 1;
            $order->save();
            Alert::info('Success', 'Successfully Approved the Order');

            // Notify Site Manager
            $user1 = User::where('id', $userID)->first();
            $user1->notify(new ApprovedNotification($orderID));
          }
          //Not Approved
          elseif($status == 1)  // Approved
          {
            $order = Order::find($orderID);
            $order->status = 0;
            $order->save();
            Alert::success('Success', 'Successfully Not Approved the Order');
          }

           return redirect()->back();
        }
    }
    public function orderHTMLToPDF(Request $request)
    {
        $id = $request->post('order_id');

        $getOrder = Order::where('id',$id)->first();
        $getProduct = Order_product::where('order_id',$id)->get();
        $user = User::where('id',$getOrder->created_by)->first();

        $pdf = PDF::loadView('sells.invoice_pdf',[
              'getOrder' => $getOrder,
              'getProduct' => $getProduct,
              'user' => $user,
        ])
        ->setPaper('a4');

        return $pdf->download('order_invoice_'.$id.'.pdf');

    }
}
