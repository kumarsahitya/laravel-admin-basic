<?php

declare(strict_types=1);

use App\Models\admin\Shop\Order\Order;
use App\Models\admin\System\Currency as CurrencyModel;
use App\Models\admin\System\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     */
    function app_name(): string
    {
        return ! empty(config('db_custom.name')) ? config('db_custom.name') : config('app.name');
    }
}

if (! function_exists('generate_number')) {
    /**
     * Generate Order Number.
     */
    function generate_number(): string
    {
        $lastOrder = Order::query()->orderBy('id', 'desc')->limit(1)->first();

        $generator = [
            'start_sequence_from' => 1,
            'prefix' => '#',
            'pad_length' => 1,
            'pad_string' => '0',
        ];

        $last = $lastOrder ? $lastOrder->id : 0;
        $next = $generator['start_sequence_from'] + $last;

        return sprintf(
            '%s%s',
            $generator['prefix'],
            str_pad((string) $next, $generator['pad_length'], $generator['pad_string'], STR_PAD_LEFT)
        );
    }
}

if (! function_exists('setEnvironmentValue')) {
    /**
     * Function to set or update .env variable.
     */
    function setEnvironmentValue(array $values): bool
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            $str .= "\n"; // In case the searched variable is in the last line without \n
            foreach ($values as $envKey => $envValue) {
                if ($envValue === true) {
                    $value = 'true';
                } elseif ($envValue === false) {
                    $value = 'false';
                } else {
                    $value = $envValue;
                }

                $envKey = mb_strtoupper($envKey);
                $keyPosition = (int) mb_strpos($str, "{$envKey}=");
                $endOfLinePosition = (int) mb_strpos($str, "\n", $keyPosition);
                $oldLine = mb_substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                $space = mb_strpos($value, ' ');
                $envValue = $space === false ? $value : '"'.$value.'"';

                // If key does not exist, add it
                if (! $keyPosition || ! $endOfLinePosition || ! $oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
                env($envKey, $envValue);
            }
        }

        $str = mb_substr($str, 0, -1);

        if (! file_put_contents($envFile, $str)) {
            return false;
        }

        return true;
    }
}

if (! function_exists('currency')) {
    /**
     * Return currency used.
     */
    function currency(): string
    {
        $settingCurrency = setting('shop_currency_id');

        if ($settingCurrency) {
            $currency = Cache::remember('currency', now()->addHour(), fn () => CurrencyModel::query()->find($settingCurrency));

            return $currency ? $currency->code : 'USD';
        }

        return 'USD';
    }
}

if (! function_exists('money_format')) {
    /**
     * Return money format.
     */
    function money_format($amount, ?string $currency = null): string
    {
        $money = new Money($amount, new Currency($currency ?? currency()));
        $currencies = new ISOCurrencies();

        $numberFormatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }
}

if (! function_exists('setting')) {
    /**
     * Return setting from the setting table.
     */
    function setting(string $key): mixed
    {
        $setting = Cache::remember("setting-{$key}", 60 * 60 * 24, fn () => Setting::query()->where('key', $key)->first());

        return $setting?->value;
    }
}

if (! function_exists('active')) {
    /**
     * Sets the menu item class for an active route.
     */
    function active($routes, string $activeClass = 'active', string $defaultClass = '', bool $condition = true): string
    {
        return call_user_func_array([app('router'), 'is'], (array) $routes) && $condition ? $activeClass : $defaultClass;
    }
}

if (! function_exists('is_active')) {
    /**
     * Determines if the given routes are active.
     */
    function is_active($routes): bool
    {
        return (bool) call_user_func_array([app('router'), 'is'], (array) $routes);
    }
}

if (! function_exists('load_asset')) {
    /**
     * Return the full path of an image.
     */
    function load_asset(string $file, string $disk = 'uploads'): string
    {
        return Storage::disk(config('system.storage.disks.'.$disk))->url($file);
    }
}
