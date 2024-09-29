<?php

function obfuscate_email(?string $email = null): string
{
    if (is_null($email) || !strpos($email, '@')) {
        return '';
    }

    [$firstPart, $secondPart] = explode('@', $email);

    $qty             = (int) floor(strlen($firstPart) * 0.75);
    $remainingFirst  = strlen($firstPart) - $qty;
    $remainingSecond = strlen($secondPart) - $qty;

    $maskedFirstPart  = substr($firstPart, 0, $remainingFirst) . str_repeat('*', $qty);
    $maskedSecondPart = str_repeat('*', $qty) . substr($secondPart, $remainingSecond * -1, $remainingSecond);

    return $maskedFirstPart . '@' . $maskedSecondPart;
}
/**
 * Convert a mixed value to a string.
 *
 * @param mixed $value
 * @return string
 * @throws JsonException
 */
function toString(mixed $value): string
{
    return match (true) {
        is_null($value)                       => '',
        is_array($value) || is_object($value) => json_encode($value, JSON_THROW_ON_ERROR),
        is_bool($value)                       => $value ? 'true' : 'false',
        is_resource($value)                   => 'resource',
        is_scalar($value)                     => (string) $value,
        default                               => throw new InvalidArgumentException('Unsupported type.'),
    };
}
