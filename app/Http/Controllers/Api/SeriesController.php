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

    public function index()
    {
        return Series::all();
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

    public function update(Series $series, SeriesFormRequest $request)
    {
       $series->fill($request->all());
       $series->save();

       return $series;
    }

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}
