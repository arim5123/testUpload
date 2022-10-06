<?php

namespace App\Models;

use CodeIgniter\Model;

class ExcelCTSModel extends Model
{
    protected $table = 'excel_cts';
    protected $allowedFields = [
        'id','post_id','d_order','c_order', 'depart','team','position','div','rank','option_1','option_2','option_3',
        'name','c_name','birthday','age','apm','n_day','country','hs_place','education','initial_day','p_day','retirement','period',
        'a_day_1','a_day_2','a_day_3','a_day_4','a_day_5','a_day_6','a_day_7','a_day_8','a_day_9','a_day_10',
        'promotion','h_num','course','s_h_fill','promote_day','promote_pot','commendation','disciplinary','major','detail'
    ];
}

