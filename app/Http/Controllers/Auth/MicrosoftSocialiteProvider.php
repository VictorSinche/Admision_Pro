<?php

namespace App\Providers\Auth;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class MicrosoftSocialiteProvider extends AbstractProvider implements ProviderInterface
{
    protected $graphUrl = 'https://graph.microsoft.com/v1.0';

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://login.microsoftonline.com/common/oauth2/v2.0/authorize', $state
        );
    }

    protected function getTokenUrl()
    {
        return 'https://login.microsoftonline.com/common/oauth2/v2.0/token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get("{$this->graphUrl}/me", [
            'headers' => ['Authorization' => 'Bearer ' . $token],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'       => $user['id'],
            'nickname' => null,
            'name'     => $user['displayName'],
            'email'    => $user['mail'] ?? $user['userPrincipalName'],
            'avatar'   => null,
        ]);
    }

    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'scope' => implode(' ', $this->getScopes()),
        ]);
    }
}
