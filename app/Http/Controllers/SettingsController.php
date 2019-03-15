<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadUserIcon;
use App\Http\Requests\UpdateUser;
use App\User;
use Auth;
use DB;
use Storage;
use Image;

class SettingsController extends Controller
{
    public function index()
    {
        return response()->json(['user' => Auth::user()]);
    }

    public function uploadIcon(UploadUserIcon $request)
    {
        $path = $request->icon->store('tmp/images/icon');
        $icon = Image::make(storage_path('app/') . $path)->orientate();
        if ($icon->width() > $icon->height()) {
            if ($icon->width() > User::MAX_ICON_SIZE) {
                $icon->resize(User::MAX_ICON_SIZE, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        } else {
            if ($icon->height() > User::MAX_ICON_SIZE) {
                $icon->resize(null, User::MAX_ICON_SIZE, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        }
        $icon->save();

        return response()->json([
            'icon' => [
                'path'  => $path,
                'image' => 'data:image/'
                    . $request->icon->getClientOriginalExtension()
                    . ';base64,'
                    . base64_encode(Storage::get($path))
            ]
        ]);
    }

    public function update(UpdateUser $request)
    {
        $data = $request->all();
        $user = Auth::user();

        DB::transaction(function () use ($user, $data) {
            $user->fill($data);

            if (array_get($data, 'reset_icon') && $user->icon) {
                $icon = str_replace('/storage/', '', $user->icon);
                if (Storage::disk('public')->exists($icon)) {
                    Storage::disk('public')->delete($icon);
                }
                $user->icon = null;
            }

            $user->save();

            if (!array_get($data, 'reset_icon') && array_get($data, 'new_icon')) {
               $user->saveIcon($data['new_icon']);
            }
        });

        return response()->json(['user' => Auth::user()]);
    }
}
