<?php
namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;

class EsService
{
    public $es;
    public $index = "books";

    public $host = "localhost:9200";

    public function __construct()
    {
        $this->es = ClientBuilder::create()
            ->setHosts([$this->host])
            ->build();
    }

    public function all($from = 0, $size = 200)
    {
        $es = $this->es;
        $params['index'] = $this->index;
        $params['size'] = $size;
        $params['from'] = $from;
        try {
            $results = $es->search($params);
            $hits = $results['hits'];
            return $hits;
        } catch (\Exception $ex) {
            \Log::critical($ex);
        }
    }

    public function create($input, $id = null)
    {
        $es = $this->es;
        $params['index'] = $this->index;
        $params['body'] = $input;
        try {
            $result = $es->index($params);
            return array("id" => $result['_id']);
        } catch (\Exception $ex) {
            \Log::critical($ex);
        }
    }

    public function update($id, $input)
    {
        $es = $this->es;
        $params['index'] = $this->index;
        $params['id'] = $id;
        $params['body'] = $input;
        try {
            $retUpdate = $es->update($params);
            return array("id" => $retUpdate['_id']);
        } catch (\Exception $ex) {
            \Log::critical($ex);

        }
    }

    /**
     * delete an entry by es     *
     * @param string $id
     */
    public function deleteById($id)
    {
        $es = $this->es;
        $params['index'] = $this->index;
        $params['id'] = $id;
        try {
            $retDelete = $es->delete($params);
            return array("id" => $retDelete['_id']);
        } catch (\Exception $ex) {
            \Log::critical($ex);
        }
    }
}
