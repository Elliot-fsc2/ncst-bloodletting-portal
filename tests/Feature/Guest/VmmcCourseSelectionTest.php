<?php

use App\Models\Course;
use App\Models\Department;
use App\Models\Form;
use App\Models\Hospital;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

function seedRequiredVmmcData(): array
{
    $hospital = Hospital::query()->create([
        'name' => 'Veterans Memorial Medical Center',
    ]);

    $department = Department::query()->create([
        'name' => 'Computer Studies',
    ]);

    $course = Course::query()->create([
        'name' => 'Bachelor of Science in Computer Science',
        'department_id' => $department->id,
    ]);

    return [$hospital, $course, $department];
}

function fillVmmcStepOne($component, Course $course, string $email): void
{
    $component
        ->set('personal.surname', 'Doe')
        ->set('personal.given_name', 'John')
        ->set('personal.middle_name', 'Santos')
        ->set('personal.birthdate', '1998-01-01')
        ->set('personal.sex', 'Male')
        ->set('personal.civil_status', 'Single')
        ->set('personal.occupation', 'Student')
        ->set('personal.bloodtype', 'O+')
        ->set('personal.house_heroes', 'Makadiyos')
        ->set('personal.barangay', 'Salitran')
        ->set('personal.city_province', 'Dasmarinas, Cavite')
        ->set('personal.contact_number', '09123456789')
        ->set('personal.email', $email)
        ->set('personal.course_id', (string) $course->id)
        ->set('preferred_date', '2026-03-20')
        ->call('nextStep');
}

it('stores course and department names in form_data', function () {
    Queue::fake();

    [$hospital, $course, $department] = seedRequiredVmmcData();

    $component = Livewire::test('guest::vmmc');

    fillVmmcStepOne($component, $course, 'john.course@example.com');

    $component
        ->assertSet('step', 2)
        ->assertSet('personal.course', $course->name)
        ->assertSet('personal.department', $department->name);

    $component
        ->set('consent', true)
        ->call('submit')
        ->assertSet('submitted', true);

    $savedForm = Form::query()
        ->where('hospital_id', $hospital->id)
        ->where('donor_email', 'john.course@example.com')
        ->first();

    expect($savedForm)->not()->toBeNull();
    expect(data_get($savedForm->form_data, 'personal.course'))->toBe($course->name);
    expect(data_get($savedForm->form_data, 'personal.department'))->toBe($department->name);
    expect(data_get($savedForm->form_data, 'personal.course_id'))->toBeNull();
});

it('accepts submissions even when existing responses are at 250', function () {
    Queue::fake();

    [$hospital, $course] = seedRequiredVmmcData();

    foreach (range(1, 250) as $index) {
        Form::query()->create([
            'hospital_id' => $hospital->id,
            'donor_name' => 'Seeded Donor ' . $index,
            'donor_email' => 'seeded-' . $index . '@example.com',
            'form_data' => [
                'personal' => [
                    'email' => 'seeded-' . $index . '@example.com',
                ],
                'preferred_date' => '2026-03-20',
            ],
        ]);
    }

    $component = Livewire::test('guest::vmmc');

    fillVmmcStepOne($component, $course, 'john.over250@example.com');

    $component
        ->set('consent', true)
        ->call('submit')
        ->assertSet('submitted', true);

    expect(Form::query()->where('hospital_id', $hospital->id)->count())->toBe(251);
});
