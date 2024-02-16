<?php

namespace App\Helpers;

use App\Models\admin\Traits\HasPrice;

class Price
{
    use HasPrice;

    public int $amount;

    public string $formatted;

    public string $currency;

    public function __construct(public int $cent)
    {
        $this->amount = $cent / 100;
        $this->currency = currency();
        $this->formatted = $this->formattedPrice($this->amount);
    }

    public static function from(int $cent): self
    {
        return new self($cent);
    }
}
