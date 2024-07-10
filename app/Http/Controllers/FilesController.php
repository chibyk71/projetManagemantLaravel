<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function __invoke() {
        foreach (request()->ids as $id) {
            Files::find($id)->delete();
        }
    }
}
