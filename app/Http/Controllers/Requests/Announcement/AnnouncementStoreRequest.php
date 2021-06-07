<?php

namespace App\Http\Controllers\Requests\Announcement;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementStoreRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'title' => 'bail|required|max:255',
                'content' => 'required',
                'startDate' => 'required|date|before_or_equal:endDate',
                'endDate' => 'required|date|after_or_equal:startDate',
                'active' => 'required',
            ]
        );

        parent::__construct($request);
    }
}
