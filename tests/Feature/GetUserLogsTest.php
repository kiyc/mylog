<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\GetUserLogs;
use App\GetUserLogsQueryPort;
use App\QueryParams;
use App\UserLogCollection;

class GetUserLogsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testValid()
    {
        $get_user_logs = new GetUserLogs(
            new class implements GetUserLogsQueryPort
            {
                public function getUserLogs(QueryParams $query_params): UserLogCollection
                {
                    return new UserLogCollection([[
                        'id'         => 1,
                        'user_id'    => 1,
                        'date'       => date('Y-m-d'),
                        'diary'      => 'dummy',
                        'created_at' => date('now'),
                        'updated_at' => date('now'),
                    ]]);
                }
            }
        );

        $user_logs = $get_user_logs->execute(new QueryParams());

        $this->assertEquals(1, $user_logs->count());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEmpty()
    {
        $get_user_logs = new GetUserLogs(
            new class implements GetUserLogsQueryPort
            {
                public function getUserLogs(QueryParams $query_params): UserLogCollection
                {
                    return new UserLogCollection([]);
                }
            }
        );

        $user_logs = $get_user_logs->execute(new QueryParams());

        $this->assertEquals(0, $user_logs->count());
    }
}
