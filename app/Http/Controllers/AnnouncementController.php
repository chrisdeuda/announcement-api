<?php

namespace App\Http\Controllers;

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
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request): JsonResponse
    {

        $input = $request->all();

        $this->validate( $request, [
            'title' => 'bail|required|max:255',
            'content' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'active' => 'required',
        ]);

        $result = $this->announcementService->create($input);

        return response()->json([
            'results' => $result
        ]);

    }

    /**
     *
     */
    public function all(Request $request): JsonResponse
    {
        $result = $this->announcementService->all();

        return response()->json([
            'results' => $result
        ]);

    }




}
