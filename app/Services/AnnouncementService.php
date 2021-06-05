<?php


namespace App\Services;


use App\Models\Announcement;


class AnnouncementService
{

    public function __construct(){

    }

    /**
     * @param array $Announcement
     * @return array|string[]
     */
    public function create(array $Announcement): array
    {
        $Announcement['active'] = false;
        $announcement = Announcement::create($Announcement);


        if (!$announcement->exists) {
            return [
                'message' => 'Error in saving the announcement',
            ];

        }
        return [
            'message' => 'Saved successfully',
            'id' => $announcement->id,
        ];

    }

    /**
     *
     */
    public function all()
    {
        return [
            'Announcements' => Announcement::all()
        ];

    }

    /**
     * @param int $id
     * @return array
     */
    public function find(int $id): array
    {
        $announcement = Announcement::find($id);

        if(!$announcement) {
            return [
                'message' => "Unable to find the Announcement id ${id}"
            ];

        }
        return [
            'annoucement' => $announcement
        ];
    }


    /**
     * @param array $input
     * @return string[]
     */
    public function update(array $input){

        $id = $input['id'];
        $announcement = Announcement::find($id);

        if(!$announcement) {
            return [
                'message' => "Unable to find the Announcement id ${id}"
            ];
        }

        $announcement->title = $input['title'];
        $announcement->content = $input['content'];
        $announcement->startDate = $input['startDate'];
        $announcement->endDate = $input['endDate'];

        if($announcement->save()){
            return [
                'message' => "Successfully update announcement ${id}"
            ];
        }

    }

}
