<?php

namespace App\Livewire\Pages\Admin\Gallery\Slider;

use Livewire\{Component, WithFileUploads};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Gallery;

class Create extends Component
{
    use WithFileUploads;

    public $slider;
    public $file;
    public $type = 'carousel';

    public function rules(): array
    {
        return [
            'file' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'type' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Please select an image file to upload.',
            'file.image' => 'The uploaded file must be an image.',
            'file.mimes' => 'Only JPG, JPEG, PNG, WEBP, or GIF images are allowed.',
            'file.max' => 'The banner image must not exceed 10MB.',
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $gallery = Gallery::create([
                'galleries_type' => $this->type,
                'galleries_status' => true,
            ]);

            $gallery->addMedia($this->file)->toMediaCollection('gallery');

            DB::commit();

            session()->flash('success', 'Hero Carousel banner uploaded and published successfully!');
            return redirect()->route('admin.gallery');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Hero carousel upload failed: ' . $e->getMessage(), ['exception' => $e]);
            session()->flash('error', 'Failed to upload banner: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.gallery.slider.create');
    }
}
