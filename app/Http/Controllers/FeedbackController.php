<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $lastFeedback = auth()->user()->fedbacks()->orderBy('created_at', 'desc')->first();

        if ($lastFeedback && $lastFeedback->created_at->addHours(24) > Carbon::now()){
            return back()->with('info', __('Submit a request within 24 hours'));
        }

        $validator = Validator::make($request->all(), [
            'theme' => 'required|string|min:3|max:255',
            'message' => 'required|string|min:3|max:1000',
            'file' => 'mimes:pdf,docx|max:9048',
        ]);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')){
            $path = $request->file->store('uploads', 'public');
        }

        Feedback::create([
            'theme' => $request->theme,
            'message' => $request->message,
            'file' => $path ?? null,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', __('Created'));
    }
}
