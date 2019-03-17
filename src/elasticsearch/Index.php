<?php


namespace jdlc\citest\elasticsearch;


class Index
{
    /** @var string */
    private $name;

    private $settings = [
        'number_of_shards' => 2,
        'number_of_replicas' => 2
    ];

    /**
     * Index constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getCreateParams()
    {
        return [
            'index' => $this->name,
            'body' => [
                'settings' => $this->settings
            ]
        ];
    }
}