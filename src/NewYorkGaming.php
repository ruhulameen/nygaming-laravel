<?php

namespace Ruhul\NYGaming;

class NewYorkGaming
{
    protected $BASE_URL;
    protected $API_KEY;
    protected $SHOP_ID;
    protected $AUTH_TOKEN;

    public function __construct()
    {
        $this->__initialize();
    }

    /**
     * __initialize
     *
     * @return void
     */
    private function __initialize()
    {
        $this->BASE_URL = config('newyorkgaming.sandbox') ? config('newyorkgaming.base_url.staging') : config('newyorkgaming.base_url.production');
        $this->API_KEY = config('newyorkgaming.api_key');
        $this->SHOP_ID = config('newyorkgaming.shop_id');
        $this->AUTH_TOKEN = config('newyorkgaming.auth_token');
    }

    /**
     * getGameList
     *
     * @return void
     */
    public function getGameList()
    {
        $listUrl = $this->BASE_URL . '/games?key=' . $this->API_KEY . '&shop_id=' . $this->SHOP_ID;
        $listContent = json_decode($this->curlGet($listUrl), true);
        if (!$listContent['error']) {
            return $listContent['response']['data'];
        }
        return [];
    }

    /**
     * getGame
     *
     * @param array $params
     * @return void
     */
    public function makeGameLink($game)
    {
        $user = auth()->user();
        if ($user == null) {
            return ['error' => true, 'msg' => 'please login'];
        }
        if (!$this->isPlayerExist($user)) {
            $response = $this->createPlayer($user);
            if ($response['error'] == 1) {
                return ['error' => true, 'msg' => $response['message']];
            }
        }
        $response = $this->getUserToken($user);
        if ($response['error'] == 1) {
            return ['error' => true, 'msg' => $response['message']];
        }
        $userToken = $response['response']['token'];
        $url = $this->BASE_URL . '/games/getgame?key=' . $this->API_KEY . '&shop_id=' . $this->SHOP_ID . '&token=' . $userToken . '&game=' . $game;
        $response = json_decode($this->curlGet($url), true);
        if ($response['error'] == 1) {
            return ['error' => true, 'msg' => $response['message']];
        } else {
            return ['error' => false, 'msg' => $response['response']['link']];
        }
    }


    /**
     * getGame
     *
     * @return void
     */
    public function makeDemoGameLink($game)
    {
        $url = $this->BASE_URL . '/games/getgame/prego?key=' . $this->API_KEY . '&shop_id=' . $this->SHOP_ID . '&game=' . $game;
        $response = json_decode($this->curlGet($url), true);
        if ($response['error'] == 1) {
            return ['error' => true, 'msg' => $response['message']];
        } else {
            return ['error' => false, 'msg' => $response['response']['link']];
        }
    }


    /**
     * getGame
     *
     * @return void
     */
    public function isPlayerExist($user)
    {
        $url = $this->BASE_URL . '/users/checkuser?key=' . $this->API_KEY . '&shop_id=' . $this->SHOP_ID;
        $response =  json_decode($this->curlPost($url, [
            "username"         => $user->username
        ]), true);
        if ($response['error'] == 1) {
            return false;
        } else if (isset($response['response']) && isset($response['response']['isuser'])) {
            return $response['response']['isuser'];
        }
        return false;
    }


    /**
     * getGame
     *
     * @return void
     */
    public function createPlayer($user)
    {
        $url = $this->BASE_URL . '/users/adduser?key=' . $this->API_KEY . '&shop_id=' . $this->SHOP_ID;
        $response =  json_decode($this->curlPost($url, [
            "username" => $user->username,
            "password" => $user->username,
            "password_confirmation" => $user->username,
            "currency" => $user->currency,
        ]), true);
        return $response;
    }


    /**
     * getGame
     *
     * @param array $params
     * @return void
     */
    public function getUserToken($user)
    {
        $url = $this->BASE_URL . '/users/getusertoken?key=' . $this->API_KEY . '&shop_id=' . $this->SHOP_ID;
        $response =  json_decode($this->curlPost($url, [
            "username" => $user->username
        ]), true);
        return $response;
    }


    /**
     * getGame
     *
     * @param array $params
     * @return void
     */
    public function setWelcomeBonus($welcomeBonusLog, $user)
    {
        $url = $this->BASE_URL . '/users/setwelcomebonus?key=' . $this->API_KEY . '&shop_id=' . $this->SHOP_ID;
        $response =  json_decode($this->curlPost($url, [
            "username" => $user->username,
            'day' => $welcomeBonusLog->day,
            'freespin' => $welcomeBonusLog->freespin,
            'remain_freespin' => $welcomeBonusLog->remain_freespin,
            'game_id' => $welcomeBonusLog->game_id,
            'started_at' => $welcomeBonusLog->started_at,
        ]), true);
        return $response;
    }


    /**
     * cURL POST
     *
     */
    function curlPost($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }

    /**
     * cURL GET
     *
     */
    function curlGet($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }
}
