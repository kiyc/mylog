<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserLog;
use Auth;
use App\UserLog;
use App\QueryParams;
use App\GetUserLogs;

class UserLogController extends Controller
{
    private $get_user_logs;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GetUserLogs $get_user_logs)
    {
        $this->get_user_logs = $get_user_logs;
    }

    /**
     * ユーザログを返すAPI
     *
     * @return json
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $params['user_id'] = Auth::id();

        $user_logs = $this->get_user_logs->execute(new QueryParams($params));

        return response()->json(compact('user_logs'));
    }

    /**
     * ユーザログを登録するAPI
     *
     * @return json
     */
    public function store(StoreUserLog $request)
    {
        $data = $request->all();

        $user_log = new UserLog();
        $user_log->fill($data);
        $user_log->user_id = Auth::id();
        $user_log->save();

        $user_logs = Auth::user()->logs;

        return response()->json(compact('user_logs'));
    }
}
