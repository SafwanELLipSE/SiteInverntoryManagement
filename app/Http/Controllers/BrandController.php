<?php

namespace App\Http\Controllers;
use App\Category;
use App\Brand;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class BrandController extends Controller
{
  public function createBrand(Request $request)
  {
    $categories = Category::get();
    return view("brands.add_brand",[
      'categories' => $categories,
    ]);
  }
  public function saveCreatedBrand(Request $request)
  {
      $validator = Validator::make($request->all(), [
            'category'   => 'required',
            'brand'   => 'required|min:3',
         ]);

        if($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else
        {
            $new_brand = $request->post('brand');
            $inserted_brand = Brand::where('name',$new_brand)->first();

            if($inserted_brand === NULL)
            {
              $brand = new Brand();
              $brand->name = $new_brand;
              $brand->category_id = $request->post('category');
              $brand->created_by = Auth::user()->id;
              $brand->save();
            }
            else
            {
              Alert::warning('Warning', 'The Brand Name is already added');
              return redirect()->route('brand.create');
            }

            Alert::success('Success', 'Successfully Created a new Brand');
            return redirect()->route('brand.create');
        }
  }
  public function getBrandList(Request $request)
  {
      $brands = Brand::get();
      return view("brands.brand_list",[
        'brands' => $brands,
      ]);
  }
  public function deleteBrand(Request $request)
  {
      $brand_id = $request->post('brand_id');
      $delete_brand = Brand::where('id',$brand_id)->delete();

      Alert::success('Success', 'Successfully Removed, Brand from the List');
      return redirect()->route('brand.all_brands');
  }
  public function editBrand(Request $request, $id)
  {
      $categories = Category::get();
      return view('brands.edit_brand',[
        'brand' => Brand::find($id),
        'categories' => $categories,
      ]);
  }
  public function updateBrand(Request $request){
      $validator = Validator::make($request->all(), [
            'brand'   => 'required',
            'category' => 'required',
         ]);

      if($validator->fails())
      {
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
      }
      else
      {
          $brandId = $request->post('brand_id');
          $brand = Brand::find($brandId);
          $brand->category_id = $request->post('category');
          $brand->name = $request->post('brand');
          $brand->save();

          Alert::success('Success', 'Successfully Updated');
          return redirect()->route('brand.all_brands');
      }
  }
}
