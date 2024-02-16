<?php

namespace App\Http\Livewire\Admin\Forms\Uploads;

use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Single extends Component
{
    use WithFileUploads;

    public $file;

    public $media;

    public $onlyJpgPng;

    public string $inputId;

    public $rules = [
        'file' => 'nullable|image|max:5120',
    ];

    public function mount($media = null, $onlyJpgPng = null): void
    {
        $this->media = $media;
        $this->inputId = 'single-upload-'.uniqid();
        $this->onlyJpgPng = $onlyJpgPng;
        if ($this->onlyJpgPng) {
            $this->rules['file'] = 'nullable|image|max:5120|mimetypes:image/jpg,image/jpeg,image/png';
        }
    }

    public function updatedFile($file): void
    {
        $this->validate($this->rules);
        $this->emitUp('fileUpdated', $file->getRealPath());
    }

    public function removeSingleMediaPlaceholder(): void
    {
        $this->file = null;
    }

    public function removeMedia(int $id): void
    {
        Media::find($id)->delete();

        $this->media = null;

        Notification::make()
            ->title(__('Removed'))
            ->body(__('Media removed from the storage.'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('admin.livewire.forms.uploads.single', ['mimeTypes' => $this->onlyJpgPng ? 'image/jpg,image/jpeg,image/png' : '']);
    }
}
