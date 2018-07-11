<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 11.07.18 8:21.
 */

namespace App\User;

interface PasswordEncoderInterface
{
    public function encode(string $rawPassword): string;
}
