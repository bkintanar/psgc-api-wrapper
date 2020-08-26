<?php

namespace PSGC\Resources;

class Barangay extends BaseResource
{
    public string $code;

    public string $name;

    public string $urbanRural;

    public int $population;

    public Municipality $municipality;

    public Province $province;

    public Region $region;

    public function __construct($data)
    {
        $this->code       = $data->code;
        $this->name       = $data->name;
        $this->urbanRural = $data->urban_rural;

        if (property_exists($data, 'population')) {
            $this->population = $data->population;
        }

        if (property_exists($data, 'municipality')) {
            $this->municipality = new Municipality($data->municipality);
        }

        if (property_exists($data, 'province')) {
            $this->province = new Province($data->province);
        }

        if (property_exists($data, 'region')) {
            $this->region = new Region($data->region);
        }
    }
}
