<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Farm;
use App\Models\Field;
use App\Models\FarmSoilTests;
use App\Models\Systype;
use App\Http\Livewire\MobileSoilTestResults;



class LwWebSoilResults extends MobileSoilTestResults
{
    ## TODO: inherit some methods from mobileSoilTestResults component

    public $farmSoilTests = [];
    public $testedFields = [];
    public $monoCropFarmSize;
    public $farmSoilTypeTests = [];

    public $testSummary = null;
    public $webtestdate;
    public $showWebSummary = false;
    public $web_allocation;
    public $web_field_name;

    // I have inherited this method 'showTestSummary', 'deleteConfirmed' from MobileSoilTestResults
    protected $listeners = ['listen_to_farm_id' => 'print_farm_id', 'showWebSoilTestSummary' => 'showWebSoilTestSummary', 'showGraphicArea', 'webDeleteConfirmed' => 'deleteConfirmed'];


    public function print_farm_id($farmId)
    {
        $this->resetFarmData();

        $farm = Farm::find($farmId);

        if (!$farm) {
            return;
        }

        $this->fetchFarmSoilTests($farmId);
        $this->fetchFieldsForFarm($farmId);

        $this->updatedFieldSelected2($farmId);
    }

    private function resetFarmData()
    {
        $this->farmSoilTests = [];
        $this->farmSoilTypeTests = [];
        $this->testedFields = [];
        $this->monoCropFarmSize = null;
    }

    private function fetchFarmSoilTests($farmId)
    {
        $this->farmSoilTests = FarmSoilTests::where('farm_id', $farmId)->orderBy('test_date', 'desc')->get();

        foreach ($this->farmSoilTests as $farmSoilTest) {
            $soilTypeValue = Systype::where('id', $farmSoilTest->test_id)->value('value');
            $this->farmSoilTypeTests[] = [
                'id' => $farmSoilTest->test_id,
                'value' => $soilTypeValue
            ];
        }
    }

    private function fetchFieldsForFarm($farmId)
    {
        $fields = Field::where('farm_id', $farmId)->orderBy('id', 'desc')->get();

        if ($fields->isNotEmpty()) {
            $this->testedFields = $fields;
        } else {
            $farm = Farm::find($farmId);
            $this->testedFields = 0;
            $this->monoCropFarmSize = $farm->farm_size;
        }
    }

    // TODO: Refactor the method from the inherited class and re-use 
    public function updatedFieldSelected2($farmId)
    {
        $field = Field::where('farm_id', $farmId)->first();

        if (!$field) {
            $this->web_allocation = $this->monoCropFarmSize;
            $this->web_field_name = 'Mono Farm';
        } else {
            $this->web_allocation = $field->allocation;
            $this->web_field_name = $field->name;
        }
    }


    public function showWebSoilTestSummary($test_id)
    {
        $this->testSummary = collect($this->farmSoilTests)->firstWhere('test_id', $test_id);
        $this->webtestdate = $this->testSummary->test_date;
        $this->showWebSummary = true;
    }


    public function showGraphicArea()
    {
        $this->showWebSummary = false;
    }

    public function deleteWebSoilTest($soilTestId){
        $this->deleteRecord($soilTestId);
    }

    public function render()
    {
        return view('livewire.lw-web-soil-results');
    }
}
