<?php

namespace App\Http\Controllers;

use App\Models\PerjadinForm;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * ExportController
 * 
 * Menangani export data perjalanan dinas ke format CSV
 * Hanya accessible untuk admin users
 */
class ExportController extends Controller
{
    /**
     * Export perjadian forms ke CSV
     * 
     * Menghasilkan file CSV dengan semua data form
     * Format: nama, nip, nomor_surat, kegiatan, tanggal, status, dll
     * 
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportForms()
    {
        // Authorize admin only
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Get all forms
        $forms = PerjadinForm::with('user')->latest()->get();

        // Create CSV response
        $response = new StreamedResponse(function () use ($forms) {
            $handle = fopen('php://output', 'w');

            // Set UTF-8 BOM untuk Excel
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header row
            fputcsv($handle, [
                'Nama',
                'NIP',
                'Nomor Surat',
                'Tanggal Surat',
                'Nama Kegiatan',
                'Jenis Kegiatan',
                'Tanggal Berangkat',
                'Tanggal Pulang',
                'Nama Instansi',
                'Alamat Kegiatan',
                'Status',
                'Catatan Admin',
                'Dibuat',
            ]);

            // Data rows
            foreach ($forms as $form) {
                fputcsv($handle, [
                    $form->nama,
                    $form->nip,
                    $form->nomor_surat,
                    $form->tanggal_surat->format('d/m/Y'),
                    $form->nama_kegiatan,
                    $form->jenis_kegiatan === 'dalam_kota' ? 'Dalam Kota' : 'Luar Kota',
                    $form->tanggal_berangkat->format('d/m/Y'),
                    $form->tanggal_pulang->format('d/m/Y'),
                    $form->nama_instansi,
                    $form->alamat_kegiatan,
                    ucfirst($form->status),
                    $form->catatan_admin ?? '-',
                    $form->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($handle);
        });

        // Set headers
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="perjadin-forms-'.date('Y-m-d').'.csv"');

        return $response;
    }
}
