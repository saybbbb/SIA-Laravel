<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminStaffController extends Controller
{
    // Helper method to restrict access to admins only
    protected function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    // Show list of pending staff registrations
    public function pending()
    {
        $this->authorizeAdmin();

        $pendingStaff = User::where('role', 'staff')
            ->where('status', 'pending')
            ->get();

        return view('admin.staff.pending', compact('pendingStaff'));
    }

    // Approve a pending staff user
    public function approve($id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->back()->with('success', 'Staff approved successfully.');
    }

    // Reject a pending staff user
    public function reject($id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        $user->delete();  // Delete user instead of updating status

        return redirect()->back()->with('success', 'Staff rejected and deleted successfully.');
    }

}
