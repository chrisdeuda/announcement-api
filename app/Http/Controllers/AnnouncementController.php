<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\Announcement\AnnouncementFindRequest;
use App\Http\Controllers\Requests\Announcement\AnnouncementStoreRequest;
use App\Http\Controllers\Requests\Announcement\AnnouncementUpdateRequest;
use App\Services\AnnouncementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AnnouncementController extends Controller
{

    /**
     * @var AnnouncementService
     */
    public $announcementService;

    /**
     * AnnouncementController constructor.
     *
     * @param AnnouncementService $announcementService
     */
    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;
    }


    /**
     * @param AnnouncementStoreRequest $announcementStoreRequest
     * @return JsonResponse
     */
    public function create(AnnouncementStoreRequest $announcementStoreRequest ): JsonResponse
    {

        $input = $announcementStoreRequest->request->all();

        $result = $this->announcementService->create($input);

        return response()->json([
            'results' => $result
        ]);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function all(Request $request): JsonResponse
    {
        $result = $this->announcementService->all();

        return response()->json([
            'results' => $result
        ]);

    }

    /**
     * @param AnnouncementFindRequest $announcementUpdateRequest
     * @return JsonResponse
     */
    public function find(AnnouncementFindRequest $announcementUpdateRequest): JsonResponse
    {
        $input = $announcementUpdateRequest->request->all();

        $result = $this->announcementService->find($input['id']);

        return response()->json([
            'results' => $result
        ]);

    }

    /**
     * @param AnnouncementUpdateRequest $announcementUpdateRequest
     * @return JsonResponse
     */
    public function update(AnnouncementUpdateRequest $announcementUpdateRequest): JsonResponse
    {
        $input = $announcementUpdateRequest->request->all();

        $result = $this->announcementService->update($input);

        return response()->json([
            'results' => $result
        ]);

    }

}
