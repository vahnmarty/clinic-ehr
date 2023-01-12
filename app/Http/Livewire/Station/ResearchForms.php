<?php

namespace App\Http\Livewire\Station;

use App\Enums\FormType;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Research;
use App\Models\Application;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Http\Livewire\Station\SearchPatientTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ResearchForms extends Component implements HasTable
{
    use InteractsWithTable;
    use SearchPatientTrait;
    use LivewireAlert;

    protected $listeners = ['selectPatient'];

    public $patientId;
    public $app;
    protected $queryString = ['patientId'];
    
    public function render()
    {
        return view('livewire.station.research-forms');
    }

    public function mount()
    {
        if($this->patientId){
            $this->selectPatient($this->patientId);
        }

        $this->app = Application::where('patient_id', $this->patient_id)->first();
    }

    protected function getTableQuery(): Builder 
    {
        return Research::where('patient_id', $this->patient_id)->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('#')->rowIndex(),
            TextColumn::make('created_at')->date(),
            TextColumn::make('form_type')->formatStateUsing(fn (string $state): string => FormType::fromValue((int)$state)->description),
            
        ];
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
                    return redirect('station/research/' . $this->patient_id . '/' . $type->key);
                    
                })
                ->button(),
            Action::make('mark_complete')
                ->label('Mark as Complete')
                ->icon('heroicon-o-check')
                ->action(function (array $data) {
                    $app = Application::where('patient_id', $this->patient_id)->latest()->first();
                    $app->research_form_finished_at = now();
                    $app->research_form_user_id = auth()->id();
                    $app->save();

                    $this->alert('success', 'Research form completed!');
                })
                ->color('warning')
                ->requiresConfirmation()
                ->visible($this->app?->research_form_finished_at ? false : true)
                ->button()
        ];
    }

    protected function getTableActions() : array
    {
        return [
            Action::make('view')
                ->label('View Submission')
                ->url(fn ($record): string => route('station.research.show', ['patientId' => $this->patient_id, 'researchId' => $record]))
                ->openUrlInNewTab()
                ->button(),
            Action::make('edit')
                ->label('Edit')
                ->url(fn ($record): string => url('station/research/'. $record->id . '/edit'))
                ->openUrlInNewTab()
                ->icon('heroicon-o-pencil'),
        ];
    }
}
