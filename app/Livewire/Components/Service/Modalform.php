<?php

namespace App\Livewire\Components\Service;

use App\Models\Employee;
use App\Models\Service;
use App\Models\ServiceEmployeeWork;
use App\Models\Work;
// use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\ValidationException;

class Modalform extends Component
{

    public $modalFormData = false;
    public $id;
    public $update_data = false;

    public $price;
    public $name;
    public $description;
    public $is_package;
    public $unit;

    // Penyimpanan array untuk works
    public $workemployees = [];
    public $works;
    public $employees;

    public function mount()
    {
        $this->works = Work::all();
        $this->employees = Employee::all();
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->price = 0;
        $this->name = '';
        $this->description = '';
        $this->is_package = false;
        $this->unit = '';
        $this->workemployees = [];
    }

    public function addRow()
    {
        $this->workemployees[] = [
            'work_id' => null,
            'employee_id' => null,
            'default_pay' => 0,
        ];
    }
    public function removeRow($index)
    {
        unset($this->workemployees[$index]);
        $this->workemployees = array_values($this->workemployees);
    }

    public function updated($name, $value)
    {
        if (str_starts_with($name, 'workemployees.')) {
            $parts = explode('.', $name);

            if (count($parts) === 3) {
                [, $index, $field] = $parts;
                $index = (int) $index;

                if (!isset($this->workemployees[$index])) return;

                $workId = $this->workemployees[$index]['work_id'] ?? null;
                $work = $workId ? Work::find($workId) : null;

                if ($field === 'work_id' && $work) {
                    $this->workemployees[$index]['default_pay'] = (float) $work->default_pay;
                }
            }
        }
    }

    #[On('open-modal')]
    public function openModal()
    {
        $this->modalFormData = true;
    }
    public function closeModal()
    {
        $this->update_data = false;
        $this->modalFormData = false;
        $this->resetForm();
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->modalFormData = true;
        $this->update_data = true;
        $this->id = $id;

        $service = Service::find($id);
        $this->name = $service->name;
        $this->price = $service->price;
        $this->description = $service->description;
        $this->unit = $service->unit;
        $this->is_package = $service->is_package;

        $this->loadSEW($id);
    }

    public function loadSEW($service_id)
    {
        // DB::enableQueryLog();
        // $sew = ServiceEmployeeWork::where('service_id', $service_id)->get();
        $sew = ServiceEmployeeWork::with('work')
        ->where('service_id', $service_id)->get();
        if (!empty($sew)) {
            foreach ($sew as $se) {
                $this->workemployees[] = [
                    'work_id' => $se->work_id,
                    'employee_id' => $se->employee_id,
                    'default_pay' => $se->work->default_pay,
                ];
            }
        }
        // dd(DB::getQueryLog());
    }
    public function save()
    {
        $this->validate([

            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'unit' => 'required',

        ]);

        DB::beginTransaction();
        try {
            if ($this->update_data) {
                $service = Service::find($this->id);
                $service->update([
                    'name' => $this->name,
                    'price' => $this->price,
                    'description' => $this->description,
                    'unit' => $this->unit,
                    'is_package' => $this->is_package ?? false,
                ]);

                ServiceEmployeeWork::where('service_id', $this->id)
                ->delete();
                // $this->dispatch('success', 'Service updated successfully');
                // $this->reset();
            } else {
                $service = Service::create([
                    'name' => $this->name,
                    'price' => $this->price,
                    'description' => $this->description,
                    'unit' => $this->unit,
                    'is_package' => $this->is_package ?? false,
                ]);
                // $this->dispatch('success', 'Service created successfully');
                // $this->reset();
            }
            // foreach ($this->works as $work) {

            // }
            if (!empty($this->workemployees)) {
                foreach ($this->workemployees as $i => $we) {
                    // Cek apakah kombinasi sudah ada
                    $key = $we['work_id'] . '-' . $we['employee_id'];

                    // hitung ada berapa kemunculan key ini di array
                    $count = collect($this->workemployees)
                        ->filter(fn($x) => $x['work_id'] . '-' . $x['employee_id'] === $key)
                        ->count();
                    if ($count > 1) {
                        throw ValidationException::withMessages([
                            "workemployees.$i.work_id" => "Baris ke-" . ($i + 1) . " duplikat dengan entri lain.",
                        ]);
                    }

                    // Kalau aman → insert
                    DB::table('service_employee_work')->insert([
                        'service_id'  => $service->id,
                        'work_id'     => $we['work_id'],
                        'employee_id' => $we['employee_id'],
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }
            }

            $attributes = [];
            foreach ($this->workemployees as $i => $row) {
                $attributes["workemployees.$i.work_id"] = "Work pada baris ke-" . ($i + 1);
                $attributes["workemployees.$i.employee_id"] = "Karyawan pada baris ke-" . ($i + 1);
            }

            $this->validate([
                'workemployees.*.work_id' => 'required|distinct',
                'workemployees.*.employee_id' => 'required',
            ], [], $attributes);

            DB::commit();
            $this->dispatch('success',  'Service ' . ($this->update_data ? 'updated' : 'created') . ' successfully');
            $this->resetForm();
            $this->closeModal();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.components.service.modalform');
    }
}
