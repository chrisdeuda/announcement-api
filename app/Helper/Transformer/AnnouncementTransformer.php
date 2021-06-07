<?php


namespace App\Helper\Transformer;


class AnnouncementTransformer extends Transformer
{
    /**
     * @param $announcement
     * @return array
     */
    public function transform(array $item): array
    {
        return [
            'id' => $item['id'],
            'title' => $item['title'],
            'content' => $item['content'],
            'startDate' => $item['startDate'],
            'endDate' => $item['endDate'],
            'active' => (boolean)$item['active'],
        ];
    }

}
