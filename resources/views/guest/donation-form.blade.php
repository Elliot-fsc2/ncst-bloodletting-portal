<?php

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Hospital;

new #[Layout('layouts.guest')]
  class extends Component {

  public $priorityHospitalTag;

  public function mount()
  {
    // 1. Get hospitals and their form counts
    // We use a Left Join to include hospitals that have 0 donors yet
    $hospital = Hospital::select('id', 'name')
      ->withCount('forms')
      ->orderBy('forms_count', 'asc') // Lowest count first
      ->first();
    // dd($hospital);

    // 2. Set the tag (e.g., 'vmmc', 'red-cross', etc.)
    // Ensure your hospitals table has a 'slug' column matching your component names
    $this->priorityHospitalTag = $hospital ? $hospital->name : 'Veterans Memorial Medical Center';
  }
}; ?>

<div>
  @if ($priorityHospitalTag === 'Veterans Memorial Medical Center')
    <livewire:guest::vmmc />
  @elseif ($priorityHospitalTag === 'Tanza Specialists Medical Center')
    <livewire:guest::tsmcs />
  @elseif ($priorityHospitalTag === 'Red Cross')
    hi
  @endif
</div>