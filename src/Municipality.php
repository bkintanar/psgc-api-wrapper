<?php

namespace PSGC;

class Municipality extends Base
{
    protected array $validIncludes = ['barangays'];

    /**
     * Municipality constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resource = 'municipalities';

        $this->class = Resources\Municipality::class;
    }
}
