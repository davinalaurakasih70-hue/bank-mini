<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $rekenings = Rekening::with('nasabah')
            ->when($search, function ($query, $search) {
                $query->where('no_rekening', 'like', "%{$search}%")
                    ->orWhereHas('nasabah', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%")
                            ->orWhere('nis', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(15);

        return view('rekening.index', compact('rekenings', 'search'));
    }

    public function show(Rekening $rekening)
    {
        $rekening->load(['nasabah', 'transaksis' => function ($q) {
            $q->latest();
        }]);

        return view('rekening.show', compact('rekening'));
    }
}
