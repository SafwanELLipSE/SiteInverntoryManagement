<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\Employee;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
  public function createProduct(Request $request)
  {
    $categories = Category::get();
    $employees = Employee::where('access_level','Supplier')->get();
    return view("products.create_product",[
      'categories' => $categories,
      'employees' => $employees,
    ]);
  }
  public function saveCreatedProduct(Request $request)
  {
      $validator = Validator::make($request->all(), [
            'name'   => 'required|min:3',
            'code'   => 'required|min:3',
            'category'   => 'required',
            'brand'   => 'required',
            'employee'   => 'required',
            'garage'   => 'required|min:3',
            'route'   => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'buy_date'   => 'required',
            'expire_date'   => 'required',
            'buying_price'   => 'required',
            'selling_price'   => 'required',
         ]);

        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else
        {
            $product = new Product();

            if($request->photo)
            {
              $image = $request->file('photo');
              $new_name = Auth::user()->id . '_' . self::uniqueString() . '.' . $image->getClientOriginalExtension();
              $image->move(public_path('product_image'), $new_name);
              $product->image = $new_name;
            }

            $product->name = $request->post('name');
            $product->code = $request->post('code');
            $product->category_id = $request->post('category');
            $product->brand_id = $request->post('brand');
            $product->employee_id = $request->post('employee');
            $product->garage = $request->post('garage');
            $product->route = $request->post('route');
            $product->expire_date = $request->post('expire_date');
            $product->buy_date = $request->post('buy_date');
            $product->buying_price = $request->post('buying_price');
            $product->selling_price = $request->post('selling_price');
            $product->created_by = Auth::user()->id;
            $product->save();

            Alert::success('Success', 'Successfully Created a new Product');
            return redirect()->route('product.create');
        }
  }
  public function getProductList(Request $request)
  {
      $products = Product::get();
      return view("products.product_list",[
          'products' => $products,
      ]);
  }

  public function detailProduct(Request $request, $id)
  {
        return view('products.product_detail',[
            'product' => Product::find($id),
        ]);
  }

  public function editProduct(Request $request, $id)
  {
      $categories = Category::get();
      $employees = Employee::get();
      return view('products.product_edit',[
          'product' => Product::find($id),
          'categories' => $categories,
          'employees' => $employees,
      ]);
  }

  public function updateProduct(Request $request)
  {
    $validator = Validator::make($request->all(), [
          'name'   => 'required|min:3',
          'code'   => 'required|min:3',
          'category'   => 'required',
          'brand'   => 'required',
          'supplier'   => 'required',
          'garage'   => 'required|min:3',
          'route'   => 'required',
          'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'buy_date'   => 'required',
          'expire_date'   => 'required',
          'buying_price'   => 'required',
          'selling_price'   => 'required',
          'product_id' => 'required',
       ]);

      if($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }
        else
        {
            $productId = $request->post('product_id');
            $get_product = Product::where('id',$productId)->first();
            $image_link = $get_product->image;

            $product = Product::find($productId);

            if($request->image)
            {
              $path_image = public_path().'/product_image/'. $image_link;
              unlink($path_image);
            }
            if($request->image)
            {
                $image = $request->file('image');
                $new_name = Auth::user()->id . '_' . self::uniqueString() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_image'), $new_name);
                $product->image = $new_name;
            }

            $product->name = $request->post('name');
            $product->code = $request->post('code');
            $product->category_id = $request->post('category');
            $product->brand_id = $request->post('brand');
            $product->employee_id = $request->post('employee');
            $product->garage = $request->post('garage');
            $product->route = $request->post('route');
            $product->expire_date = $request->post('expire_date');
            $product->buy_date = $request->post('buy_date');
            $product->buying_price = $request->post('buying_price');
            $product->selling_price = $request->post('selling_price');
            $product->created_by = Auth::user()->id;
            $product->save();

            Alert::success('Success', 'Successfully, Product has been Updated');
            return redirect()->route('product.edit',$productId);
        }

  }
  private function uniqueString()
  {
      $m = explode(' ', microtime());
      list($totalSeconds, $extraMilliseconds) = array($m[1], (int)round($m[0] * 1000, 3));
      $txID = date('YmdHis', $totalSeconds) . sprintf('%03d', $extraMilliseconds);
      $txID = substr($txID, 2, 15);
      return $txID;
  }
}
