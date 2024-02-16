<?php

namespace App\Http\Controllers;

use App\Models\CSVModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $csvs = CSVModel::latest()->paginate(10);
    
        return view('home', compact('csvs'));
    }
}
