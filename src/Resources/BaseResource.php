<?php

namespace PSGC\Resources;

class BaseResource
{
    protected function initializeProvinces($data)
    {
        if (property_exists($data, 'provinces')) {
            $this->provinces = collect();

            foreach ($data->provinces as $province) {
                $this->provinces->push(new Province($province));
            }
        }
    }

    protected function initializeDistricts($data)
    {
        if (property_exists($data, 'districts')) {
            $this->districts = collect();

            foreach ($data->districts as $district) {
                $this->districts->push(new District($district));
            }
        }
    }

    protected function initializeCities($data)
    {
        if (property_exists($data, 'cities')) {
            $this->cities = collect();

            foreach ($data->cities as $city) {
                $this->cities->push(new City($city));
            }
        }
    }

    protected function initializeMunicipalities($data)
    {
        if (property_exists($data, 'municipalities')) {
            $this->municipalities = collect();

            foreach ($data->municipalities as $municipality) {
                $this->municipalities->push(new Municipality($municipality));
            }
        }
    }

    protected function initializeSubMunicipalities($data)
    {
        if (property_exists($data, 'sub_municipalities')) {
            $this->subMunicipalities = collect();

            foreach ($data->sub_municipalities as $subMunicipality) {
                $this->subMunicipalities->push(new SubMunicipality($subMunicipality));
            }
        }
    }

    protected function initializeBarangays($data)
    {
        if (property_exists($data, 'barangays')) {
            $this->barangays = collect();

            foreach ($data->barangays as $barangay) {
                $this->barangays->push(new Barangay($barangay));
            }
        }
    }
}
