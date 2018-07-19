<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 14.07.18 8:01.
 */

namespace App;

class RelevantTaskRetriever
{
    public function retrieve(User $targetUser): array
    {
        return [
            new Task(),
            new Task(),
        ];
    }
}
