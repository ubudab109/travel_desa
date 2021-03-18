<?php
/**
 * File name: CreateStoreRequest.php
 * Last modified: 2020.04.28 at 21:56:10
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class CreateStoreRequest extends FormRequest
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
        if (auth()->user()->hasRole('admin')) {
            return Store::$adminRules;
        } elseif (auth()->user()->hasRole('manager')||auth()->user()->hasRole('client')) {
            return Store::$managerRules;
        }
    }
}
