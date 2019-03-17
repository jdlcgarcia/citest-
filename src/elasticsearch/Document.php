<?php


namespace jdlc\citest\elasticsearch;


class Document
{
    /** @var string */
    private $index;

    /** @var string */
    private $type;

    /** @var string */
    private $id;

    /** @var array */
    private $body;

    /**
     * Document constructor.
     * @param string $index
     * @param string $type
     * @param string $id
     */
    public function __construct(string $index, string $type, string $id)
    {
        $this->index = $index;
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $body
     */
    public function setBody(array $body): void
    {
        $this->body = $body;
    }

    public function export()
    {
        return [
            "index" => $this->index,
            "type" => $this->type,
            "id" => $this->id,
            "body" => $this->body
        ];
    }
}