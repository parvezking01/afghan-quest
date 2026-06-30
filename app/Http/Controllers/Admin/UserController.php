<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role') && $request->role !== '') {
            $query->where('role', $request->role);
        }

        // Search by name, email, or phone
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function approve(User $user)
    {
        $user->update(['is_approved' => !$user->is_approved]);

        $status = $user->is_approved ? 'تایید شد' : 'لغو تایید شد';
        return back()->with('success', "✅ کاربر {$status}.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', '❌ نمی‌توانید خودتان را حذف کنید.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', '✅ کاربر با موفقیت حذف شد.');
    }
}
