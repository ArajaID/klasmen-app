<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::all();

        return view('club.index', compact('clubs'));
    }

    public function create()
    {
        return view('club.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'club_name' => 'required|unique:clubs,club_name',
            'city'      => 'required',
        ]);

        $validate['club_name'] = Str::title($request->club_name);
        $validate['slug'] = Str::slug($request->club_name, '-');
        $validate['city'] = Str::title($request->city);

        $club = Club::create($validate);

        return redirect('/club')->with('success', 'Klub ' . $club->club_name . ' Berhasil dibuat 😊');
    }

    public function show(Club $club)
    {
        //
    }

    public function edit(Club $club)
    {
        return view('club.edit', compact('club'));
    }

    public function update(Request $request, Club $club)
    {
        $validate = $request->validate([
            'club_name' => 'required',
            'city'      => 'required',
        ]);

        $validate['club_name'] = Str::title($request->club_name);
        $validate['slug'] = Str::slug($request->club_name, '-');
        $validate['city'] = Str::title($request->city);

        Club::where('id', $club->id)
                ->update($validate);

        return redirect('/club')->with('success', 'Klub Berhasil diedit 😊');
    }

    public function destroy(Club $club)
    {
        Club::destroy($club->id);

        return redirect('/club')->with('success', 'Club berhasil dihapus 😊');
    }
}
