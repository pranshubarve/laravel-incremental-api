<?php
namespace App\Phoenix\Transformers;

/**
 * Class CategoryTransformer
 * @package App\Phoenix\Transformers
 */
class CategoryTransformer extends Transformer {

    /**
     * Transformer Category
     *
     * @param $category
     * @return array
     */
    public function transform($category)
    {
        return[
            'title' => $category['title'],
            'description' => $category['description'],
            'status' => $category['status'],
            'created_at' => $category['created_at'],
            'updated_at' => $category['updated_at'],
        ];
    }
}