<?php

namespace PSGC;

class Barangay extends Base
{
    protected array $validIncludes = [];

    /**
     * Barangay constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resource = 'barangays';

        $this->class = Resources\Barangay::class;
    }
}
