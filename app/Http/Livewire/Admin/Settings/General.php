<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Admin\System\Country;
use App\Models\Admin\System\Currency;
use App\Models\Admin\System\Setting;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;

class General extends Component
{
    use WithFileUploads;

    public string $name;

    public string $email;

    public string $street_address;

    public string $zipcode;

    public string $city;

    public ?string $legal_name = null;

    public ?string $phone_number = null;

    public ?string $about = null;

    public ?string $facebook_link = null;

    public ?string $instagram_link = null;

    public ?string $twitter_link = null;

    public ?string $youtube_link = null;

    public ?string $whatsapp_link = null;

    public ?string $android_url = null;

    public ?string $ios_url = null;

    public ?string $primary_color = null;

    public ?string $secondary_color = null;

    public ?string $logo = null;

    public ?string $favicon = null;

    public ?string $cover = null;

    public ?string $country_id = null;

    public ?string $currency_id = null;

    public ?string $seo_title = null;

    public ?string $seo_description = null;

    public ?string $seo_keyword = null;

    public $tmp_logo;

    public $tmp_cover;

    public $tmp_favicon;

    protected $listeners = [
        'trix:valueUpdated' => 'onTrixValueUpdate',
    ];

    public function mount(): void
    {
        $settings = Setting::whereIn('key', [
            'name',
            'legal_name',
            'email',
            'logo',
            'cover',
            'favicon',
            'about',
            'country_id',
            'currency_id',
            'street_address',
            'zipcode',
            'city',
            'phone_number',
            'facebook_link',
            'instagram_link',
            'twitter_link',
            'youtube_link',
            'whatsapp_link',
            'android_url',
            'ios_url',
            'primary_color',
            'secondary_color',
            'seo_title',
            'seo_description',
            'seo_keyword',
        ])->select('value', 'key')
            ->get()
            ->toArray();

        foreach ($settings as $setting) {
            $this->{$setting['key']} = $setting['value'] ?? null;
        }
    }

    public function onTrixValueUpdate(string $value): void
    {
        $this->about = $value;
    }

    public function store(): void
    {
        $this->validate($this->rules());

        $keys = [
            'name',
            'legal_name',
            'email',
            'logo',
            'favicon',
            'about',
            'country_id',
            'currency_id',
            'street_address',
            'zipcode',
            'city',
            'phone_number',
            'facebook_link',
            'instagram_link',
            'twitter_link',
            'youtube_link',
            'whatsapp_link',
            'android_url',
            'ios_url',
            'primary_color',
            'secondary_color',
            'seo_title',
            'seo_description',
            'seo_keyword',
        ];

        foreach ($keys as $key) {
            $this->createUpdateSetting(key: $key, value: $this->{$key});
        }

        if ($this->tmp_logo) {
            $this->createUpdateSetting(
                key: 'logo',
                value: $this->tmp_logo->store('/', config('system.storage.disks.uploads'))
            );
        }

        if ($this->tmp_cover) {
            $this->createUpdateSetting(
                key: 'cover',
                value: $this->tmp_cover->store('/', config('system.storage.disks.uploads'))
            );
        }

        if ($this->tmp_favicon) {
            $this->createUpdateSetting(
                key: 'favicon',
                value: $this->tmp_favicon->store('/', config('system.storage.disks.uploads'))
            );
        }

        setEnvironmentValue([
            'mail_from_name' => $this->name,
            'mail_from_address' => $this->email,
        ]);

        Notification::make()
            ->title(__('layout.status.updated'))
            ->body(__('Shop informations have been correctly updated'))
            ->success()
            ->send();
    }

    public function rules(): array
    {
        return [
            'cover' => 'nullable|image|max:1024',
            'logo' => 'nullable|image|max:1024',
            'favicon' => 'nullable|image|max:1024',
            'name' => 'required|max:100',
            'legal_name' => 'required|max:100',
            'email' => 'required|email',
            'country_id' => 'required',
            'currency_id' => 'required',
            'street_address' => 'required|string',
            'zipcode' => 'required',
            'city' => 'required',
        ];
    }

    public function createUpdateSetting(string $key, mixed $value): void
    {
        Setting::query()->updateOrCreate(['key' => $key], [
            'value' => $value,
            'display_name' => Setting::lockedAttributesDisplayName($key),
            'locked' => true,
        ]);
    }

    public function removeLogo(): void
    {
        $this->tmp_logo = null;
    }

    public function removeCover(): void
    {
        $this->tmp_cover = null;
    }

    public function removeFavicon(): void
    {
        $this->tmp_favicon = null;
    }

    public function deleteCover(): void
    {
        Setting::query()->updateOrCreate(['key' => 'cover'], [
            'value' => null,
            'display_name' => Setting::lockedAttributesDisplayName('shop_cover'),
            'locked' => true,
        ]);

        $this->cover = null;

        Notification::make()
            ->title(__('layout.status.delete'))
            ->body(__('Shop cover have been correctly removed'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('admin.livewire.settings.general', [
            'countries' => Cache::rememberForever('countries', fn () => Country::query()->orderBy('name')->get()),
            'currencies' => Cache::rememberForever('currencies', fn () => Currency::all()),
        ]);
    }
}
