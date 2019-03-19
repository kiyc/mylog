<?php
declare(strict_types=1);

namespace App;

final class QueryParams
{
    private $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function all()
    {
        return $this->params;
    }
}
