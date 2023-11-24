<?php

namespace App\Livewire\Web\Partials;

use App\Events\Web\CityChangedEvent;
use App\Managers\Web\CityManager;
use App\Repositories\RegionRepository;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CityPicker extends Component
{
    public string $search = '';

    public array $regions = [];

    public function mount(): void
    {
        $this->regions = (new RegionRepository)->cityPicker();
    }

    public function updatedSearch(string $value): void
    {
        $this->regions = (new RegionRepository)->cityPicker($value);
    }

    public function cityPicked(string $alias): void
    {
        CityChangedEvent::dispatch($alias);

        $this->redirectRoute('web.index');
    }

    public function render(): View
    {
        return view('livewire.web.partials.city-picker', [
            'currentCity' => app(CityManager::class)->getCity()->name,
        ]);
    }
}
