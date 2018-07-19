<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 14.07.18 8:35.
 */

namespace App\TaskDescription;

class TaskDescription implements TaskDescriptionInterface
{
    /**
     * @var TaskDescriptionInterface[]
     */
    private $descriptions;

    public function __construct(array $descriptions)
    {
        $this->validateDescriptionElements($descriptions);
        $this->descriptions = $descriptions;
    }

    private function validateDescriptionElements(array $descriptions): void
    {
        foreach ($descriptions as $description) {
            if (!$descriptions instanceof TaskDescriptionInterface) {
                throw new \InvalidArgumentException(sprintf('All descriptions must be of type "%s"', TaskDescriptionInterface::class));
            }
        }
    }

    public function render(): string
    {
        return '';
    }
}
