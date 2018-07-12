<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 12.07.18 8:55.
 */

namespace App;

interface Set extends \Countable
{
    /**
     * @param SetItem $item
     */
    public function add(SetItem $item): void;
}
