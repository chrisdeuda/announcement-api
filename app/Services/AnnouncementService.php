<?php


namespace App\Services;


use App\Models\Announcement;
use Illuminate\Support\Facades\Gate;
use App\Helper\Transformer\AnnouncementTransformer;


class AnnouncementServicess
{
    /**
     * @var AnnouncementTransformer
     */
    protected $announcementTransformer;

    public function __construct(AnnouncementTransformer $announcementTransformer){
        $this->announcementTransformer = $announcementTransformer;

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
        $announcements =  Announcement::all()->sortByDesc("startDate");;

        return [
            'announcements' => $this->announcementTransformer->transformCollection($announcements->toArray())
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
            'announcement' => $this->announcementTransformer->transform($announcement->toArray())
        ];
    }




    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        $announcement = Announcement::find($id);

        if(!$announcement) {
            return [
                'status' => 0,
                'message' => "Unable to find the Announcement id ${id}"
            ];
        }
        $response = $announcement->destroy($id);
        if ($response) {
            return [
                'status' => 1,
                'message' => 'success'
            ];
        } else {
            return [
                'status' => 0,
                'message' => 'fail'
            ];
        }

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
        $announcement->active = $input['active'];

        if($announcement->save()){
            return [
                'message' => "Successfully update announcement ${id}"
            ];
        }

    }

}
