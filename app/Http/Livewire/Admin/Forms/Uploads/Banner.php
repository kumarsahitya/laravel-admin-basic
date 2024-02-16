<?php

namespace App\Http\Livewire\Admin\Forms\Uploads;

use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Banner extends Component
{
    use WithFileUploads;

    public $file;

    public $media;

    public string $inputId;

    protected $rules = [
        'file' => 'nullable|image|min:50|max:150|mimetypes:image/jpg,image/jpeg,image/png',
    ];

    public function mount($media = null): void
    {
        $this->media = $media;
        $this->inputId = 'single-upload-'.uniqid();
    }

    public function updatedFile($file): void
    {
        $this->validate($this->rules);
        $this->emitUp('fileUpdated', $file->getRealPath());
    }

    public function removeSingleMediaPlaceholder(): void
    {
        $this->resetErrorBag();
        $this->file = null;
        $this->emitUp('fileUpdated', null);
    }

    public function removeMedia(int $id): void
    {
        Media::find($id)->delete();

        $this->media = null;

        Notification::make()
            ->title(__('layout.status.removed'))
            ->body(__('Media removed from the storage.'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('admin.livewire.forms.uploads.banner');
    }
}
