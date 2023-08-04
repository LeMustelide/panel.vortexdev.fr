<?php

// src/Document/aqgLog.php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Log
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $status;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $url;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $timestamp;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $apiKey;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $signature;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $method;

    /**
     * @MongoDB\Field(type="hash")
     */
    protected $content;

    //public function
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function contentToString(): ?string
    {
        $string = '';
        foreach($this->content as $key => $value){
            if(!is_array($value)){
                $string = $string.$key.':'.$value.' ';
            }
            
        }
        return $string;
    }
}