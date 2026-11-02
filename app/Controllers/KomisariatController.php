<?php

namespace App\Controllers;

use App\Models\KomisariatModel;
use App\Models\SiteModel;

class KomisariatController extends BaseController
{
    public function index()
    {
        $komisariatModel = new KomisariatModel();
        $siteModel = new SiteModel();

        $data = [
            'title'      => 'Daftar Komisariat',
            'active'     => 'Komisariat',
            'komisariat' => $komisariatModel->getActiveKomisariat(),
            'site'       => $siteModel->first(),
        ];

        return view('komisariat/index', $data);
    }
}
