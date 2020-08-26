<?php

namespace PSGC;

class District extends Base
{
    protected array $validIncludes = ['cities'];

    /**
     * District constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resource = 'districts';

        $this->class = Resources\District::class;
    }
}
