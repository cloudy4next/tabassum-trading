<?php

declare(strict_types=1);

namespace IceAxe\NativeCloud\Views\Component;

use IceAxe\NativeCloud\App\Contracts\FormInterface;
use Illuminate\Contracts\View\View;

class CrudForm extends AbstractComponent
{
    public FormInterface $form;


    public function render(): View
    {
        $this->form = $this->getCrudBoard()->getForm();

        return view('native-cloud::curdboard.create');

    }
}
