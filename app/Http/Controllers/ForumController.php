<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $searchOperator = DB::connection()->getDriverName() === 'pgsql' ? 'ilike' : 'like';

        $forums = Forum::query()
            ->with('user:id,name')
            ->when($q !== '', function ($query) use ($q, $searchOperator) {
                $query->where(function ($nested) use ($q, $searchOperator) {
                    $nested->where('topic', $searchOperator, "%{$q}%")
                        ->orWhere('content', $searchOperator, "%{$q}%");
                });
            })
            ->latest()
            ->paginate(15);

        return view('forums.index', compact('forums', 'q'));
    }

    public function create()
    {
        return view('forums.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'topic' => ['required', 'string', 'min:5', 'max:120'],
            'content' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        $forum = Forum::create([
            ...$data,
            'is_active' => true,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forums.show', $forum)->with('success', 'Foro creado correctamente.');
    }

    public function show(Forum $forum)
    {
        $forum->load('user:id,name');

        return view('forums.show', compact('forum'));
    }

    public function destroy(Forum $forum)
    {
        $user = Auth::user();
        abort_if(!$user, 403);

        $canDelete = $user->isAdmin() || $forum->user_id === $user->id;
        abort_if(!$canDelete, 403);

        $forum->delete();

        return redirect()->route('forums.index')->with('success', 'Foro eliminado.');
    }

    public function toggle(Forum $forum)
    {
        $user = Auth::user();
        abort_if(!$user, 403);

        $canToggle = $user->isAdmin() || $forum->user_id === $user->id;
        abort_if(!$canToggle, 403);

        $forum->update([
            'is_active' => !$forum->is_active,
        ]);

        $message = $forum->is_active ? 'Foro activado.' : 'Foro desactivado.';

        return back()->with('success', $message);
    }
}
