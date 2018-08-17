<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['address', 'lat', 'lng'];

    public function getGeoDataDistance ($geoData, $client, $request)
    {
        $arr = [];
        if(!empty($geoData)) {
            foreach ($geoData as $data) {
                array_push($arr, $data->address);
            }
            $areas = implode('|', $arr);

            $res = $client->request('GET', "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $areas . "
                                                    &destinations=" . $request->input('sort') . "&key=AIzaSyAuZ_74mBWm2Cr14Rb-oXw8a2xTgb9SSPA");
            $actualyGeoData = $res->getBody();
        }
        return $actualyGeoData;
    }

    public function sortGeoData ($geoData)
    {
        $arr = [];
        foreach ($geoData as $data) {
            array_push($arr, $data);
        }
        $arr2 = [];
        foreach ($arr[1] as $val) {
            if (!$val) continue;
            array_push($arr2, $val);
        }
        $arr3 = [];
        foreach ($arr[2] as $val) {
            if($val->elements[0]->status === 'NOT_FOUND') continue;
            array_push($arr3, $val->elements[0]->distance);
        }
        $sortGeoDataArr = array_combine($arr2, $arr3);

        uasort($sortGeoDataArr, array($this, "sort"));

        return $sortGeoDataArr;
    }

    private function sort ($a, $b)
    {
        return $a->value > $b->value;
    }
}
