<?php

namespace App\Controllers;

use App\Models\IntroSettingModel;

class Home extends BaseController
{
    public function index()
    {
        return $this->response->redirect("/sub/sub01/view/1");
        /*return view('/index');*/
    }

}
