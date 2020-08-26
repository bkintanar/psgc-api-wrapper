<?php

namespace PSGC\Resources;

use Illuminate\Support\Collection;

class SubMunicipality extends BaseResource
{
    public string $code;

    public string $name;

    public int $population;

    public Collection $barangays;

    public City $city;

    public District $district;

    public Region $region;

    public function __construct($data)
    {
        $this->code       = $data->code;
        $this->name       = $data->name;
        $this->population = $data->population;

        $this->initializeBarangays($data);

        if (property_exists($data, 'city')) {
            $this->city = new City($data->city);
        }

        if (property_exists($data, 'district')) {
            $this->district = new District($data->district);
        }

        if (property_exists($data, 'region')) {
            $this->region = new Region($data->region);
        }
    }
}
