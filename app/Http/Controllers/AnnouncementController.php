<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\Announcement\AnnouncementFindRequest;
use App\Http\Controllers\Requests\Announcement\AnnouncementStoreRequest;
use App\Http\Controllers\Requests\Announcement\AnnouncementUpdateRequest;
use App\Models\Announcement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use App\Helper\Transformer\AnnouncementTransformer;


class AnnouncementController extends ApiController
{

    /**
     * @var AnnouncementTransformer
     */
    protected $announcementTransformer;


    /**
     * AnnouncementController constructor.
     *
     * @param AnnouncementTransformer $announcementTransformer
     */
    public function __construct(AnnouncementTransformer $announcementTransformer)
    {

        $this->announcementTransformer = $announcementTransformer;
    }


    /**
     * @param AnnouncementStoreRequest $announcementStoreRequest
     * @return JsonResponse
     */
    public function store(AnnouncementStoreRequest $announcementStoreRequest ): JsonResponse
    {

        $input = $announcementStoreRequest->request->all();

        $announcement = Announcement::create($input);

        if (!$announcement->exists) {
            return $this->respondWithError("Unable to create announcement");
        }

        return $this->respondCreated("Announcement successfully created");

    }

    /**
     * @param Request $request
     * @TODO Implements pagination
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {


        $announcements =  Announcement::all()->sortByDesc("startDate");;

        if(!$announcements) {

            return $this->responseNotFound("");

        }
        $data = $this->announcementTransformer->transformCollection($announcements->toArray());
        return $this->respond([
            'data' => $data
        ]);

    }

    /**
     * @param AnnouncementFindRequest $announcementFindRequest
     * @return JsonResponse
     */
    public function find(AnnouncementFindRequest $announcementFindRequest): JsonResponse
    {
        $input = $announcementFindRequest->request->all();

        $id = $input['id'];

        $announcement = Announcement::find($input['id']);

        if(!$announcement) {

            return $this->responseNotFound("Unable to find the Announcement id ${id}" );

        }
        $data = $this->announcementTransformer->transform($announcement->toArray());
        return $this->respond([
            'data' => $data
        ]);

    }

    /**
     * @param AnnouncementUpdateRequest $announcementFindRequest
     * @return JsonResponse
     */
    public function update(AnnouncementUpdateRequest $announcementFindRequest): JsonResponse
    {
        $input = $announcementFindRequest->request->all();

        $id = $input['id'];
        $announcement = Announcement::find($id);

        if(!$announcement) {
            return $this->responseNotFound("Unable to find the Announcement id ${id}" );
        }
        // Check if the current login user have capability to update
        if (! Gate::authorize('update', $announcement)) {
            return $this->respondWithError("Don't have capability to update" );
        }

        $announcement->title = $input['title'];
        $announcement->content = $input['content'];
        $announcement->startDate = $input['startDate'];
        $announcement->endDate = $input['endDate'];
        $announcement->active = (bool)$input['active'];

        if(!$announcement->save()){
            return $this->respondWithError("Unable to saved existing announcement ${id}");
        }

        $this->respondCreated("Announcement successfully updated");
        $this->respondCreated("Announcement successfully updated");

    }


    /**
     * @param AnnouncementFindRequest $announcementFindRequest
     * @return array|JsonResponse
     */
    public function delete(AnnouncementFindRequest $announcementFindRequest){
        $input = $announcementFindRequest->request->all();

        $id = $input['id'];

        $announcement = Announcement::find($id);

        if(!$announcement) {
            return $this->responseNotFound("Unable to find the Announcement id ${id}" );
        }
        $response = $announcement->destroy($id);
        if (!$response) {
            return $this->respond([
                'status' => 1,
                'message' => 'failed'
            ]) ;
        }

        return $this->respond([
            'data' => [
                'status_code' => 200,
                'message' => 'success'
            ]
        ]);

    }

}
