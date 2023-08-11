<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Score;
use App\Models\Standings;

class MultipleForm extends Component
{
    public $club_1, $club_2, $score_1, $score_2;
    public $inputs = [];
    public $i = 1;
      
    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }
      
    
    public function remove($i)
    {
        unset($this->inputs[$i]);
    }
      
    public function render()
    {
        return view('livewire.multiple-form');
    }

    private function resetInputFields(){
        $this->club_1 = '';
        $this->club_2 = '';
        $this->score_1 = '';
        $this->score_2 = '';
    }

    public function store()
    {
            $this->validate([
                'club_1.0' => 'required',
                'club_2.0' => 'required',
                'score_1.0' => 'required',
                'score_2.0' => 'required',
                'club_1.*' => 'required',
                'club_2.*' => 'required',
                'score_1.*' => 'required',
                'score_2.*' => 'required',
            ], 
            [
                'club_1.0.required' => 'Klub 1 harus diisi.',
                'club_2.0.required' => 'Klub 2 harus diisi.',
                'score_1.0.required' => 'Skor 1 harus diisi.',
                'score_2.0.required' => 'Skor 2 harus diisi.',
                'club_1.*.required' => 'Klub 1 harus diisi.',
                'club_2.*.required' => 'Klub 2 harus diisi.',
                'score_1.*.required' => 'Skor 1 harus diisi.',
                'score_2.*.required' => 'Skor 2 harus diisi.',
            ]);
   
        foreach ($this->club_1 as $key => $value) {
            $club_1 = $this->club_1;
            $club_2 = $this->club_2;

            $existingMatch = Score::where(function ($query) use ($club_1, $club_2) {
                $query->where('club_1', $club_1)->where('club_2', $club_2);
            })->first();

            if ($existingMatch) {
                return redirect('/score')
                    ->with('error', "Data pertandingan pada baris sama dengan data yang sudah ada.");
            }

            $cekClub1 = Standings::where('club', $this->club_1)->first();
            $cekClub2 = Standings::where('club', $this->club_2)->first();
    
            if($this->score_1[$key] > $this->score_2[$key]) {
                // club 1 menang
                if($cekClub1 == null) {
                    Standings::create([
                        'club' => $this->club_1[$key],
                        'Ma' => 1,
                        'Me' => 1,
                        'S' => 0,
                        'K' => 0,
                        'GM' => $this->score_1[$key],
                        'GK' => 0,
                        'Point' => 3,
                    ]);
                } else {
                    Standings::where('club', $this->club_1[$key])
                    ->update([
                        'Ma' => $cekClub1->Ma + 1,
                        'Me' => $cekClub1->Me + 1,
                        'S' => $cekClub1->S + 0,
                        'K' => 0,
                        'GM' => $cekClub1->GM + $this->score_1[$key],
                        'GK' => 0,
                        'Point' => $cekClub1->Point + 3,
                    ]);
                }
    
                // club 2 kalah
                if($cekClub2 == null) {
                    Standings::create([
                        'club' => $this->club_2[$key],
                        'Ma' => 1,
                        'Me' => 0,
                        'S' => 0,
                        'K' => 1,
                        'GM' => 0,
                        'GK' => $this->score_2[$key],
                        'Point' => 0,
                    ]);
                } else {
                    Standings::where('club', $this->club_2[$key])
                    ->update([
                        'Ma' => $cekClub2->Ma + 1,
                        'Me' => $cekClub2->Me,
                        'S' => 0,
                        'K' => $cekClub2->K + 1,
                        'GM' => $cekClub2->GM,
                        'GK' => $cekClub2->GK + $this->score_1[$key],
                        'Point' => $cekClub2->Point + 0,
                    ]);
                }
            } elseif($this->score_1[$key] == $this->score_2[$key]) {
                    // club 1 seri
                    if($cekClub1 == null) {
                        Standings::create([
                            'club' => $this->club_1[$key],
                            'Ma' => 1,
                            'Me' => 0,
                            'S' => 1,
                            'K' => 0,
                            'GM' => 0,
                            'GK' => 0,
                            'Point' => 1,
                        ]);
                    } else {
                        Standings::where('club', $this->club_1[$key])
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
                            'club' => $this->club_2[$key],
                            'Ma' => 1,
                            'Me' => 0,
                            'S' => 1,
                            'K' => 0,
                            'GM' => 0,
                            'GK' => 0,
                            'Point' => 1,
                        ]);
                    } else {
                        Standings::where('club', $this->club_2[$key])
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
            } elseif($this->score_1[$key] < $this->score_2[$key]) {
    
                // club 1 kalah
                if($cekClub1 == null) {
                    Standings::create([
                        'club' => $this->club_1[$key],
                        'Ma' => 1,
                        'Me' => 0,
                        'S' => 0,
                        'K' => 1,
                        'GM' => 0,
                        'GK' => $this->score_2[$key],
                        'Point' => 0,
                    ]);
                } else {
                    Standings::where('club', $this->club_1[$key])
                    ->update([
                        'Ma' => $cekClub1->Ma + 1,
                        'Me' => $cekClub1->Me,
                        'S' => $cekClub1->S + 0,
                        'K' => $cekClub1->K + 1,
                        'GM' => $cekClub1->GM,
                        'GK' => $cekClub1->GK + $this->score_2[$key],
                        'Point' => $cekClub1->Point + 0,
                    ]);
                }
    
                // club 2 menang
                if($cekClub2 == null) {
                    Standings::create([
                        'club' => $this->club_2[$key],
                        'Ma' => 1,
                        'Me' => 1,
                        'S' => 0,
                        'K' => 0,
                        'GM' => $this->score_2[$key],
                        'GK' => 0,
                        'Point' => 3,
                    ]);
                } else {
                    Standings::where('club', $this->club_2[$key])
                    ->update([
                        'Ma' => $cekClub2->Ma + 1,
                        'Me' => $cekClub2->Me + 1,
                        'S' => $cekClub2->S + 0,
                        'K' => 0,
                        'GM' => $cekClub2->GM + $this->score_2[$key],
                        'GK' => 0,
                        'Point' => $cekClub2->Point + 3,
                    ]);
                }
            }

            Score::create([
                'club_1' => $this->club_1[$key], 
                'club_2' => $this->club_2[$key], 
                'score_1' => $this->score_1[$key], 
                'score_2' => $this->score_2[$key],     
            ]);
        }
  
        $this->inputs = [];
   
        $this->resetInputFields();
   
        return redirect('/')->with('success', 'Skor Berhasil dibuat 😊');
    }
}
