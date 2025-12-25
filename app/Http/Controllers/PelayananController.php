<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $search = $request->search ?? '';
        $orderBy = $request->orderBy ?? 'id';
        $sortBy = $request->sortBy ?? 'asc';

        $data = Pelayanan::where('nama_pelanggan', 'LIKE', "%$search%")
            ->orderBy($orderBy, $sortBy)
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json($data);
    }

    public function show($id)
    {
        return Pelayanan::findOrFail($id);
    }

    public function store(Request $request)
    {
        return Pelayanan::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $data = Pelayanan::findOrFail($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        Pelayanan::findOrFail($id)->delete();
        return ['message' => 'Deleted'];
    }
}

