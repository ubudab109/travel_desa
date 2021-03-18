<?php
/**
 * File name: UpdateStoreRequest.php
 * Last modified: 2020.04.29 at 18:01:28
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();

        $input['drivers'] = isset($input['drivers']) ? $input['drivers'] : [];

        if (auth()->user()->hasRole('admin')) {
            $input['users'] = isset($input['users']) ? $input['users'] : [];
            $input['fields'] = isset($input['fields']) ? $input['fields'] : [];
            $this->replace($input);
            return Store::$adminRules;

        } else {
            unset($input['users']);
            unset($input['fields']);
            $this->replace($input);
            return Store::$managerRules;
        }


    }
}
