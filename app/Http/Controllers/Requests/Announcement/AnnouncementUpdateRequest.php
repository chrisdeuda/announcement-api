<?php

namespace App\Http\Controllers\Requests\Announcement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementUpdateRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'id' => 'bail|required|max:255',
                'title' => 'bail|required|max:255',
                'content' => 'required',
                'startDate' => 'required',
                'endDate' => 'required',
                'active' => 'required',
            ]
        );

        parent::__construct($request);
    }
}
