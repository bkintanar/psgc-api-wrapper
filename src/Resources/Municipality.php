<?php

namespace PSGC\Resources;

use Illuminate\Support\Collection;

class Municipality extends BaseResource
{
    public string $code;

    public string $name;

    public string $incomeClass;

    public int $population;

    public Collection $barangays;

    public Province $province;

    public District $district;

    public Region $region;


    public function __construct($data)
    {
        $this->code        = $data->code;
        $this->name        = $data->name;
        $this->incomeClass = $data->income_class;
        $this->population  = $data->population;

        $this->initializeBarangays($data);

        if (property_exists($data, 'province')) {
            $this->province = new Province($data->province);
        }

        if (property_exists($data, 'district')) {
            $this->district = new District($data->district);
        }

        if (property_exists($data, 'region')) {
            $this->region = new Region($data->region);
        }
    }
}
