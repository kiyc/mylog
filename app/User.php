<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'icon',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const MAX_ICON_SIZE = 200;

    public function logs()
    {
        return $this->hasMany('App\UserLog')->orderBy('date', 'desc');
    }

    private function getIconFilename($tmp_icon)
    {
        $info = pathinfo($tmp_icon);

        for ($i = 0; $i < 100; $i++) {
            $filename = Str::random(16) . '.' . $info['extension'];
            $user = DB::table('users')->where('icon', 'like', "%{$filename}%")->first();
            if (!$user) {
                return $filename;
            }
        }

        throw new Exception('ユーザアイコンのファイル名生成エラー');
    }

    public function saveIcon($icon_tmp_path)
    {
        if (!$icon_tmp_path || !Storage::exists($icon_tmp_path)) {
            throw new Exception('ユーザアイコンの保存エラー');
        }

        $tmp_icon = Storage::get($icon_tmp_path);
        $icon_filename = $this->getIconFilename($icon_tmp_path);

        $directory_path = 'images/icon';
        if (!Storage::disk('public')->exists($directory_path)) {
            Storage::disk('public')->makeDirectory($directory_path);
        }

        $icon_path = $directory_path . '/' . $icon_filename;
        if (Storage::disk('public')->exists($icon_path)) {
            Storage::disk('public')->delete($icon_path);
        }

        if ($this->icon) {
            $icon = str_replace('/storage/', '', $this->icon);
            if (Storage::disk('public')->exists($icon)) {
                Storage::disk('public')->delete($icon);
            }
        }

        Storage::disk('public')->put($icon_path, $tmp_icon);

        $this->icon = '/storage/' . $icon_path;
        $this->save();
    }
}
