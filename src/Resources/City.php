<?php

namespace PSGC\Resources;

use Illuminate\Support\Collection;

class City extends BaseResource
{
    public string $code;

    public string $name;

    public string $cityClass;

    public string $incomeClass;

    public int $population;

    public Collection $barangays;

    public Collection $subMunicipalities;

    public Province $province;

    public Region $region;

    public function __construct($data)
    {
        $this->code        = $data->code;
        $this->name        = $data->name;
        $this->cityClass   = $data->city_class;
        $this->incomeClass = $data->income_class;
        $this->population  = $data->population;

        $this->initializeBarangays($data);
        $this->initializeSubMunicipalities($data);

        if (property_exists($data, 'province')) {
            $this->province = new Province($data->province);
        }

        if (property_exists($data, 'region')) {
            $this->region = new Region($data->region);
        }
    }
}
