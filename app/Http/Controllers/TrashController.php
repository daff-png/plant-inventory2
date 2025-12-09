<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TrashController extends Controller
{
    // --- Plant Trash ---
    public function plantsTrash()
    {
        $trashedPlants = Plant::onlyTrashed()->latest()->paginate(10);
        return view('trash.plants.index', compact('trashedPlants'));
    }

    public function plantsRestore($id)
    {
        $plant = Plant::onlyTrashed()->findOrFail($id);
        $plant->restore();
        return redirect()->route('plants.trash')->with('success', 'Tanaman berhasil dipulihkan.');
    }

    public function plantsForceDelete($id)
    {
        $plant = Plant::onlyTrashed()->findOrFail($id);
        if ($plant->photo) {
            Storage::disk('public')->delete($plant->photo);
        }
        $plant->forceDelete();
        return redirect()->route('plants.trash')->with('success', 'Tanaman berhasil dihapus permanen.');
    }

    // --- User Trash ---
    public function usersTrash()
    {
        $trashedUsers = User::onlyTrashed()->latest()->paginate(10);
        return view('trash.users.index', compact('trashedUsers'));
    }

    public function usersRestore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.trash')->with('success', 'User berhasil dipulihkan.');
    }

    public function usersForceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('users.trash')->with('success', 'User berhasil dihapus permanen.');
    }
}