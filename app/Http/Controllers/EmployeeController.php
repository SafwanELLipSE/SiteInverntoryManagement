<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use App\Employee_skill;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function createEmployee(Request $request)
    {
        return view("employees.create_employee");
    }
    public function saveCreatedEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'name'   => 'required|min:3',
              'email'  => 'required|email',
              'mobile' => 'required|min:11|max:13',
              'address'=> 'required|min:3',
              'gender' => 'required',
              'nid' => 'required|min:10',
              'city' => 'required|min:3',
              'type_employee' => 'required',
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
                $user->access_level = User::ACCESS_LEVEL_EMPLOYEE;
                $user->password = bcrypt($request->post('password'));
                $user->save();

                $employee = new Employee();

                if($request->photo)
                {
                  $image = $request->file('photo');
                  $new_name = Auth::user()->id . '_' . self::uniqueString() . '.' . $image->getClientOriginalExtension();
                  $image->move(public_path('employee_image'), $new_name);
                  $employee->photo = $new_name;
                }

                $employee->user_id = $user->id;
                $employee->nid_number = $request->post('nid');
                $employee->address = $request->post('address');
                $employee->city = $request->post('city');
                if($request->post('type_employee') == 0)
                {
                   $employee->access_level = Employee::ACCESS_LEVEL_SUPPLIER;
                }
                elseif($request->post('type_employee') == 1)
                {
                   $employee->access_level = Employee::ACCESS_LEVEL_ACCOUNT;
                }
                $employee->created_by = Auth::user()->id;
                $employee->save();

                Alert::success('Success', 'Successfully Created a new Employee');
                return redirect()->route('employee.create');
            }

    }

    public function getEmployeeList(Request $request)
    {
        $employees = Employee::get();
        return view("employees.employee_list",[
          'employees' => $employees,
        ]);
    }
    public function getSupplierList(Request $request)
    {
        $employees = Employee::where('access_level','Supplier')->get();
        return view("employees.supplier_list",[
          'employees' => $employees,
        ]);
    }
    public function getAccountList(Request $request)
    {
        $employees = Employee::where('access_level','Account')->get();
        return view("employees.account_list",[
          'employees' => $employees,
        ]);
    }
    public function detailEmployee(Request $request, $id)
    {
          return view('employees.detail_employee',[
            'employee' => Employee::find($id),
          ]);
    }
    public function deleteEmployee(Request $request)
    {
        $employee_id = $request->post('employee_id');

        $get_employee = Employee::where('id',$employee_id)->first();
        $image_link = $get_employee->photo;
        if($image_link != null)
        {
          $path_image = public_path().'/employee_image/'. $image_link;
          unlink($path_image);
        }

        $user_id = Employee::where('id',$employee_id)->pluck('user_id');
        $delete_user = User::where('id',$user_id)->delete();
        $delete_employee = Employee::where('id',$employee_id)->delete();

        Alert::success('Success', 'Successfully Removed');
        return redirect()->route('employee.all_employees');
    }

    public function editEmployee(Request $request, $id)
    {
      return view('employees.employee_edit',[
        'employee' => Employee::find($id),
      ]);
    }

  public function updateEmployee(Request $request){
    $validator = Validator::make($request->all(), [
          'name'   => 'required|min:3',
          'email'  => 'required|email',
          'mobile' => 'required|min:11|max:13',
          'address'=> 'required|min:3',
          'gender' => 'required',
          'nid' => 'required|min:10',
          'city' => 'required|min:3',
          'type_employee' => 'required',
          'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
      }
      else
      {
          $employeeId = $request->post('employee_id');
          $userId = $request->post('user_id');
          $get_employee = Employee::where('id',$employeeId)->first();
          $image_link = $get_employee->photo;

          $employee = Employee::find($employeeId);
          $employee->nid_number = $request->post('nid');
          $employee->address = $request->post('address');
          $employee->access_level = $request->post('type_employee');
          $employee->city = $request->post('city');
          if($request->photo){
            $path_image = public_path().'/employee_image/'. $image_link;
            unlink($path_image);
          }
          if($request->photo){
                $image = $request->file('photo');
                $new_name = Auth::user()->id . '_' . self::uniqueString() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('employee_image'), $new_name);
                $employee->photo = $new_name;
            }
          $employee->save();

          $user = User::find($userId);
          $user->name = $request->post('name');
          $user->email = $request->post('email');
          $user->mobile_no = $request->post('mobile');
          $user->gender = $request->post('gender');
          $user->save();

          Alert::success('Success', 'Successfully, The employee has been Updated');
          return redirect()->route('employee.edit', $employeeId);
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
