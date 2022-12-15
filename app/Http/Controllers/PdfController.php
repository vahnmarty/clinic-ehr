<?php

namespace App\Http\Controllers;

use App\Enums\FormType;
use App\Models\Research;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function research($id)
    {
        $research = Research::findOrfail($id);

        if($research->form_type->value == FormType::IntermittentHealthForm)
        {
            $form = $research->intermittent;
            return view('pdf.research.intermittent-health-form', compact('research', 'form'));
        }

        if($research->form_type->value == FormType::MaternalHealthQuestionairre)
        {
            $form = $research->maternal;
            return view('pdf.research.maternal-health-form', compact('research', 'form'));
        }
    }
}
