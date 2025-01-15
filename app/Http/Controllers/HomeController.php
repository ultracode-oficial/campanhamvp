<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Grupo;
use carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {

        $pessoas = Grupo::where('lat','!=',null)->where('tipo','colaborador')->get(['lat','lng','nome','tipo','foto','apelido']);


        // $lideres = Grupo::where('lat','!=',null)->where('tipo','lideranca')->get(['lat','lng','nome','tipo','foto','apelido']);
        $lideres = Grupo::select('nome', 'lat', 'lng', 'tipo', 'foto', 'apelido')
                        ->whereNotNull('lat')
                            ->where('tipo', 'lideranca')
                                ->withCount('liderados')
                                    ->get();
        // dd($lideres[0]);

        $qtd_lider = Grupo::where('tipo','Lideranca')->count();

        $qtd_colabora = Grupo::where('tipo','colaborador')->count();

        $qtd_indeciso = Grupo::where('tipo','indeciso')->count();

        return view('pages.home', compact('qtd_lider','qtd_colabora','qtd_indeciso','pessoas','lideres'));
    }


}

    // ⠩⡳⢤⡈⣑⣲⣦⣬⣉⡙⠛⠋⣁⣴⣶⣿⣿⡿⢟⣽⣾⣿⣿⣿⣿⣿⣿⣿⣾⣔⡲⠦⠤⠄⢈⣙⣡⣶⠏⣈
    // ⡷⢠⣤⢀⣌⠠⣄⣀⠈⢁⣴⣾⣿⣿⣿⣿⢟⣵⣿⣿⣻⣷⢿⣾⢷⣿⣽⣯⣿⣿⣿⣶⡒⠫⠉⠉⡁⣀⡁⢠
    // ⡇⢰⣣⣾⡿⢃⡿⢁⢴⣿⣿⣿⡻⢟⡽⢣⣾⣿⣿⣿⡿⣿⣿⣿⣯⢿⣟⣿⣷⣿⣻⡿⣿⡜⠇⢞⡅⣿⣿⠈
    // ⣿⡈⠾⢋⣴⠋⢠⢎⢿⣿⢇⢕⣝⡵⢋⣿⡿⣽⣿⣻⣿⣿⣽⣷⣿⣹⣿⢿⣾⣯⣿⢿⣿⣿⣖⢌⠪⣻⠍⣤
    // ⣿⣿⣿⡿⠁⣴⠳⡵⢸⢯⠪⢳⠮⣩⣸⣿⢳⣿⣿⢿⣷⣿⣻⣞⣿⡏⣿⣿⣻⣷⣿⣿⣯⣿⣿⡜⡧⣤⢺⡜
    // ⣿⣿⡿⠁⢸⢕⠏⢝⣿⣾⣞⣿⣿⡇⣿⡗⢸⣿⣿⢿⣷⡿⣿⣿⡸⣷⢻⣿⣻⣿⣾⣷⣿⣻⣿⣷⠱⣕⠧⠛
    // ⣿⡿⠁⣼⠂⡯⣷⣿⣿⡿⣏⣿⣿⠇⣩⢳⡎⣿⣿⡟⢿⣿⣻⣿⡇⣿⢸⣿⣿⣷⣿⣽⣿⣽⣿⣿⢌⣿⣿⣿
    // ⣿⠃⣼⣕⣿⡺⣫⠩⣵⣾⣛⣩⣴⣾⣹⢼⣷⡹⣿⣿⣦⣌⣛⠿⣇⢞⢠⣿⣷⣿⣽⣿⣾⣿⣾⣿⡻⢿⢿⡞
    // ⠏⠈⣜⢣⡯⠀⠉⠁⣀⠉⡙⢿⣿⣿⣯⠎⣿⣧⡹⣿⣿⣿⠿⠿⠙⡸⠸⢸⣿⣯⣿⣾⣿⣾⣯⣿⡇⣟⣕⠹
    // ⠀⢸⣿⡃⢀⣠⡾⣋⣭⣭⡓⢦⡻⣿⣿⣷⣿⢿⣷⣝⢟⣵⠾⡋⡒⠖⣄⠸⡝⢿⡿⣷⢿⣷⣿⡯⢻⣷⢱⡳
    // ⠀⣾⢿⣿⢾⡝⠰⣿⣿⣿⣟⡀⠹⣿⣿⣿⣿⣿⣿⣿⠋⣵⣿⣿⣿⡗⡈⠣⣇⢣⢿⢻⣿⢿⣾⣧⡓⢥⡳⡝
    // ⢠⢫⣷⣶⢮⡁⣷⣾⣭⣩⣿⣿⡅⣿⣿⣿⣿⣿⣿⡟⣐⣭⡟⡛⣫⣶⣬⠒⣻⢜⠢⣻⣿⡿⣿⣿⡇⢗⣖⠞
    // ⣞⢿⡿⡱⣑⡟⣹⣶⢎⣿⡿⡻⢣⣿⣿⣿⣿⣿⣿⣇⢺⣟⣽⣿⡿⠿⢿⢧⣾⣿⣷⢾⢿⡿⣿⣽⡷⣿⣿⣿
    // ⢂⣷⣭⢨⣭⣞⢲⡶⣾⣳⣿⣿⠛⠛⠛⢻⢋⣙⠻⣿⣷⣶⣷⣶⣇⣛⣃⢫⢄⡻⢿⡿⣸⣿⡿⣿⠇⣯⣟⣣
    // ⣸⣿⣿⢸⡟⣽⣍⢿⣿⣽⣷⣿⠁⡾⣹⡽⣯⣟⣷⡘⣿⣿⣿⣯⣿⣽⣟⡗⡬⣭⣵⣾⣿⣿⢫⣿⢸⢨⣝⣫
    // ⣿⣻⣟⣆⠣⢻⡱⡸⣻⣿⣿⣿⡀⣿⣝⣿⡺⣷⢽⣇⣿⣿⢿⣥⣟⠷⠋⢞⣼⣿⣿⡿⣿⢧⡫⡿⡸⢪⡿⣹
    // ⣧⢿⢿⣧⢰⢄⡲⢾⣿⣿⣿⣿⣷⣌⣳⣯⣿⣙⣯⣾⣿⣏⢟⢛⢽⣿⡟⣾⣿⣿⣻⣿⢏⢰⡝⢇⡟⡸⢡⣿
    // ⣿⡏⢮⢷⢾⣜⢎⠶⠈⣩⣛⡛⠿⠿⠿⣿⣿⣿⣿⠿⠿⠿⠮⣁⣣⡭⣸⣿⣿⣽⣟⣿⢰⠸⡚⢸⠤⡒⣼⢟
    // ⣿⡇⢳⡊⠮⠽⠀⣰⣿⣯⢏⣉⡙⡛⠷⡢⠔⢖⢒⠺⣿⣵⡽⣸⣗⡇⣿⣿⣺⢷⣟⣷⢨⠙⡱⡘⡡⡚⣍⢔
    // ⣷⣿⣷⣏⠪⢁⢸⣿⣿⣿⠰⡌⡊⡪⢪⠸⠞⣌⢃⠓⠲⡔⢹⣿⣿⡇⣿⡷⣯⢟⡾⣽⣎⠪⡱⢰⡩⢪⢢⡑
