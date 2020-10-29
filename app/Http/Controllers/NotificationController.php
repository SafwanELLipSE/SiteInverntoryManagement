<?php

namespace App\Http\Controllers;
use App\Notification;
use App\User;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function markAllNotification(Request $request,$id)
  {
      $getUser = User::find($id);
      $getUser->unreadNotifications
      ->when($request->input('id'), function ($query) use ($request) {
          return $query->where('id', $request->input('id'));
      })
      ->markAsRead();

      Alert::success('Success', 'Successfully Marked All Notifications');
      return redirect()->back();
  }
}
