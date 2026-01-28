<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    /**
     * Display a listing of the periods.
     */
    public function index()
    {
        $periods = Period::orderBy('start_date', 'desc')->paginate(10);
        return view('admin.periods.index', compact('periods'));
    }

    /**
     * Show the form for creating a new period.
     */
    public function create()
    {
        return view('admin.periods.create');
    }

    /**
     * Store a newly created period in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|string|max:20',
            'semester' => 'required|integer|in:1,2',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'nullable|boolean'
        ]);

        // HAPUS bagian mapping academic_year - TIDAK PERLU!
        // Langsung gunakan 'year' karena sudah sesuai dengan database

        // Handle is_active
        $validated['is_active'] = $request->boolean('is_active');

        // If this period is set to active, deactivate all other periods
        if ($validated['is_active']) {
            Period::where('is_active', true)->update(['is_active' => false]);
        }

        Period::create($validated);

        return redirect()
            ->route('admin.periods')
            ->with('success', 'Periode KKN berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified period.
     */
    public function edit($id)
    {
        $period = Period::findOrFail($id);
        return view('admin.periods.edit', compact('period'));
    }

    /**
     * Update the specified period in storage.
     */
    public function update(Request $request, $id)
    {
        $period = Period::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|string|max:20',
            'semester' => 'required|integer|in:1,2',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'nullable|boolean'
        ]);

        // HAPUS bagian mapping academic_year - TIDAK PERLU!
        // Langsung gunakan 'year' karena sudah sesuai dengan database

        // Handle is_active
        $validated['is_active'] = $request->boolean('is_active');

        // If this period is set to active, deactivate all other periods except this one
        if ($validated['is_active']) {
            Period::where('is_active', true)
                ->where('id', '!=', $id)
                ->update(['is_active' => false]);
        }

        $period->update($validated);

        return redirect()
            ->route('admin.periods')
            ->with('success', 'Periode KKN berhasil diupdate!');
    }

    /**
     * Remove the specified period from storage.
     */
    public function destroy($id)
    {
        $period = Period::findOrFail($id);
        
        // Prevent deleting active period
        if ($period->is_active) {
            return redirect()
                ->route('admin.periods')
                ->with('error', 'Tidak dapat menghapus periode yang sedang aktif!');
        }
        
        $period->delete();

        return redirect()
            ->route('admin.periods')
            ->with('success', 'Periode KKN berhasil dihapus!');
    }
}