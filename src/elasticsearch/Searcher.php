<?php


namespace jdlc\citest\elasticsearch;


class Searcher
{
    /** @var string  */
    private $index;

    /** @var string  */
    private $type;


    /**
     * Searcher constructor.
     * "index", "type", "field", "value"
     * @param $index string
     * @param $type string
     */
    public function __construct($index, $type)
    {
        $this->index = $index;
        $this->type = $type;
    }

    public function getSearchInBodyParams(string $field, string $value)
    {
        return [
            'index' => $this->index,
            'type' => $this->type,
            'body' => [
                'query' => [
                    'match' => [
                        $field => $value
                    ]
                ]
            ]
        ];
    }
}