<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the destinations.
     */
    public function index()
    {
        $destinations = Destination::orderBy('country', 'asc')->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new destination.
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store a newly created destination in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string|max:255|unique:destinations,country',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Destination::create($validated);

        return redirect()
            ->route('admin.destinations')
            ->with('success', '✅ Tujuan KKN berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified destination.
     */
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified destination in storage.
     */
    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $validated = $request->validate([
            'country' => 'required|string|max:255|unique:destinations,country,' . $id,
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $destination->update($validated);

        return redirect()
            ->route('admin.destinations')
            ->with('success', '✅ Tujuan KKN berhasil diupdate!');
    }

    /**
     * Remove the specified destination from storage.
     */
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        
        // Check if destination is being used in registrations
        if ($destination->pendaftaran()->exists()) {
            return redirect()
                ->route('admin.destinations')
                ->with('error', '❌ Tidak dapat menghapus tujuan yang sudah digunakan dalam pendaftaran!');
        }
        
        $destination->delete();

        return redirect()
            ->route('admin.destinations')
            ->with('success', '✅ Tujuan KKN berhasil dihapus!');
    }
}