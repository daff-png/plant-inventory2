<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\PlantCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $plants = Plant::with(['category', 'user'])
            ->when($search, function ($query, $search) {
                return $query->where('plant_name', 'like', "%{$search}%")
                             ->orWhere('latin_name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
            
        return view('plants.index', compact('plants'));
    }

    public function create()
    {
        $categories = PlantCategory::all();
        return view('plants.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plant_name' => 'required|string|max:255',
            'category_id' => 'required|exists:plant_categories,id',
            'latin_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'barcode' => 'nullable|string|max:100|unique:plants',
            'planting_date' => 'nullable|date',
            'condition' => 'required|in:healthy,sick,dead',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'health_benefits' => 'nullable|string',
            'cultural_benefits' => 'nullable|string',
            'habitat' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('plant_photos', 'public');
            $data['photo'] = $path;
        }

        Plant::create($data);
        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil ditambahkan.');
    }

    public function show(Plant $plant)
    {
        $plant->load(['user', 'category', 'tips', 'progresses.user']);
        return view('plants.show', compact('plant'));
    }

    public function edit(Plant $plant)
    {
        $categories = PlantCategory::all();
        return view('plants.edit', compact('plant', 'categories'));
    }

    public function update(Request $request, Plant $plant)
    {
        $request->validate([
            'plant_name' => 'required|string|max:255',
            'category_id' => 'required|exists:plant_categories,id',
            'barcode' => 'nullable|string|max:100|unique:plants,barcode,' . $plant->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // ... (validasi lain)
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($plant->photo) {
                Storage::disk('public')->delete($plant->photo);
            }
            $path = $request->file('photo')->store('plant_photos', 'public');
            $data['photo'] = $path;
        }

        $plant->update($data);
        return redirect()->route('plants.index')->with('success', 'Data tanaman berhasil diperbarui.');
    }

    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil dipindahkan ke keranjang sampah.');
    }

    // qr
    public function generateQR(Plant $plant)
    {
        // Data yang ingin Anda tampilkan di QR Code (URL ke halaman detail)
        $url = route('plants.show', $plant);
        
        // Generate QR Code
        $qrCode = QrCode::size(300)->generate($url);
        
        // Tampilkan view dengan QR code
        return view('plants.qr', compact('qrCode', 'plant'));
    }
}