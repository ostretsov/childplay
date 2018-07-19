<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 14.07.18 8:32.
 */

namespace App\TaskDescription;

class StringTaskDescription implements TaskDescriptionInterface
{
    public function render(): string
    {
        return '';
    }
}
