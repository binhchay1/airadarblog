<?php

namespace LassoVendor\LaunchDarkly\Impl;

use DateTime;
use DateTimeZone;
use LassoVendor\LaunchDarkly\EventPublisher;
use LassoVendor\LaunchDarkly\LDClient;
use LassoVendor\LaunchDarkly\Types\ApplicationInfo;
/**
 * Internal class containing helper methods.
 *
 * @ignore
 * @internal
 */
class Util
{
    public static function adjustBaseUri(string $uri) : string
    {
        if (\substr($uri, \strlen($uri) - 1, 1) == '/') {
            return $uri;
        }
        return $uri . '/';
        // ensures that subpaths are concatenated correctly
    }
    public static function dateTimeToUnixMillis(DateTime $dateTime) : int
    {
        $timeStampSeconds = (int) $dateTime->getTimestamp();
        $timestampMicros = (int) $dateTime->format('u');
        return $timeStampSeconds * 1000 + (int) ($timestampMicros / 1000);
    }
    public static function currentTimeUnixMillis() : int
    {
        return Util::dateTimeToUnixMillis(new DateTime('now', new DateTimeZone("UTC")));
    }
    public static function isHttpErrorRecoverable(int $status) : bool
    {
        if ($status >= 400 && $status < 500) {
            return $status == 400 || $status == 408 || $status == 429;
        }
        return \true;
    }
    public static function httpErrorMessage(int $status, string $context, string $retryMessage) : string
    {
        return 'Received error ' . $status . ($status == 401 ? ' (invalid SDK key)' : '') . ' for ' . $context . ' - ' . (Util::isHttpErrorRecoverable($status) ? $retryMessage : 'giving up permanently');
    }
    /**
     * An array of header name and values that should be used for any request
     * made to LaunchDarkly servers.
     *
     * @param string $sdkKey
     * @param ApplicationInfo|null $applicationInfo
     * @return array<string, string>
     */
    public static function defaultHeaders(string $sdkKey, $applicationInfo) : array
    {
        $headers = ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => $sdkKey, 'User-Agent' => 'PHPClient/' . LDClient::VERSION];
        if ($applicationInfo instanceof ApplicationInfo) {
            $headerValue = (string) $applicationInfo;
            if ($headerValue) {
                $headers['X-LaunchDarkly-Tags'] = $headerValue;
            }
        }
        return $headers;
    }
    /**
     * An array of header name and values that should be used for any request
     * made to the LaunchDarkly Events API.
     *
     * @param string $sdkKey
     * @param ApplicationInfo|null $applicationInfo
     * @return array
     */
    public static function eventHeaders(string $sdkKey, $applicationInfo) : array
    {
        $headers = Util::defaultHeaders($sdkKey, $applicationInfo);
        $headers['X-LaunchDarkly-Event-Schema'] = EventPublisher::CURRENT_SCHEMA_VERSION;
        return $headers;
    }
}
