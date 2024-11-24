<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Http\Resources\EvaluationResource;
use App\Models\Evaluation;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::all();
        return EvaluationResource::collection($evaluations);
    }

    public function store(StoreEvaluationRequest $request)
    {
        $evaluation = Evaluation::create($request->validated());
        return new EvaluationResource($evaluation);
    }

    public function update(UpdateEvaluationRequest $request, $id)
    {
        $evaluation = Evaluation::find($id);

        if ($evaluation == null) return response(null, 404);

        $validated = $request->validated();

        $evaluation->evaluation = $validated["evaluation"];
        $evaluation->save();

        return response(null, 200);
    }

    public function destroy($id)
    {
        $evaluation = Evaluation::find($id);

        if($evaluation == null) return response(null, 404);
        
        $evaluation->delete();
        return response(null, 204);
    }
}
