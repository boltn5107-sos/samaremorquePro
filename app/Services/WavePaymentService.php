<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Integration Wave Money - Business / Checkout API.
 *
 * Documentation : https://docs.wave.com/checkout
 * Auth : Bearer <api_key> (cles creees dans le Dev Portal Wave Business).
 * Request signing (optionnel) : header Wave-Signature.
 */
class WavePaymentService
{
    public function __construct(protected array $config = [])
    {
        $this->config = $config ?: $this->loadConfig();
    }

    protected function loadConfig(): array
    {
        $environment = config('wave.environment', 'sandbox');

        return [
            'api_key' => config("wave.{$environment}.api_key", ''),
            'signing_secret' => config("wave.{$environment}.signing_secret", ''),
            'base_url' => config('wave.base_url', 'https://api.wave.com'),
            'currency' => config('wave.currency', 'XOF'),
            'success_url' => config('wave.success_url', ''),
            'error_url' => config('wave.error_url', ''),
        ];
    }

    public function configured(): bool
    {
        return filled($this->config['api_key']);
    }

    /**
     * Cree une session de checkout Wave.
     *
     * @param  int|string  $amount  Montant (XOF : entier, pas de decimales).
     * @param  array<string, mixed>  $options  client_reference, success_url, error_url,
     *                                        restrict_payer_mobile...
     * @return array<string, mixed>  Reponse de l'API Wave.
     *
     * @throws \RuntimeException Si l'API n'est pas configuree.
     */
    public function createCheckout(int|string $amount, array $options = []): array
    {
        $this->assertConfigured();

        $payload = [
            'amount' => (string) $amount,
            'currency' => $this->config['currency'],
            'success_url' => $options['success_url'] ?? $this->config['success_url'],
            'error_url' => $options['error_url'] ?? $this->config['error_url'],
        ];

        if (isset($options['client_reference'])) {
            $payload['client_reference'] = $options['client_reference'];
        }

        if (isset($options['restrict_payer_mobile'])) {
            $payload['restrict_payer_mobile'] = $options['restrict_payer_mobile'];
        }

        return $this->request('post', '/v1/checkout/sessions', $payload);
    }

    /**
     * Recupere une session de checkout par son identifiant.
     */
    public function retrieveCheckout(string $checkoutId): array
    {
        $this->assertConfigured();

        return $this->request('get', "/v1/checkout/sessions/{$checkoutId}");
    }

    /**
     * Recupere une session de checkout par l'identifiant de transaction Wave.
     */
    public function retrieveByTransactionId(string $transactionId): array
    {
        $this->assertConfigured();

        return $this->request('get', '/v1/checkout/sessions', [
            'transaction_id' => $transactionId,
        ]);
    }

    /**
     * Recherche des sessions de checkout par reference client.
     */
    public function searchByClientReference(string $clientReference): array
    {
        $this->assertConfigured();

        return $this->request('get', '/v1/checkout/sessions/search', [
            'client_reference' => $clientReference,
        ]);
    }

    /**
     * Expire une session de checkout ouverte.
     */
    public function expireCheckout(string $checkoutId): array
    {
        $this->assertConfigured();

        return $this->request('post', "/v1/checkout/sessions/{$checkoutId}/expire");
    }

    /**
     * Rembourse un paiement effectue (transaction deja reussie).
     */
    public function refundCheckout(string $checkoutId): array
    {
        $this->assertConfigured();

        return $this->request('post', "/v1/checkout/sessions/{$checkoutId}/refund");
    }

    /**
     * Verifie la signature d'un webhook Wave.
     */
    public function verifyWebhookSignature(string $payload, string $signatureHeader): bool
    {
        $secret = config('wave.webhook_secret', '');

        if (blank($secret)) {
            Log::warning('Wave webhook: WAVE_WEBHOOK_SECRET non configure, signature non verifiee.');

            return true;
        }

        return hash_equals($secret, $signatureHeader);
    }

    /**
     * Envoie une requete HTTP signee vers l'API Wave.
     *
     * @return array<string, mixed>
     */
    protected function request(string $method, string $path, array $data = []): array
    {
        $url = rtrim($this->config['base_url'], '/') . $path;

        $body = in_array($method, ['post', 'put', 'patch'], true) ? json_encode($data) : null;

        $headers = [
            'Authorization' => 'Bearer ' . $this->config['api_key'],
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        if (filled($this->config['signing_secret']) && $body !== null) {
            $timestamp = time();
            $signature = hash_hmac('sha256', $timestamp . $body, $this->config['signing_secret']);
            $headers['Wave-Signature'] = "t={$timestamp},v1={$signature}";
        }

        try {
            $client = $this->http()->withHeaders($headers);

            $response = match ($method) {
                'get' => $client->get($url, $data),
                'post' => $client->withBody($body ?: '{}', 'application/json')->post($url),
                default => throw new \InvalidArgumentException("Methode HTTP non supportee : {$method}"),
            };

            if ($response->failed()) {
                Log::error('Wave API error', [
                    'url' => $url,
                    'method' => $method,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                throw new \RuntimeException(
                    "Erreur Wave API ({$response->status()}): {$response->body()}"
                );
            }

            return $response->json() ?: [];
        } catch (\Throwable $e) {
            Log::error('Wave API request failed', [
                'url' => $url,
                'method' => $method,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    protected function http(): PendingRequest
    {
        return Http::timeout(30);
    }

    protected function assertConfigured(): void
    {
        if (! $this->configured()) {
            throw new \RuntimeException(
                'Wave API non configuree : renseignez WAVE_API_KEY_... dans votre fichier .env.'
            );
        }
    }
}