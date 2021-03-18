<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Repositories\SliderRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\UploadRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class SliderController extends Controller
{
    /** @var  SliderRepository */
    private $sliderRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
  * @var UploadRepository
  */
private $uploadRepository;

    public function __construct(SliderRepository $sliderRepo, CustomFieldRepository $customFieldRepo , UploadRepository $uploadRepo)
    {
        parent::__construct();
        $this->sliderRepository = $sliderRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
    }

    /**
     * Display a listing of the Slider.
     *
     * @param SliderDataTable $sliderDataTable
     * @return Response
     */
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('sliders.index');
    }

    /**
     * Show the form for creating a new Slider.
     *
     * @return Response
     */
    public function create()
    {
        
        
        $hasCustomField = in_array($this->sliderRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->sliderRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('sliders.create')->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Store a newly created Slider in storage.
     *
     * @param CreateSliderRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->sliderRepository->model());
        try {
            $slider = $this->sliderRepository->create($input);
            $slider->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            if(isset($input['image']) && $input['image']){
    $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
    $mediaItem = $cacheUpload->getMedia('image')->first();
    $mediaItem->copy($slider, 'image');
}
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.slider')]));

        return redirect(route('sliders.index'));
    }

    /**
     * Display the specified Slider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect(route('sliders.index'));
        }

        return view('sliders.show')->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified Slider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);
        
        

        if (empty($slider)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.slider')]));

            return redirect(route('sliders.index'));
        }
        $customFieldsValues = $slider->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->sliderRepository->model());
        $hasCustomField = in_array($this->sliderRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('sliders.edit')->with('slider', $slider)->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Update the specified Slider in storage.
     *
     * @param  int              $id
     * @param UpdateSliderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderRequest $request)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            Flash::error('Slider not found');
            return redirect(route('sliders.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->sliderRepository->model());
        try {
            $slider = $this->sliderRepository->update($input, $id);
            
            if(isset($input['image']) && $input['image']){
    $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
    $mediaItem = $cacheUpload->getMedia('image')->first();
    $mediaItem->copy($slider, 'image');
}
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $slider->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.slider')]));

        return redirect(route('sliders.index'));
    }

    /**
     * Remove the specified Slider from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect(route('sliders.index'));
        }

        $this->sliderRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.slider')]));

        return redirect(route('sliders.index'));
    }

        /**
     * Remove Media of Slider
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $slider = $this->sliderRepository->findWithoutFail($input['id']);
        try {
            if($slider->hasMedia($input['collection'])){
                $slider->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
