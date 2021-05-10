<?php

namespace PSGC;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PSGC\Exceptions\IncludeNotValidException;

class Base
{
    protected Client $client;

    protected array $includes = [];

    protected array $validIncludes = [];

    protected string $resource = '';

    protected string $class = '';

    protected string $endpoint = '';

    public int $page = 1;

    protected $perPage = 15;

    /**
     * Base constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://bkintanar-psgc.herokuapp.com/api/']);
    }

    /**
     * @param $code
     *
     * @throws IncludeNotValidException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function find($code)
    {
        $this->endpoint = "{$this->resource}/{$code}";

        return $this->request();
    }

    /**
     * @param array|string $includes
     *
     * @return Base
     */
    public function includes($includes = []): Base
    {
        if (! is_array($includes)) {
            $includes = [$includes];
        }

        $this->includes = $includes;

        return $this;
    }

    /**
     * @throws IncludeNotValidException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function get()
    {
        $this->endpoint = $this->resource;
        $this->perPage = 'all';

        return $this->request();
    }

    public function first()
    {
        $response = $this->get();

        if ($response) {
            return $response->first();
        }

        return collect();
    }

    /**
     * @throws IncludeNotValidException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    private function request()
    {
        $this->validateIncludes();

        $query = $this->buildQueryParams();

        try {
            $response = $this->client->request('GET', $this->endpoint, compact('query'));

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents())->data;

                if (is_array($data)) {
                    $result = collect();
                    foreach ($data as $item) {
                        $result->push(new $this->class($item));
                    }

                    return $result->sortBy('code');
                }

                return new $this->class($data);
            }
        } catch (GuzzleException $e) {
            if ($e->getCode() == 404) {
                return collect();
            }
        }
    }

    /**
     * @throws IncludeNotValidException
     *
     * @return void
     */
    private function validateIncludes(): void
    {
        if (empty($this->includes)) {
            return;
        }

        foreach ($this->includes as $include) {
            if (! in_array($include, $this->validIncludes)) {
                throw new IncludeNotValidException("\"{$include}\" is not a valid includes for the resource \"{$this->resource}\". Valid includes for \"{$this->resource}\" are: " . implode(', ', $this->validIncludes));
            }
        }
    }

    /**
     * @return string
     */
    private function buildQueryParams(): string
    {
        return http_build_query(array_filter(['include' => implode(',', $this->includes), 'page' => $this->page, 'per_page' => $this->perPage]));
    }
}
