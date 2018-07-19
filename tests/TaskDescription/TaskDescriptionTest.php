<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 14.07.18 8:38.
 */

namespace App\Tests\TaskDescription;

use App\TaskDescription\ImageTaskDescriptionElement;
use App\TaskDescription\TaskDescription;
use PHPUnit\Framework\TestCase;

class TaskDescriptionTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowExceptionIfWrongTypeOfAnElement()
    {
        new TaskDescription([new ImageTaskDescriptionElement(), new \stdClass()]);
    }
}
