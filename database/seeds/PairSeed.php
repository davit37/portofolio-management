<?php

use Illuminate\Database\Seeder;
use App\Models\MstPair;

class PairSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[

            ["pair_name"=>"EURUSD"],
            ["pair_name"=>"USDJPY"],
            ["pair_name"=>"GBPUSD"],
            ["pair_name"=>"AUDUSD"],
            ["pair_name"=>"USDCAD"],
            ["pair_name"=>"USDCHF"],
            ["pair_name"=>"NZDUSD"],
            ["pair_name"=>"EURGBP"],
            ["pair_name"=>"EURAUD"],
            ["pair_name"=>"EURCAD"],
            ["pair_name"=>"EURCHF"],
            ["pair_name"=>"EURJPY"],
            ["pair_name"=>"EURNZD"],
            ["pair_name"=>"GBPEUR"],
            ["pair_name"=>"GBPJPY"],
            ["pair_name"=>"GBPAUD"],
            ["pair_name"=>"GBPCAD"],
            ["pair_name"=>"GBPCHF"],
            ["pair_name"=>"GBPNZD"],
            ["pair_name"=>"JPYAUD"],
            ["pair_name"=>"JPYCAD"],
            ["pair_name"=>"JPYCHF"],
            ["pair_name"=>"JPYEUR"],
            ["pair_name"=>"JPYGBP"],
            ["pair_name"=>"JPYNZD"],
            ["pair_name"=>"AUDCAD"],
            ["pair_name"=>"AUDCHF"],
            ["pair_name"=>"AUDEUR"],
            ["pair_name"=>"AUDGBP"],
            ["pair_name"=>"AUDJPY"],
            ["pair_name"=>"AUDNZD"],
            ["pair_name"=>"CADAUD"],
            ["pair_name"=>"CADCHF"],
            ["pair_name"=>"CADEUR"],
            ["pair_name"=>"CADGBP"],
            ["pair_name"=>"CADJPY"],
            ["pair_name"=>"CADNZD"],
            ["pair_name"=>"CHFAUD"],
            ["pair_name"=>"CHFCAD"],
            ["pair_name"=>"CHFEUR"],
            ["pair_name"=>"CHFGBP"],
            ["pair_name"=>"CHFJPY"],
            ["pair_name"=>"CHFNZD"],
            ["pair_name"=>"NZDAUD"],
            ["pair_name"=>"NZDCAD"],
            ["pair_name"=>"NZDCHF"],
            ["pair_name"=>"NZDEUR"],
            ["pair_name"=>"NZDJPY"],
            ["pair_name"=>"NZDGBP"]
        ];

        MstPair::insert($data);
    }
}
