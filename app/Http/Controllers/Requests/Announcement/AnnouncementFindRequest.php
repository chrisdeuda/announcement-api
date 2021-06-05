<?php

namespace App\Http\Controllers\Requests\Announcement;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementFindRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'id' => 'bail|required|max:255',
            ]
        );

        parent::__construct($request);
    }
}
