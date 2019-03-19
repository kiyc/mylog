<?php
declare(strict_types=1);

namespace App;

use App\GetUserLogsQueryPort;
use App\UserLog;
use App\UserLogCollection;

final class GetUserLogsAdapter implements GetUserLogsQueryPort
{
    private $user_log;

    public function __construct(UserLog $user_log)
    {
        $this->user_log = $user_log;
    }

    public function getUserLogs(QueryParams $query_params): UserLogCollection
    {
        return new UserLogCollection($this->user_log->search($query_params->all())->get());
    }
}