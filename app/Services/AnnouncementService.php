<?php


namespace App\Services;


use App\Models\Announcement;
use Illuminate\Support\Facades\Gate;


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
     * @return array
     */
    public function all()
    {
        $announcement =  Announcement::all()->sortByDesc("startDate");;

        return [
            'announcements' => $announcement
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
        // Check if the current login user have capability to update
        if (! Gate::authorize('update', $announcement)) {
            return false;
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
