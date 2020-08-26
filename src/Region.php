<?php

namespace PSGC;

class Region extends Base
{
    protected array $validIncludes = ['provinces', 'districts'];

    /**
     * Region constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resource = 'regions';

        $this->class = Resources\Region::class;
    }
}
