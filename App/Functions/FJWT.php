<?php

namespace App\Functions;

class FJWT
{
    private $alg;
    private $hash;
    private $data;

    public function encode($header, $payload, $key)
    {
        $stringify_payload = JSON($payload);
        $encoded_payload = $this->base64url_encode($stringify_payload);
        $encoded_header = $this->base64url_encode($header);
        $this->data = "$encoded_header.$encoded_payload";
        $JWS = $this->JWS($header, $key);
        return "$this->data.$JWS";
    }

    public function decode($token, $key)
    {
        list($header, $payload, $signature) = explode('.', $token);
        $this->data = "$header.$payload";
        $is_valid_signature = $signature == $this->JWS($this->base64url_decode($header), $key);
        if ($is_valid_signature) {
            return $this->base64url_decode($payload);
        }
        exit('Invalid Signature');
    }

    private function base64url_encode($data)
    {
        $encoded_data = strtr(base64_encode($data), '+/', '-_');
        return rtrim($encoded_data, '=');
    }

    private function base64url_decode($data)
    {
        $decoded_data = strtr($data, '-_', '+/');
        return base64_decode(str_pad($decoded_data, strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    private function setAlgorithm($algorithm)
    {
        switch ($algorithm[0]) {
            case 'H':
                $this->alg = 'HMAC';
                break;
            case 'R':
                $this->alg = 'RSA';
                break;
            case 'E':
                $this->alg = 'ECDSA';
                break;
            case 'n':
                $this->alg = 'plaintext';
                break;
            default:
                exit("RSA and ECDSA not implemented yet!");
        }
        switch ($algorithm[2]) {
            case 2:
                $hash = 'sha256';
                break;
            case 3:
                $hash = 'sha384';
                break;
            case 5:
                $hash = 'sha512';
                break;
            case 'a':
                $this->alg = 'plaintext';
                break;
        }

        if (in_array($hash, hash_algos())) $this->hash = $hash;
    }

    private function JWS($header, $key)
    {
        $json = json_decode($header);
        $this->setAlgorithm($json->alg);
        if ($this->alg == 'plaintext') {
            return '';
        }
        return $this->base64url_encode(hash_hmac($this->hash, $this->data, $key, true));
    }
}
