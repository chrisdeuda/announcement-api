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

}
