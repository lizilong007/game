<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;

class CocCrawler extends CrawlerBase implements CrawlerInterface {

    // https://api.clashofclans.com/v1/players/%23V8RJJGYR
    // https://developer.clashofclans.com
    // curl -X GET --header 'Accept: application/json' --header "authorization: Bearer <API token>" 'https://api.clashofclans.com/v1/players/%23V8RJJGYR'
    private $_baseUrl = 'https://api.clashofclans.com/v1/players/';
    private $_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjhhNDlmYzBlLTEzNDctNDM4NS05YTQ5LWY5Y2VlY2RjY2U5OSIsImlhdCI6MTUyMDUwNjE2OCwic3ViIjoiZGV2ZWxvcGVyLzhiM2Y2MThkLTc5NGMtY2VhYi03N2ZjLTkzYTY2NzVjZmUxZCIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjEzLjIzMS4xMDUuMTA2Il0sInR5cGUiOiJjbGllbnQifV19.VTSSJNwVZDgtykwHuo1U7VMgKAxrtauRxF6W9D9g1PKn2T56AmJIoUVsPPJCZTNnzNCgEkOyHN2aZDpdoBHXZg';

    public function make($name) {

        $data = $this->search($name);
        $account = [];

        $account['name'] = $data['name'];
        $account['townHallLevel'] = $data['townHallLevel'];
        $account['expLevel'] = $data['expLevel'];
        $account['trophies'] = $data['trophies'];
        $account['bestTrophies'] = $data['bestTrophies'];
        $account['warStars'] = $data['warStars'];
        $account['attackWins'] = $data['attackWins'];
        $account['defenseWins'] = $data['defenseWins'];
        $account['versusTrophies'] = $data['versusTrophies'];
        $account['bestVersusTrophies'] = $data['bestVersusTrophies'];
        $account['versusBattleWins'] = $data['versusBattleWins'];

        $account['clan'] = [
            'tag' => $data['clan']['tag'],
            'name' => $data['clan']['name'],
            'clanLevel' => $data['clan']['clanLevel'],
        ];

        $account['league']['name'] = $data['league']['name'];
        $account['legendStatistics'] = $data['legendStatistics'];

        $account['troops'] = $data['troops'];
        $account['heroes'] = $data['heroes'];
        $account['spells'] = $data['spells'];

        return $account;

    }

    public function search($name)
    {
        $name = $this->handleName($name);
        $url = $this->searchUrl($name);
        $client = new \GuzzleHttp\Client();
        try {
            $res = $client->request('GET', $url, [
                    'headers' => [
                        'Accept' => 'application/json',
                        'authorization' => 'Bearer ' . $this->_token,
                    ]
                ]);

            if ($res->getStatusCode() == 200) {
                return json_decode((String)$res->getBody(), true);
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return null;
        }
    }

    private function handleName($name)
    {
        return '#' . str_replace(['#', '＃'], '', $name);
    }


    private function searchUrl($name) {
        return $this->_baseUrl . urlencode($name);
    }



}

?>