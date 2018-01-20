<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;

class CocCrawler extends CrawlerBase implements CrawlerInterface {

    // https://api.clashofclans.com/v1/players/%23V8RJJGYR
    // curl -X GET --header 'Accept: application/json' --header "authorization: Bearer <API token>" 'https://api.clashofclans.com/v1/players/%23V8RJJGYR'
    private $_baseUrl = 'https://api.clashofclans.com/v1/players/';
    private $_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjUzODhiM2UxLWQyZTEtNDhiYS04Mjg5LTIxMmUwMDc5YjkyOSIsImlhdCI6MTUxNjE5NTQxOCwic3ViIjoiZGV2ZWxvcGVyLzhiM2Y2MThkLTc5NGMtY2VhYi03N2ZjLTkzYTY2NzVjZmUxZCIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjEzOS4yMjYuMTUyLjI4IiwiMTE2LjYyLjExOS4yNDYiXSwidHlwZSI6ImNsaWVudCJ9XX0.fpjj2HQvnf_653QNwLevr4g2wN9vG-gL67xndss0cg7i2NaaKbTmecTmWphAP1cbp4_S6EZxoA6uRXpViKQmjA';

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