<?php

namespace App\Http\Livewire\Admin\Settings\Integrations\Github;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class Settings extends Component
{
    /**
     * Github API public key.
     *
     * @var string
     */
    public $github_key;

    /**
     * Github API secret key.
     *
     * @var string
     */
    public $github_secret;

    /**
     * Github API Webhook.
     *
     * @var string
     */
    public $github_webhook_url;

    public function mount(): void
    {
        $this->github_key = env('INTEGRATION_GITHUB_KEY', '');
        $this->github_secret = env('INTEGRATION_GITHUB_SECRET', '');
        $this->github_webhook_url = env('INTEGRATION_GITHUB_WEBHOOK_URL', '');
    }

    public function store(): void
    {
        setEnvironmentValue([
            'integration_github_key' => $this->github_key,
            'integration_github_secret' => $this->github_secret,
            'integration_github_webhook_url' => $this->github_webhook_url,
        ]);

        Artisan::call('config:clear');

        $this->notify([
            'title' => __('Updated'),
            'message' => __('Your Github API Keys configuration have been correctly updated!'),
        ]);
    }

    public function render(): View
    {
        return view('admin.livewire.settings.integrations.github.settings');
    }
}
