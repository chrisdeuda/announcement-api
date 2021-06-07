<?php


namespace App\Helper\Transformer;


abstract class Transformer
{

    /**
     * @param array $items
     * @return array[]
     */
    public function transformCollection(array $items): array
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * @param array $item
     * @return mixed
     */
    public abstract function transform(array $item);

}
