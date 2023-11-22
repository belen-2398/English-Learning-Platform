<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\CommentHasReply;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $topicId)
    {
        $validatedData = $request->validated();

        $topic = Topic::findOrFail($topicId);

        $topic->comments()->create([
            'user_id' => Auth::user()->id,
            'content' => $validatedData['content'],
        ]);
    }

    public function storeReply(CommentRequest $request, $commentId)
    {
        $validatedData = $request->validated();

        $parentComment = Comment::findOrFail($commentId);

        $parentComment->replies()->create([
            'user_id' => Auth::user()->id,
            'content' => $validatedData['content'],
        ]);

        $parentUser = User::findOrFail($parentComment->user_id);
        $parentUser->notify(new CommentHasReply($parentComment));
    }

    public function show(Comment $comment)
    {
        return Inertia::render('Comments/Show', [
            'comment' => $comment,
        ]);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $validatedData = $request->validated();

        if ($comment->user_id === Auth::user()->id) {
            $comment->update([
                'user_id' => Auth::user()->id,
                'content' => $validatedData['content'],
            ]);
        }
    }

    public function destroy(Comment $comment)
    {
        $topicId = $comment->topic_id;

        if ($comment->user_id === Auth::user()->id) {
            $comment->delete();
        }
    }
}
