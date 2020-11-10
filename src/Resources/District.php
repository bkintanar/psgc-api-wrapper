<?php

namespace PSGC\Resources;

use Illuminate\Support\Collection;

class District extends BaseResource
{
    public string $code;

    public string $name;

    public int $population;

    public Collection $cities;

    public Collection $municipalities;

    public Region $region;

    public function __construct($data)
    {
        $this->code       = $data->code;
        $this->name       = $data->name;
        $this->population = $data->population;

        $this->initializeCities($data);
        $this->initializeMunicipalities($data);

        if (property_exists($data, 'region')) {
            $this->region = new Region($data->region);
        }
    }
}
