<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Standings;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function create()
    {
        return view('score.create');
    }

    public function store(Request $request)
    {      
        $validate = $request->validate([
                'club_1'   => 'required',
                'club_2'   => 'required',
                'score_1'  => 'required',
                'score_2'  => 'required',
            ]);
   
        $pertandingan = $request->only(['club_1', 'club_2', 'score_1', 'score_2']);

        $club_1 = $pertandingan['club_1'];
        $club_2 = $pertandingan['club_2'];

        $existingMatch = Score::where(function ($query) use ($club_1, $club_2) {
            $query->where('club_1', $club_1)->where('club_2', $club_2);
        })->first();

        if ($existingMatch) {
            return redirect('/score')->with('error', 'Data pertandingan yang sama sudah ada 😞');
        }

        $cekClub1 = Standings::where('club', $pertandingan['club_1'])->first();
        $cekClub2 = Standings::where('club', $pertandingan['club_2'])->first();

        if($pertandingan['score_1'] > $pertandingan['score_2']) {
            // club 1 menang
            if($cekClub1 == null) {
                Standings::create([
                    'club' => $pertandingan['club_1'],
                    'Ma' => 1,
                    'Me' => 1,
                    'S' => 0,
                    'K' => 0,
                    'GM' => $pertandingan['score_1'],
                    'GK' => 0,
                    'Point' => 3,
                ]);
            } else {
                Standings::where('club', $pertandingan['club_1'])
                ->update([
                    'Ma' => $cekClub1->Ma + 1,
                    'Me' => $cekClub1->Me + 1,
                    'S' => $cekClub1->S + 0,
                    'K' => 0,
                    'GM' => $cekClub1->GM + $pertandingan['score_1'],
                    'GK' => 0,
                    'Point' => $cekClub1->Point + 3,
                ]);
            }

            // club 2 kalah
            if($cekClub2 == null) {
                Standings::create([
                    'club' => $pertandingan['club_2'],
                    'Ma' => 1,
                    'Me' => 0,
                    'S' => 0,
                    'K' => 1,
                    'GM' => 0,
                    'GK' => $pertandingan['score_2'],
                    'Point' => 0,
                ]);
            } else {
                Standings::where('club', $pertandingan['club_2'])
                ->update([
                    'Ma' => $cekClub2->Ma + 1,
                    'Me' => $cekClub2->Me,
                    'S' => 0,
                    'K' => $cekClub2->K + 1,
                    'GM' => $cekClub2->GM,
                    'GK' => $cekClub2->GK + $pertandingan['score_1'],
                    'Point' => $cekClub2->Point + 0,
                ]);
            }
        } elseif($pertandingan['score_1'] == $pertandingan['score_2']) {
                // club 1 seri
                if($cekClub1 == null) {
                    Standings::create([
                        'club' => $pertandingan['club_1'],
                        'Ma' => 1,
                        'Me' => 0,
                        'S' => 1,
                        'K' => 0,
                        'GM' => 0,
                        'GK' => 0,
                        'Point' => 1,
                    ]);
                } else {
                    Standings::where('club', $pertandingan['club_1'])
                    ->update([
                        'Ma' => $cekClub1->Ma + 1,
                        'Me' => $cekClub1->Me + 0,
                        'S' => $cekClub1->Me + 1,
                        'K' => $cekClub1->K + 0,
                        'GM' => $cekClub1->GM + 0,
                        'GK' => $cekClub1->GK + 0,
                        'Point' => $cekClub1->Point + 1,
                    ]);
                }
    
                // club 2 seri
                if($cekClub2 == null) {
                    Standings::create([
                        'club' => $pertandingan['club_2'],
                        'Ma' => 1,
                        'Me' => 0,
                        'S' => 1,
                        'K' => 0,
                        'GM' => 0,
                        'GK' => 0,
                        'Point' => 1,
                    ]);
                } else {
                    Standings::where('club', $pertandingan['club_2'])
                    ->update([
                        'Ma' => $cekClub2->Ma + 1,
                        'Me' => $cekClub2->Me + 0,
                        'S' => $cekClub2->Me + 1,
                        'K' => $cekClub2->K + 0,
                        'GM' => $cekClub2->GM + 0,
                        'GK' => $cekClub2->GK + 0,
                        'Point' => $cekClub2->Point + 1,
                    ]);
                }
        } elseif($pertandingan['score_1'] < $pertandingan['score_2']) {

            // club 1 kalah
            if($cekClub1 == null) {
                Standings::create([
                    'club' => $pertandingan['club_1'],
                    'Ma' => 1,
                    'Me' => 0,
                    'S' => 0,
                    'K' => 1,
                    'GM' => 0,
                    'GK' => $pertandingan['score_2'],
                    'Point' => 0,
                ]);
            } else {
                Standings::where('club', $pertandingan['club_1'])
                ->update([
                    'Ma' => $cekClub1->Ma + 1,
                    'Me' => $cekClub1->Me,
                    'S' => $cekClub1->S + 0,
                    'K' => $cekClub1->K + 1,
                    'GM' => $cekClub1->GM,
                    'GK' => $cekClub1->GK + $pertandingan['score_2'],
                    'Point' => $cekClub1->Point + 0,
                ]);
            }

            // club 2 menang
            if($cekClub2 == null) {
                Standings::create([
                    'club' => $pertandingan['club_2'],
                    'Ma' => 1,
                    'Me' => 1,
                    'S' => 0,
                    'K' => 0,
                    'GM' => $pertandingan['score_2'],
                    'GK' => 0,
                    'Point' => 3,
                ]);
            } else {
                Standings::where('club', $pertandingan['club_2'])
                ->update([
                    'Ma' => $cekClub2->Ma + 1,
                    'Me' => $cekClub2->Me + 1,
                    'S' => $cekClub2->S + 0,
                    'K' => 0,
                    'GM' => $cekClub2->GM + $pertandingan['score_2'],
                    'GK' => 0,
                    'Point' => $cekClub2->Point + 3,
                ]);
            }
        }
        
        Score::create($validate);
        
        return redirect('/')->with('success', 'Skor Berhasil dibuat 😊');
    }
}
