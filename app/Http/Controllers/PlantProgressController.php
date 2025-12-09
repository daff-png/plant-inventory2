<?php
namespace App\Http\Controllers;

use App\Models\PlantProgress;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlantProgressController extends Controller
{
    public function index()
    {
        $progresses = PlantProgress::with(['plant', 'user'])->latest()->paginate(10);
        return view('plant-progresses.index', compact('progresses'));
    }

    public function create()
    {
        $plants = Plant::all();
        return view('plant-progresses.create', compact('plants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'progress_type' => 'required|in:planting,growing,harvesting',
            'progress_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        
        PlantProgress::create($data);
        return redirect()->route('plant-progresses.index')->with('success', 'Progres tanaman berhasil dicatat.');
    }

    public function show(PlantProgress $plantProgress)
    {
        $plantProgress->load(['plant', 'user']);
        return view('plant-progresses.show', compact('plantProgress'));
    }

    public function edit(PlantProgress $plantProgress)
    {
        $plants = Plant::all();
        return view('plant-progresses.edit', compact('plantProgress', 'plants'));
    }

    public function update(Request $request, PlantProgress $plantProgress)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'progress_type' => 'required|in:planting,growing,harvesting',
            'progress_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $plantProgress->update($request->all());
        return redirect()->route('plant-progresses.index')->with('success', 'Progres tanaman berhasil diperbarui.');
    }

    public function destroy(PlantProgress $plantProgress)
    {
        $plantProgress->delete();
        return redirect()->route('plant-progresses.index')->with('success', 'Progres tanaman berhasil dihapus (soft delete).');
    }
}