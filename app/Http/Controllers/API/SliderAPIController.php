<?php

namespace App\Http\Controllers\API;


use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class SliderController
 * @package App\Http\Controllers\API
 */

class SliderAPIController extends Controller
{
    /** @var  SliderRepository */
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
    }

    /**
     * Display a listing of the Slider.
     * GET|HEAD /sliders
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->sliderRepository->pushCriteria(new RequestCriteria($request));
            $this->sliderRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            Flash::error($e->getMessage());
        }
        $sliders = $this->sliderRepository->all();

        return $this->sendResponse($sliders->toArray(), 'Sliders retrieved successfully');
    }

    /**
     * Display the specified Slider.
     * GET|HEAD /sliders/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Slider $slider */
        if (!empty($this->sliderRepository)) {
            $slider = $this->sliderRepository->findWithoutFail($id);
        }

        if (empty($slider)) {
            return $this->sendError('Slider not found');
        }

        return $this->sendResponse($slider->toArray(), 'Slider retrieved successfully');
    }



}
