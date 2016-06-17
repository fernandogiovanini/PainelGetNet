<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 16:59
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;


use PainelGetNet\AppBundle\Exception\GetNet\FieldNotMappedException;

abstract class AbstractMapper
{
    protected $line;
    protected $mappings;
    protected $mapped;

    protected function addFieldMapping($field, $start, $length)
    {
        $this->mappings[$field] = [
            'start' => $start,
            'length' => $length
        ];
    }

    protected function extractData($field, $line){
        if(!array_key_exists($field, $this->mappings)){
            throw new FieldNotMappedException("O campo $field não foi mapeado");
        }
        return mb_substr($line, $this->mappings[$field]['start'], $this->mappings[$field]['length']);
    }

    protected function extractAllData($line){
        foreach($this->mappings as $field => $mapping){
            $this->mapped[$field] = $this->extractData($field, $line);
        }
    }
}