<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
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
        return [
            'custom_slug'   => 'required|alpha|max:10',
            'redirect_url'   => 'required|unique:link_mappings,redirect_url|url'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'custom_slug.alpha' => 'Please use alpha characters only',
            'redirect_url.required' => 'Please enter a URL to shorten.',
            'redirect_url.url' => 'Please enter a valid URL (e.g. http://test.com)'
        ];
    }
}
