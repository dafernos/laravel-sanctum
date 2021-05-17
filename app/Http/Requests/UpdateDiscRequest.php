<?php

namespace App\Http\Requests;

use App\Rules\StringLenghtRule;
use App\Rules\StringRequiredRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'author'            => 'string|min:2|max:255',
            'title'             => 'string|min:2|max:255',
            'album'             => 'string|min:2|max:255',
            'published_at'      => 'date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages() : array
    {
        return [
            'author.string'         => trans('validation.string'),
            'author.min'            => trans('validation.min'),
            'author.max'            => trans('validation.max'),
            'title.string'          => trans('validation.string'),
            'title.min'             => trans('validation.min'),
            'title.max'             => trans('validation.max'),
            'album.string'          => trans('validation.string'),
            'album.min'             => trans('validation.min'),
            'album.max'             => trans('validation.max'),
            'published_at.date'     => trans('validation.date'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() : array
    {
        return [

        ];
    }
}
