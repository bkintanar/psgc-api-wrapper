<?php

namespace PSGC;

class Province extends Base
{
    protected array $validIncludes = ['cities', 'municipalities'];

    /**
     * Province constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resource = 'provinces';

        $this->class = Resources\Province::class;
    }
}
