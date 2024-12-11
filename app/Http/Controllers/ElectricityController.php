<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ElectricityRequest;
use App\Http\Resources\ElectricityResource;
use App\Repositories\ElectricityRepository;
use Carbon\Carbon;

class ElectricityController extends Controller
{
    /**
     * @OA\Info(
     *      version="1.0",
     *      title="API"
     * )
     *
     * @OA\Server(url="https://test.lndo.site/")
     *
     * @OA\SecurityScheme(
     *   securityScheme="bearer",
     *   type="http",
     *   scheme="bearer",
     * )
     **/

    public function __construct(private ElectricityRepository $electricityRepository)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/v1/electricity-price",
     *      tags={"Electricity"},
     *      summary="ElectricityList",
     *      @OA\Parameter(in="query", name="datetime", required=false, example="2024-10-12 11:10:00",
     *          @OA\Schema(
     *              type="string",
     *              format="date"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="area", type="string", example="LV"),
     *              @OA\Property(property="currency", type="string", example="EUR"),
     *              @OA\Property(property="price", type="number", example="100"),
     *              @OA\Property(property="delivery_start", type="string", format="date", example="2024-02-02"),
     *              @OA\Property(property="delivery_end", type="string", format="date", example="2024-02-02"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
    public function getElectricityPrice(ElectricityRequest $request)
    {
        $date = $request->get('datetime') ? Carbon::parse($request->get('datetime')) : now();

        $electricityByHour = $this->electricityRepository->getByHour($date);

        return ElectricityResource::collection($electricityByHour);
    }
}
