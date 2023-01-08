<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
        # code...
    }

    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has('nome')) {
            $query->where('nome', $request->nome);
        }
        return $query->paginete(5);
    }


    public function store(SeriesFormRequest $request)
    {
        return response()
        ->json(Series::create($request->all()), 201);
    }

    public function show(int $series)
    {
        $series = Series::whereId($series)
         ->with('seasons.episodes')
         ->first();
        return $series;
    }

    public function update(int $series, SeriesFormRequest $request)
{
    Series::where('id', $series)->update($request->all());
    // retorno de uma resposta que não contenha a série, já que não fizemos um `SELECT` 
}

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}
