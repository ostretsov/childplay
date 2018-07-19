<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 14.07.18 7:57.
 */

namespace App\Tests;

use App\RelevantTaskRetriever;
use App\Task;
use App\Tests\Fixtures\JohnDoeUserStub;
use PHPUnit\Framework\TestCase;

class RelevantTaskRetrieverTest extends TestCase
{
    public function testRetrieve()
    {
        $user = new JohnDoeUserStub();
        $retriever = new RelevantTaskRetriever();

        $tasks = $retriever->retrieve($user);

        $this->assertCount(2, $tasks);
        $this->assertTrue(arrayContainsOnlyInstancesOf($tasks, Task::class));
    }
}
