<?php
namespace App\Modules\AsistenteEducacion\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function index()
    {
        return view('AsistenteEducacion::prueba');
    }
    public function create()
    {
        return view('MvSolicitudEstab::Livewire.create-livewire');
    }

}