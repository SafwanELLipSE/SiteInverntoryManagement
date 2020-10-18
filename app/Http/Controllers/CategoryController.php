<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function createCategory(Request $request)
  {
      return view("categories.add_category");
  }
  public function saveCreatedCategory(Request $request)
  {
      $validator = Validator::make($request->all(), [
            'category'   => 'required|min:3',
         ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }

          $category = new Category();
          $category->name = $request->post('category');
          $category->created_by = Auth::user()->id;
          $category->save();

          Alert::success('Success', 'Successfully Created a new Category');
          return redirect()->route('category.create');
  }
  public function deleteCategory(Request $request)
  {
      $category_id = $request->post('category_id');

      $delete_category = Category::where('id',$category_id)->delete();

      Alert::success('Success', 'Successfully Removed, Category from the List');
      return redirect()->route('category.all_categories');
  }
  public function editCategory(Request $request, $id)
  {
    return view('categories.edit_category',[
      'category' => Category::find($id),
    ]);
  }
  public function updateCategory(Request $request){
      $validator = Validator::make($request->all(), [
            'category'   => 'required|min:3',
         ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

        $categoryId = $request->post('category_id');
        $category = Category::find($categoryId);
        $category->name = $request->post('category');
        $category->save();

        Alert::success('Success', 'Successfully Updated');
        return redirect()->route('category.all_categories');

  }
  public function getCategoryList(Request $request)
  {
      $categories = Category::get();
      return view("categories.category_list",[
        'categories' => $categories,
      ]);
  }
}
