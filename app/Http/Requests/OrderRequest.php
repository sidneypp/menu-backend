<?php

namespace App\Http\Requests;

use App\Enumerators\OrderStatus;
use App\Enumerators\RequestAction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $action = $this->route()->getActionMethod();
        switch ($action) {
            case RequestAction::STORE:
                return $this->onStore();
                break;
            case RequestAction::UPDATE:
                return $this->onUpdate();
            default:
                return [];
        }
    }

    private function onStore()
    {
        return [
            'status'      => [
                'string',
                'sometimes',
                Rule::in(OrderStatus::NEW, OrderStatus::DELIVERED, OrderStatus::PENDING)
            ],
            'customer_id' => 'integer|required|exists:customers,id',
            'value'       => 'integer|required'
        ];
    }

    private function onUpdate()
    {
        return [
            'status'      => [
                'string',
                'sometimes',
                Rule::in(OrderStatus::NEW, OrderStatus::DELIVERED, OrderStatus::PENDING)
            ],
            'customer_id' => 'integer|sometimes|exists:customers,id',
            'value'       => 'integer|sometimes'
        ];
    }
}
