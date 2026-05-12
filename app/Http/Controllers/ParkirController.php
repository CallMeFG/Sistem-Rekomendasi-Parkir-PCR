<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DecisionTreeService;
use App\Models\ParkirResult;

class ParkirController extends Controller
{
    public function store(Request $request, DecisionTreeService $dtService)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'tahun' => 'required',
            'zona' => 'required',
            'waktu' => 'required',
            'jam_datang' => 'required',
        ]);

        $hasil = $dtService->predict($validated);

        $parkir = ParkirResult::create([
            'nama' => $request->nama,
            'tahun_kendaraan' => $request->tahun,
            'zona_pilihan' => $request->zona,
            'waktu_tempuh' => $request->waktu,
            'jam_datang' => $request->jam_datang,
            'label_hasil' => $hasil,
        ]);

        return back()->with([
            'success' => $hasil,
            'nama' => $request->nama,
            'result_id' => $parkir->id
        ]);
    }

    public function submitRating(Request $request, $id)
    {
        $parkir = ParkirResult::findOrFail($id);

        $parkir->update([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan
        ]);

        return back()->with('rating_success', 'Terima kasih atas penilaian Anda!');
    }
}
