<?php

namespace App\Http\Livewire\Admin\Settings\Integrations;

use App\Models\Shop\Channel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

use function in_array;

class Browse extends Component
{
    /**
     * Github status integration.
     */
    public bool $github = false;

    /**
     * Twitter status integration.
     */
    public bool $twitter = false;

    /**
     * The current provider to setup.
     */
    public string $currentProvider = '';

    /**
     * Provider description for channel update.
     */
    public string $message = '';

    /**
     * Confirmation to launch modal to setup an integration.
     */
    public bool $confirmModalActivation = false;

    /**
     * Component mount instance.
     */
    public function mount(): void
    {
        $this->github = env('INTEGRATION_GITHUB', false);
        $this->twitter = env('INTEGRATION_TWITTER', false);
    }

    /**
     * Confirmation modal.
     */
    public function confirmationEnable(string $provider, ?string $message = null): void
    {
        $this->currentProvider = $provider;
        $this->confirmModalActivation = true;
        $this->message = $message
            ? __($message)
            : __('You are about to activate :provider for your store. This will allow you to have more options to improve your store.', ['provider' => $this->currentProvider]);
    }

    /**
     * Enable provider and update environnement variables.
     */
    public function enableProvider(): void
    {
        setEnvironmentValue(['integration_'.mb_strtolower($this->currentProvider) => true]);

        $this->{$this->currentProvider} = true;

        $provider = $this->currentProvider;

        if (in_array($this->currentProvider, $this->availableDatabaseChannels())) {
            $this->createChannel($this->currentProvider);
        }

        Artisan::call('config:clear');

        $this->closeIntegrationModal();

        $this->notify([
            'title' => __('Enabled'),
            'message' => __('You have been successfully enabled :provider', ['provider' => $provider]),
        ]);
    }

    /**
     * Create a newly channel on the storage.
     */
    public function createChannel(string $channel): void
    {
        Channel::query()->create([
            'name' => ucfirst($channel),
            'slug' => str_slug($channel),
        ]);
    }

    /**
     * Close confirmation modal.
     */
    public function closeIntegrationModal(): void
    {
        $this->confirmModalActivation = false;
        $this->currentProvider = '';
    }

    public function render(): View
    {
        return view('admin.livewire.settings.integrations.browse');
    }

    /**
     * Return the list of channel to add.
     *
     * @return array<string>
     */
    protected function availableDatabaseChannels(): array
    {
        return [
            'twitter',
            'facebook',
            'instagram',
            'telegram',
        ];
    }
}
