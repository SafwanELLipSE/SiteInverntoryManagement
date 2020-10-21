<?php

namespace App\Http\Controllers;
use App\Product;
use App\Stock;
use App\Stock_record;
use App\Exports\Stock_record_export;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class StockController extends Controller
{
  public function createStock(Request $request)
  {
      $products = Product::get();
      return view("stocks.create_stock",[
        'products' => $products,
      ]);
  }
  public function saveCreatedStock(Request $request)
  {
      $validator = Validator::make($request->all(), [
            'product'   => 'required',
            'stock_number'   => 'required',
       ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
      }

      $productId = $request->post('product');
      $get_product = Product::where('id',$productId)->first();
      $price = $get_product->buying_price;

      $number_stock = $request->post('stock_number');

      $inserted_stock = Stock::where('product_id',$productId)->first();

      if($inserted_stock === NULL){
          $stock = new Stock();
          $stock->product_id = $productId;
          $stock->reserve_number = $number_stock;
          $stock->amount = $price*$number_stock;
          $stock->previous_stock = 0;
          $stock->restock = 0;
          $stock->is_active = Stock::ACTIVE;
          $stock->created_by = Auth::user()->id;
          $stock->save();

          $stock_record = new Stock_record();
          $stock_record->stock_id = $stock->id;
          $stock_record->current_amount = $price*$number_stock;
          $stock_record->current_quantity = $number_stock;
          $stock_record->withdraw_amount = 0;
          $stock_record->withdraw_quantity = 0;
          $stock_record->restock_quantity = 0;
          $stock_record->status = 'created';
          $stock_record->created_by = Auth::user()->id;
          $stock_record->save();
      }
      else{
        Alert::warning('Warning', 'The Product is already added Stock. Please, Try to Update.');
        return redirect()->route('stock.create');
      }

    Alert::success('Success', 'Successfully Created a new Stock');
    return redirect()->route('stock.create');
  }
  public function getStockList(Request $request)
  {
      $stocks = Stock::get();
      $products = Product::get();
      return view("stocks.all_stock_list",[
        'stocks' => $stocks,
        'products' => $products,
      ]);
  }
  public function editStock(Request $request)
  {
        $validator = Validator::make($request->all(), [
              'product' => 'required',
              'stock_number' => 'required',
              'stock_id' => 'required',
         ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $stockID = $request->post('stock_id');
        $productId = $request->post('product');
        $get_product = Product::where('id',$productId)->first();
        $price = $get_product->buying_price;
        $number_stock = $request->post('stock_number');

        $stock = Stock::find($stockID);
        $stock->product_id = $productId;
        $stock->reserve_number = $number_stock;
        $stock->amount = $price*$number_stock;
        $stock->previous_stock = 0;
        $stock->restock = 0;
        $stock->save();

        $stock_record = new Stock_record();
        $stock_record->stock_id = $stockID;
        $stock_record->current_amount = $price*$number_stock;
        $stock_record->current_quantity = $number_stock;
        $stock_record->withdraw_amount = 0;
        $stock_record->withdraw_quantity = 0;
        $stock_record->restock_quantity = 0;
        $stock_record->status = 'edited';
        $stock_record->created_by = Auth::user()->id;
        $stock_record->save();

        Alert::success('Success', 'Successfully Updated');
        return redirect()->route('stock.all_stocks');

  }
  public function updateStock(Request $request)
  {
        $validator = Validator::make($request->all(), [
              'withdraw_number'   => 'required',
              'stock_id' => 'required'
         ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $stockID = $request->post('stock_id');
        $withdraw_stock = $request->post('withdraw_number');

        $get_stock = Stock::where('id',$stockID)->first();
        $productId = $get_stock->product_id;
        $reserve_product = $get_stock->reserve_number;

        $get_product = Product::where('id',$productId)->first();
        $price = $get_product->buying_price;

        $leftover = $reserve_product - $withdraw_stock;

        $stock = Stock::find($stockID);
        $stock->reserve_number = $leftover;
        $stock->amount = $price*$leftover;
        $stock->previous_stock = $withdraw_stock;
        $stock->save();

        $stock_record = new Stock_record();
        $stock_record->stock_id = $stockID;
        $stock_record->current_amount = $price*$leftover;
        $stock_record->current_quantity = $leftover;
        $stock_record->withdraw_amount = $price*$withdraw_stock;
        $stock_record->withdraw_quantity = $withdraw_stock;
        $stock_record->restock_quantity = $get_stock->restock;
        $stock_record->status = 'withdraw';
        $stock_record->created_by = Auth::user()->id;
        $stock_record->save();

        Alert::success('Success', 'Successfully Withdraw from the Stock');
        return redirect()->route('stock.all_stocks');
  }
  public function reStockStock(Request $request)
  {
      $validator = Validator::make($request->all(), [
            'restock_number' => 'required',
            'stock_id' => 'required'
       ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
      }

      $stockID = $request->post('stock_id');
      $restock_stock = $request->post('restock_number');

      $get_stock = Stock::where('id',$stockID)->first();
      $productId = $get_stock->product_id;
      $reserve_product = $get_stock->reserve_number;

      $get_product = Product::where('id',$productId)->first();
      $price = $get_product->buying_price;

      $resupply = $reserve_product + $restock_stock;

      $stock = Stock::find($stockID);
      $stock->reserve_number = $resupply;
      $stock->amount = $price*$resupply;
      $stock->restock = $restock_stock;
      $stock->save();

      $stock_record = new Stock_record();
      $stock_record->stock_id = $stockID;
      $stock_record->current_amount = $price*$resupply;
      $stock_record->current_quantity = $resupply;
      $stock_record->withdraw_amount = $price*$get_stock->previous_stock;
      $stock_record->withdraw_quantity = $get_stock->previous_stock;
      $stock_record->restock_quantity = $restock_stock;
      $stock_record->status = 'restock';
      $stock_record->created_by = Auth::user()->id;
      $stock_record->save();

      Alert::success('Success', 'Successfully The Stock has been Re-supplied');
      return redirect()->route('stock.all_stocks');
  }
  public function changeStockStatus(Request $request)
  {
    $validator = Validator::make($request->all(), [
          'stock_status'   => 'required',
          'stock_id' => 'required'
     ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
      }

      $stockID = $request->post('stock_id');
      $get_stock = Stock::where('id',$stockID)->first();
      $status = $get_stock->is_active;

      $given_status = $request->post('stock_status');

      //InActive
      if($status == 1)
      {
        $stock = Stock::find($stockID);
        $stock->is_active = $given_status;
        $stock->save();
        Alert::info('Success', 'Successfully Inactive the Stock');
      }
      //Active
      elseif($status == 0){
        $stock = Stock::find($stockID);
        $stock->is_active = $given_status;
        $stock->save();
        Alert::success('Success', 'Successfully Active the Stock');
      }

      return redirect()->route('stock.all_stocks');
  }
  public function viewStockRecord(Request $request, $id)
  {
      $stock_records =  Stock_record::where('stock_id',$id)->get();
      $get_stock = Stock::where('id',$id)->first();
      $productName = $get_stock->product->name;

      return view("stocks.stock_record_product",[
        'stock_records' => $stock_records,
        'productName' => $productName,
        'id' => $id,
      ]);
  }
  public function excelReport(Request $request, $id)
  {
     return (new Stock_record_export($id))->download('record_stock_' . $id . '.xlsx');;
  }
}
