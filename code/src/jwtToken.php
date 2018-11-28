<?php

namespace Dykyi;

/**
 * Class jwtToken
 */
final class jwtToken
{
    /**
     * @todo Move to .env file
     */
    private const TOKEN = 'my-secret-token';

    /**
     * @param int   $userId
     * @param array $info
     *
     * @return string
     */
    public function generateToken(int $userId = 0, array $info = []): string
    {
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];
        $payload = ['sub' => (string)$userId, 'info' => $info];
        $segments = [];
        $segments[] = $this->urlsafeB64Encode(json_encode($header));
        $segments[] = $this->urlsafeB64Encode(json_encode($payload));
        $signing_input = implode('.', $segments);

        $signature = $this->sign($signing_input, self::TOKEN);
        $segments[] = $this->urlsafeB64Encode($signature);

        return implode('.', $segments);
    }

    private function urlsafeB64Encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    private function sign($msg, $key): string
    {
        return hash_hmac('sha256', $msg, $key, true);
    }
}
