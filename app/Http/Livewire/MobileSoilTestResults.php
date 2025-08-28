<?php

namespace App\Http\Livewire;

use App\Models\County;
use Livewire\Component;
use App\Models\Farm;
use App\Models\Field;
use App\Models\FarmSoilTests;
use App\Models\Systype;
use Illuminate\Support\Facades\Auth;

class MobileSoilTestResults extends Component
{

    public $testedFarms = [];
    public $allUserFarms = [];
    public $usersTestedFarms = [];
    public $testedFarm;
    public $testedFarmField;
    public $testedFields = [];
    public $monoCropFarmSize;
    public $fieldselected;
    public $allocation = 'Farm size';
    public $farmSoilTypeTests = [];
    public $farmSoilTests = [];

    public $testSummary = null;

    public $field_name;
    public $testdate;


    protected $listeners = ['showTestSummary', 'deleteConfirmed'];


    public function mount()
    {
        $this->getLists();
    }

    // TODO: Refactor this function, this is not professional.
    public function getLists()
    {
        // Get all soil tests for the authenticated user and eager load the farm relationship
        $this->testedFarms = FarmSoilTests::where('farmer_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();



        // Ensure $this->testedFarms is treated as a collection
        $this->testedFarms = collect($this->testedFarms);


        // Get all farms for the authenticated user
        $this->allUserFarms = Farm::where('farmer_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();


        // Filter user farms that have been tested
        $this->usersTestedFarms = $this->allUserFarms->filter(function ($farm) {
            return $this->testedFarms->contains('farm_id', $farm->id);
        });
    }


    function updatedTestedFarm()
    {
        $testedFarm = Farm::find($this->testedFarm);

        // Get all the fields from the above selected farm.
        $allFieldsThatBelongToTheTestedFarm = Field::where('farm_id', $this->testedFarm)->orderBy('id', 'desc')->get();

        // Get all tests that belong to this farm
        $this->farmSoilTests = FarmSoilTests::where('farm_id', $this->testedFarm)->get();

        foreach ($this->farmSoilTests as $farmsoiltest) {
            $soilTipoValue = Systype::where('id', $farmsoiltest->test_id)->value('value');
            $this->farmSoilTypeTests[] = [
                'id' => $farmsoiltest->test_id,
                'value' => $soilTipoValue
            ];
        }


        if ($testedFarm && $allFieldsThatBelongToTheTestedFarm->isNotEmpty()) {
            $this->testedFields = $allFieldsThatBelongToTheTestedFarm;
        } elseif ($testedFarm) {
            $this->testedFields = 0;
            $this->monoCropFarmSize = $testedFarm->farm_size;
        }
    }


    function updatedFieldSelected()
    {
        $field = Field::where('id', $this->fieldselected)->first();

        if ($field == null) {
            $this->allocation = $this->monoCropFarmSize;
            $this->field_name = 'Mono Farm';
        } else {
            $this->allocation = $field->allocation;
            $this->field_name = $field->name;
        }
    }

    public function deleteRecord($recordId)
    {
        $record = FarmSoilTests::find($recordId);
        if ($record) {
            $this->emit('confirm', $recordId);
        }
    }

    public function deleteConfirmed($recordId)
    {
        $record = FarmSoilTests::find($recordId);
        if ($record) {
            $record->delete();
            $this->emit('recordDeleted', 'Record deleted successfully.');
        }
    }


    public function showTestSummary($testId)
    {

        $this->testSummary = collect($this->farmSoilTests)->firstWhere('test_id', $testId);
        $this->testdate = $this->testSummary->test_date;
    }


    public function render()
    {
        return view('livewire.mobile-soil-test-results');
    }
}
