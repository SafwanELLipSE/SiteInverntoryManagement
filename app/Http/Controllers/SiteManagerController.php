<?php

namespace App\Http\Controllers;

use App\User;
use App\Site_manager;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SiteManagerController extends Controller
{
    public function createManager(Request $request)
    {
        return view("managers.create_manager");
    }
    public function saveCreatedManager(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'name'   => 'required|min:3',
              'email'  => 'required|email',
              'mobile' => 'required|min:11|max:13',
              'address'=> 'required|min:3',
              'gender' => 'required',
              'nid' => 'required|min:10',
              'city' => 'required|min:3',
              'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'password'  => 'required|min:5',
              'confirm_password' => 'required|same:password'
           ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }
        else
        {
            $user = new User();
            $user->name = $request->post('name');
            $user->email = $request->post('email');
            $user->mobile_no = $request->post('mobile');
            $user->gender = $request->post('gender');
            $user->access_level = User::ACCESS_LEVEL_SITE_MANAGER;
            $user->password = bcrypt($request->post('password'));
            $user->save();

            $manager = new Site_manager();

            if($request->photo)
            {
              $image = $request->file('photo');
              $new_name = Auth::user()->id . '_' . self::uniqueString() . '.' . $image->getClientOriginalExtension();
              $image->move(public_path('manager_image'), $new_name);
              $manager->photo = $new_name;
            }

            $manager->user_id = $user->id;
            $manager->nid_number = $request->post('nid');
            $manager->address = $request->post('address');
            $manager->city = $request->post('city');
            $manager->created_by = Auth::user()->id;
            $manager->save();

            Alert::success('Success', 'Successfully Created a new Manager');
            return redirect()->route('manager.create');
        }
    }
    public function getManagerList(Request $request)
    {
        $managers = Site_manager::get();
        return view("managers.manager_list",[
          'managers' => $managers,
        ]);
    }
    public function detailManager(Request $request, $id)
    {
          return view('managers.detail_manager',[
            'manager' => Site_manager::find($id),
          ]);
    }
    public function editManager(Request $request, $id)
    {
      return view('managers.manager_edit',[
        'manager' => Site_manager::find($id),
      ]);
    }

    public function updateManager(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'name'   => 'required|min:3',
              'email'  => 'required|email',
              'mobile' => 'required|min:11|max:13',
              'address'=> 'required|min:3',
              'gender' => 'required',
              'nid' => 'required|min:10',
              'city' => 'required|min:3',
              'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);

          if ($validator->fails()){
              alert()->warning('Error occured',$validator->errors()->all()[0]);
              return redirect()->back()->withInput()->withErrors($validator);
          }
          else
          {
              $managerId = $request->post('manager_id');
              $userId = $request->post('user_id');
              $get_employee = Site_manager::where('id',$managerId)->first();
              $image_link = $get_employee->photo;
              $userId = $get_employee->user_id;

              $manager = Site_manager::find($managerId);
              $manager->nid_number = $request->post('nid');
              $manager->address = $request->post('address');
              $manager->city = $request->post('city');
              if($request->photo){
                $path_image = public_path().'/employee_image/'. $image_link;
                unlink($path_image);
              }
              if($request->photo){
                    $image = $request->file('photo');
                    $new_name = Auth::user()->id . '_' . self::uniqueString() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('manager_image'), $new_name);
                    $manager->photo = $new_name;
                }
              $manager->save();

              $user = User::find($userId);
              $user->name = $request->post('name');
              $user->email = $request->post('email');
              $user->mobile_no = $request->post('mobile');
              $user->gender = $request->post('gender');
              $user->save();

              Alert::success('Success', 'Successfully, The manager has been Updated');
              return redirect()->route('manager.edit', $managerId);
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
