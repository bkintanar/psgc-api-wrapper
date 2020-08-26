<?php

namespace PSGC;

class SubMunicipality extends Base
{
    protected array $validIncludes = ['barangays'];

    /**
     * SubMunicipality constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resource = 'sub-municipalities';

        $this->class = Resources\SubMunicipality::class;
    }
}
