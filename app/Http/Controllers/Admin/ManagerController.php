<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ManagerController extends Controller
{

    /**
     * @param  Feedback  $feedback
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Feedback $feedback)
    {
        $feedbacks = $feedback->paginate(5);

        return view('pages.admin.list', ['feedbacks' => $feedbacks]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $feedback = Feedback::find($id);

        if (empty($feedback)){
            return back()->with('danger', __('Page not found'));
        }

        $feedback->done = 1;
        $feedback->save();

        return back()->with('success', __('Updated'));
    }
}
