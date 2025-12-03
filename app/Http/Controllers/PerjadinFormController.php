<?php

namespace App\Http\Controllers;

use App\Models\PerjadinForm;
use Illuminate\Http\Request;

/**
 * PerjadinFormController
 * 
 * Menangani CRUD operations untuk formulir perjalanan dinas
 * Termasuk create, read, update, delete, dan history
 */
class PerjadinFormController extends Controller
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
            'followers'        => 'nullable|array',
            'followers.*'      => 'exists:users,id',
        ]);

        $user = auth()->user();

        // Upload file jika ada
        if ($request->hasFile('surat_kegiatan')) {
            $validated['surat_kegiatan'] = $request->file('surat_kegiatan')
                ->store('perjadin-forms', 'public');
        }

        // Set data user dan status
        $validated['user_id'] = $user->id;
        $validated['nama']    = $user->name;
        $validated['nip']     = $user->nip;
        $validated['status']  = 'submitted';
        
        // Simpan pengikut sebagai JSON
        $validated['pengikut'] = json_encode($request->input('followers', []));

        // Simpan ke database
        PerjadinForm::create($validated);

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
     * @param  \App\Models\PerjadinForm  $perjadinForm
     * @return \Illuminate\View\View
     */
    public function show(PerjadinForm $perjadinForm)
    {
        $this->authorize('view', $perjadinForm);

        return view('perjadin.show', compact('perjadinForm'));
    }

    /**
     * Menampilkan halaman edit form perjalanan dinas
     * 
     * Hanya user yang memiliki form dengan status draft yang dapat edit
     * 
     * @param  \App\Models\PerjadinForm  $perjadinForm
     * @return \Illuminate\View\View
     */
    public function edit(PerjadinForm $perjadinForm)
    {
        $this->authorize('update', $perjadinForm);

        return view('perjadin.edit', compact('perjadinForm'));
    }

    /**
     * Mengupdate form perjalanan dinas
     * 
     * Hanya user yang memiliki form dengan status draft yang dapat update
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerjadinForm  $perjadinForm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PerjadinForm $perjadinForm)
    {
        $this->authorize('update', $perjadinForm);

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
            'followers'        => 'nullable|array',
            'followers.*'      => 'exists:users,id',
        ]);

        // Upload file jika ada
        if ($request->hasFile('surat_kegiatan')) {
            $validated['surat_kegiatan'] = $request->file('surat_kegiatan')
                ->store('perjadin-forms', 'public');
        }

        // Simpan pengikut sebagai JSON
        $validated['pengikut'] = json_encode($request->input('followers', []));

        // Update ke database
        $perjadinForm->update($validated);

        return redirect()->route('perjadin.history')
            ->with('success', 'Form berhasil diupdate!');
    }

    /**
     * Menghapus form perjalanan dinas
     * 
     * Hanya user yang memiliki form dengan status draft yang dapat hapus
     * 
     * @param  \App\Models\PerjadinForm  $perjadinForm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PerjadinForm $perjadinForm)
    {
        $this->authorize('delete', $perjadinForm);

        $perjadinForm->delete();

        return redirect()->route('perjadin.history')
            ->with('success', 'Form berhasil dihapus!');
    }
}
