<?php

namespace App\Http\Requests;

use AllowDynamicProperties;
use App\Rules\CheckCardBank;

#[AllowDynamicProperties] class TransferPaymentRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'source_card_number' => ['required', 'string', 'exists:cards,number', new CheckCardBank()],
            'dest_card_number'   => ['required', 'string', new CheckCardBank()],
            'amount'             => 'required|integer|between:' .
                config('transfer.payment.min_transfer_amount') . ',' .
                config('transfer.payment.max_transfer_amount'),
            'cvv2'               => 'required|string|min:3|max:4',
            'password'           => 'required',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge(
            [
                'amount'             => (int)english($this->amount),
                'source_card_number' => english($this->source_card_number),
                'dest_card_number'   => english($this->dest_card_number),
            ]
        );
    }
}
