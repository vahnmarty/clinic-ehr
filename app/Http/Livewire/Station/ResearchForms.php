<?php

namespace App\Http\Livewire\Station;

use App\Enums\FormType;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Research;
use App\Models\Application;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Http\Livewire\Station\SearchPatientTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ResearchForms extends Component implements HasTable
{
    use InteractsWithTable;
    use SearchPatientTrait;

    protected $listeners = ['selectPatient'];
    
    public function render()
    {
        return view('livewire.station.research-forms');
    }

    public function mount()
    {
        $this->selectPatient(82);
    }

    protected function getTableQuery(): Builder 
    {
        return Research::where('patient_id', $this->patient_id);
    }

    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create')
                ->label('New Form')
                ->icon('heroicon-o-plus')
                ->form([
                    Select::make('form_type')->options(FormType::asSelectArray())
                ])
                ->action(function (array $data) {
                    $type = FormType::fromValue((int)$data['form_type']);
                    $app = Application::where('patient_id', $this->patient_id)->latest()->first();
                    return redirect('station/research/' . $app->uuid . '/' . $type->key);
                    
                })
                ->button()
        ];
    }
}
