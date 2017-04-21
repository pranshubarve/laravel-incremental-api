<?php
namespace App\Phoenix\Transformers;

abstract class Transformer {

    /**
     * Transform a collection
     *
     * @param $item
     * @return array
     */
    public function transformCollection($item)
    {
        return array_map([$this, 'transform'], $item);
    }

    /**
     * Transform items
     *
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);

}
