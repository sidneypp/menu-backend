<?php

namespace App\Http\Requests;

use App\Enumerators\RequestAction;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $action = $this->route()->getActionMethod();
        switch ($action) {
            case RequestAction::STORE:
                return $this->onStore();
                break;
            case RequestAction::UPDATE:
                return $this->onUpdate();
                break;
            case RequestAction::SHOW:
            case RequestAction::DELETE:
                return ['id' => 'bail|integer|required|exists:customers,id'];
                break;
            default:
                return [];
        }
    }

    public function all($keys = null)
    {
        $data       = parent::all($keys);
        $data['id'] = $this->route('id');
        return $data;
    }

    private function onStore()
    {
        return [
            'first_name' => 'bail|string|required',
            'last_name'  => 'bail|string|required',
            'email'      => 'bail|string|required|unique:customers,email|max:255|email'
        ];
    }

    private function onUpdate()
    {
        return [
            'id'         => 'bail|integer|required|exists:customers,id',
            'first_name' => 'bail|string|sometimes',
            'last_name'  => 'bail|string|sometimes',
            'email'      => 'bail|string|sometimes|unique:customers,email|max:255|email'
        ];
    }
}
