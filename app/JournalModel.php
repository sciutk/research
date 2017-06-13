<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalModel extends Model
{
    //
    use SoftDeletes;

    protected $table = 'research_journal';
    protected $primaryKey = 'rj_id';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
/*    protected $fillable = [
        'rj_article_name', 'rj_name', 'rj_owner',
    ];*/
}
