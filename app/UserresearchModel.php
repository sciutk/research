<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserresearchModel extends Model
{
    use SoftDeletes;

    protected $table = "users_research";
    protected $primaryKey = 'ur_id';


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function journal(){

            return $this->belongsTo(JournalModel::class,'rj_id','rj_id');
//            return $this->hasMany(JournalModel::class,'rj_id','rj_id')->orderBy('rj_publish_date','desc');

    }



}
