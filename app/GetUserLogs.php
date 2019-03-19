<?php
declare(strict_types=1);

namespace App;

final class GetUserLogs
{
    private $query;

    public function __construct(GetUserLogsQueryPort $query)
    {
        $this->query = $query;
    }

    public function execute(QueryParams $query_params): UserLogCollection
    {
        return $this->query->getUserLogs($query_params);
    }
}

interface GetUserLogsQueryPort
{
    public function getUserLogs(QueryParams $query_params): UserLogCollection;
}