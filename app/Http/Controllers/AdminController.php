<?php

namespace App\Http\Controllers;

use App\Models\ParkirResult;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data parkir, diurutkan dari yang terbaru
        $results = ParkirResult::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('results'));
    }

    public function destroy($id)
    {
        // Fitur tambahan untuk menghapus data jika diperlukan
        ParkirResult::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
