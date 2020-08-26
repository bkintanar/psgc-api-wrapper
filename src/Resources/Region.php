<?php

namespace PSGC\Resources;

use Illuminate\Support\Collection;

class Region extends BaseResource
{
    public string $code;

    public string $name;

    public int $population;

    public Collection $provinces;

    public Collection $districts;

    public function __construct($data)
    {
        $this->code       = $data->code;
        $this->name       = $data->name;
        $this->population = $data->population;

        $this->initializeProvinces($data);
        $this->initializeDistricts($data);
    }
}
