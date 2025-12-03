<?php

namespace App\Http\Controllers;

use App\Models\PerjadianForm;
use Illuminate\Http\Request;

class PerjadianFormController extends Controller
{
    /**
     * Show the form for creating a new perjadian form.
     */
    public function create()
    {
        return view('perjadian.create');
    }

    /**
     * Store a newly created perjadian form in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
            'nama_kegiatan' => 'required|string',
            'jenis_kegiatan' => 'required|in:dalam_kota,luar_kota',
            'surat_kegiatan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nama_instansi' => 'required|string',
            'alamat_kegiatan' => 'required|string',
        ]);

        $user = auth()->user();

        if ($request->hasFile('surat_kegiatan')) {
            $validated['surat_kegiatan'] = $request->file('surat_kegiatan')->store('perjadian-forms', 'public');
        }

        $validated['user_id'] = $user->id;
        $validated['nama'] = $user->name;
        $validated['nip'] = $user->nip;
        $validated['status'] = 'submitted';

        PerjadianForm::create($validated);

        return redirect()->route('perjadian.history')->with('success', 'Form berhasil disubmit!');
    }

    /**
     * Show the history of perjadian forms for the logged-in user.
     */
    public function history()
    {
        $forms = auth()->user()->perjadianForms()->latest()->paginate(10);
        return view('perjadian.history', compact('forms'));
    }

    /**
     * Show the specified perjadian form.
     */
    public function show(PerjadianForm $perjadianForm)
    {
        $this->authorize('view', $perjadianForm);
        return view('perjadian.show', compact('perjadianForm'));
    }

    /**
     * Show the form for editing the specified perjadian form.
     */
    public function edit(PerjadianForm $perjadianForm)
    {
        $this->authorize('update', $perjadianForm);
        return view('perjadian.edit', compact('perjadianForm'));
    }

    /**
     * Update the specified perjadian form in storage.
     */
    public function update(Request $request, PerjadianForm $perjadianForm)
    {
        $this->authorize('update', $perjadianForm);

        $validated = $request->validate([
            'nomor_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
            'nama_kegiatan' => 'required|string',
            'jenis_kegiatan' => 'required|in:dalam_kota,luar_kota',
            'surat_kegiatan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nama_instansi' => 'required|string',
            'alamat_kegiatan' => 'required|string',
        ]);

        if ($request->hasFile('surat_kegiatan')) {
            $validated['surat_kegiatan'] = $request->file('surat_kegiatan')->store('perjadian-forms', 'public');
        }

        $perjadianForm->update($validated);

        return redirect()->route('perjadian.history')->with('success', 'Form berhasil diupdate!');
    }

    /**
     * Remove the specified perjadian form from storage.
     */
    public function destroy(PerjadianForm $perjadianForm)
    {
        $this->authorize('delete', $perjadianForm);
        $perjadianForm->delete();
        return redirect()->route('perjadian.history')->with('success', 'Form berhasil dihapus!');
    }
}
