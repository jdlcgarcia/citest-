<?php


namespace jdlc\citest\elasticsearch;


class Response
{
    private $index;
    private $type;
    private $id;
    private $version;
    private $seqNo;
    private $primaryTerm;
    private $found;
    private $source;

    /**
     * Response constructor.
     * @param $response array
     */
    public function __construct($response)
    {
        if(isset($response['_index'])) {
            $this->index = $response['_index'];
        }
        if(isset($response['_type'])) {
            $this->type = $response['_type'];
        }
        if(isset($response['_id'])) {
            $this->id = $response['_id'];
        }
        if(isset($response['_version'])) {
            $this->version = $response['_version'];
        }
        if(isset($response['_seq_no'])) {
            $this->seqNo = $response['_seq_no'];
        }
        if(isset($response['_primary_term'])) {
            $this->primaryTerm = $response['_primary_term'];
        }
        if(isset($response['found'])) {
            $this->found = $response['found'];
        }
        if(isset($response['_source'])) {
            $this->source = $response['_source'];
        }
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    public function getId()
    {
        return $this->id;
    }


}