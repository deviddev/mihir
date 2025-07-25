<?php

namespace App\Http\Controllers;

use App\Models\Material;

class MaterialController
{
    public function show(string $year, string $month, Material $material)
    {
        return view('materials.show', [
            'material' => $material,
        ]);
    }
}
