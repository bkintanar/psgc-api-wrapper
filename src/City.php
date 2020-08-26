<?php

namespace PSGC;

class City extends Base
{
    protected array $validIncludes = ['barangays', 'subMunicipalities'];

    /**
     * City constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resource = 'cities';

        $this->class = Resources\City::class;
    }
}
