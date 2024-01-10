<?php

namespace App\Traits;

use Elastic\Elasticsearch\Client;
use App\Observers\ElasticsearchObserver;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

trait Searchable
{
    protected static $elasticsearchClient;


    public static function bootSearchable()
    {
        static::$elasticsearchClient = app(Client::class);
        static::observe(ElasticsearchObserver::class);
    }

    public static function search(String $query, array $fields)
    {
        static::$elasticsearchClient = app(Client::class);

        $items = static::$elasticsearchClient->search([
            'index' => (new self())->getTable(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => $fields,
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return static::buildCollection($ids);
    }


    private static function buildCollection(array $ids): Collection
    {

        return get_called_class()::findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids);
            });
    }

    public function elasticsearchIndex(Client $elasticsearchClient)
    {
        $elasticsearchClient->index([
            'index' => $this->getTable(),
            'type' => '_doc',
            'id' => $this->getKey(),
            'body' => $this->toElasticsearchDocumentArray(),
        ]);
    }

    public function elasticsearchDelete(Client $elasticsearchClient)
    {
        $elasticsearchClient->delete([
            'index' => $this->getTable(),
            'type' => '_doc',
            'id' => $this->getKey(),
        ]);
    }
    abstract public function toElasticsearchDocumentArray(): array;
}
