<?php

namespace App\Http\Controllers;

use App\Models\PerjadianForm;
use Illuminate\Http\Request;

/**
 * PerjadianFormController
 * 
 * Menangani CRUD operations untuk formulir perjalanan dinas
 * Termasuk create, read, update, delete, dan history
 */
class PerjadianFormController extends Controller
{
    /**
     * Menampilkan halaman form perjalanan dinas
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('perjadin.create');
    }

    /**
     * Menyimpan form perjalanan dinas baru ke database
     * 
     * Validasi semua field, upload file jika ada,
     * dan set status awal ke 'submitted'
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nomor_surat'      => 'required|string',
            'tanggal_surat'    => 'required|date',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang'   => 'required|date|after_or_equal:tanggal_berangkat',
            'nama_kegiatan'    => 'required|string',
            'jenis_kegiatan'   => 'required|in:dalam_kota,luar_kota',
            'surat_kegiatan'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nama_instansi'    => 'required|string',
            'alamat_kegiatan'  => 'required|string',
        ]);

        $user = auth()->user();

        // Upload file jika ada
        if ($request->hasFile('surat_kegiatan')) {
            $validated['surat_kegiatan'] = $request->file('surat_kegiatan')
                ->store('perjadian-forms', 'public');
        }

        // Set data user dan status
        $validated['user_id'] = $user->id;
        $validated['nama']    = $user->name;
        $validated['nip']     = $user->nip;
        $validated['status']  = 'submitted';

        // Simpan ke database
        PerjadianForm::create($validated);

        return redirect()->route('perjadin.history')
            ->with('success', 'Form berhasil disubmit!');
    }

    /**
     * Menampilkan riwayat form perjalanan dinas user
     * 
     * Menampilkan form terbaru dengan pagination 10 item per halaman
     * 
     * @return \Illuminate\View\View
     */
    public function history()
    {
        $forms = auth()->user()->perjadinForms()
            ->latest()
            ->paginate(10);

        return view('perjadin.history', compact('forms'));
    }

    /**
     * Menampilkan detail form perjalanan dinas
     * 
     * Hanya user yang memiliki form atau admin yang dapat melihat
     * 
     * @param  \App\Models\PerjadianForm  $perjadianForm
     * @return \Illuminate\View\View
     */
    public function show(PerjadianForm $perjadianForm)
    {
        $this->authorize('view', $perjadianForm);

        return view('perjadin.show', compact('perjadianForm'));
    }

    /**
     * Menampilkan halaman edit form perjalanan dinas
     * 
     * Hanya user yang memiliki form dengan status draft yang dapat edit
     * 
     * @param  \App\Models\PerjadianForm  $perjadianForm
     * @return \Illuminate\View\View
     */
    public function edit(PerjadianForm $perjadianForm)
    {
        $this->authorize('update', $perjadianForm);

        return view('perjadin.edit', compact('perjadianForm'));
    }

    /**
     * Mengupdate form perjalanan dinas
     * 
     * Hanya user yang memiliki form dengan status draft yang dapat update
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerjadianForm  $perjadianForm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PerjadianForm $perjadianForm)
    {
        $this->authorize('update', $perjadianForm);

        // Validasi input
        $validated = $request->validate([
            'nomor_surat'      => 'required|string',
            'tanggal_surat'    => 'required|date',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang'   => 'required|date|after_or_equal:tanggal_berangkat',
            'nama_kegiatan'    => 'required|string',
            'jenis_kegiatan'   => 'required|in:dalam_kota,luar_kota',
            'surat_kegiatan'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nama_instansi'    => 'required|string',
            'alamat_kegiatan'  => 'required|string',
        ]);

        // Upload file jika ada
        if ($request->hasFile('surat_kegiatan')) {
            $validated['surat_kegiatan'] = $request->file('surat_kegiatan')
                ->store('perjadian-forms', 'public');
        }

        // Update ke database
        $perjadianForm->update($validated);

        return redirect()->route('perjadin.history')
            ->with('success', 'Form berhasil diupdate!');
    }

    /**
     * Menghapus form perjalanan dinas
     * 
     * Hanya user yang memiliki form dengan status draft yang dapat hapus
     * 
     * @param  \App\Models\PerjadianForm  $perjadianForm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PerjadianForm $perjadianForm)
    {
        $this->authorize('delete', $perjadianForm);

        $perjadianForm->delete();

        return redirect()->route('perjadin.history')
            ->with('success', 'Form berhasil dihapus!');
    }
}
