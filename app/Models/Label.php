<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    /**
     * Fields that can be filled in CRUD.
     *
     * @var array $fillable
     */
    protected $fillable = ['module', 'labelKey', 'value'];

    /**
     * The primary key of the table.
     *
     * @var string $primaryKey
     */
    public $primaryKey = "labelID";

    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    public $table = "labels";


    /**
     * Default number of rows per page to be shown in admin panel.
     *
     * @var integer $rowsPerPage
     */
    public static $rowsPerPage = 100;

    /**
     * Lang key that points to the multi language label in translate file.
     *
     * @var string
     */
    public static $label = "label.label";

    /**
     * Default permission that will be listed in settings of permissions.
     *
     * @var array $defaultPermissions
     */
    public static $defaultPermissions = ['create','read', 'update', 'delete'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'object'
    ];

}
