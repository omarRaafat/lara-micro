<?php

namespace App\Http\Controllers;

use App\Http\Services\CommentService;
use App\Models\Comment;
use App\Traits\HandleResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use HandleResponse;
    /**
     * Display a listing of the resource.
     */
    protected $comment_service;

    function __construct(CommentService $commentService){
        $this->comment_service = $commentService;
    }
    public function index(Request $request)
    {
       return $this->comment_service->getPostComments($request->model_id);
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->comment_service->createPostComment($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
