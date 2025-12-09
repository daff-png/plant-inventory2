<?php
namespace App\Http\Controllers;

use App\Models\PlantTip;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantTipController extends Controller
{
    public function index()
    {
        $tips = PlantTip::with('plant')->latest()->paginate(10);
        return view('plant-tips.index', compact('tips'));
    }

    public function create()
    {
        $plants = Plant::all();
        return view('plant-tips.create', compact('plants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id|unique:plant_tips,plant_id',
            'watering_tips' => 'nullable|string',
            'lighting_tips' => 'nullable|string',
            'soil_media' => 'nullable|string',
        ]);
        
        PlantTip::create($request->all());
        return redirect()->route('plant-tips.index')->with('success', 'Tips tanaman berhasil ditambahkan.');
    }

    public function show(PlantTip $plantTip)
    {
        $plantTip->load('plant');
        return view('plant-tips.show', compact('plantTip'));
    }

    public function edit(PlantTip $plantTip)
    {
        $plants = Plant::all();
        return view('plant-tips.edit', compact('plantTip', 'plants'));
    }

    public function update(Request $request, PlantTip $plantTip)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id|unique:plant_tips,plant_id,' . $plantTip->id,
            'watering_tips' => 'nullable|string',
            'lighting_tips' => 'nullable|string',
            'soil_media' => 'nullable|string',
        ]);

        $plantTip->update($request->all());
        return redirect()->route('plant-tips.index')->with('success', 'Tips tanaman berhasil diperbarui.');
    }

    public function destroy(PlantTip $plantTip)
    {
        $plantTip->delete();
        return redirect()->route('plant-tips.index')->with('success', 'Tips tanaman berhasil dihapus (soft delete).');
    }
}