<?php

declare(strict_types=1);

namespace Cloudy4next\NativeCloud\Views\Component;

use Cloudy4next\NativeCloud\App\Contracts\FormInterface;
use Illuminate\Contracts\View\View;

class CrudEditForm extends AbstractComponent
{
    public FormInterface $form;


    public function render(): View
    {
        $this->form = $this->getCrudBoard()->getForm();

        return view('native-cloud::curdboard.edit');

    }
}