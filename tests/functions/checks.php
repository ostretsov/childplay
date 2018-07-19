<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 14.07.18 8:14.
 */
function arrayContainsOnlyInstancesOf(array $targetArray, string $className): bool
{
    foreach ($targetArray as $value) {
        if (!$value instanceof $className) {
            return false;
        }
    }

    return true;
}
