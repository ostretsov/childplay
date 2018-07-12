<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 12.07.18 8:54.
 */

namespace App;

class ChildrenSet implements Set
{
    /**
     * @var array
     */
    private $children;

    public function __construct(array $children)
    {
        $this->children = $children;
    }

    /**
     * @param SetItem $item
     */
    public function add(SetItem $item): void
    {
        // TODO: Implement add() method.
    }

    public function count()
    {
        return 0;
    }
}
