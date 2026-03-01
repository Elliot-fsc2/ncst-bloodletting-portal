<?php

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Hospital;

new #[Layout('layouts.guest')] class extends Component {
    public $priorityHospitalTag;

    public function mount()
    {
        $hospital = Hospital::select('id', 'name')->withCount('forms')->orderBy('forms_count', 'asc')->first();

        $this->priorityHospitalTag = $hospital ? $hospital->name : 'Veterans Memorial Medical Center';
    }
};
?>

<div>
    @if ($priorityHospitalTag === 'Veterans Memorial Medical Center')
        <livewire:guest::vmmc />
    @elseif ($priorityHospitalTag === 'Tanza Specialists Medical Center')
        <livewire:guest::tsmcs />
    @elseif ($priorityHospitalTag === 'Red Cross')
        <livewire:guest::redcross />
    @elseif ($priorityHospitalTag === 'Emilio Aguinaldo Medical Center')
        <livewire:guest::eacmed-form />
    @elseif ($priorityHospitalTag === 'De La Salle University Medical Center')
        <livewire:guest::umc-form />
    @else
        <livewire:guest::vmmc />
    @endif
</div>
