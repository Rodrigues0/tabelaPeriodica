<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ElementoController extends Controller
{
    public function index()
    {
        // Alterado de resource_path para storage_path apontando para app/data:
        $caminhoJson = storage_path('app/data/elements.json');

        $conteudo = File::get($caminhoJson);
        $elementos = json_decode($conteudo, true);

        return view('tabela', compact('elementos'));
    }
}