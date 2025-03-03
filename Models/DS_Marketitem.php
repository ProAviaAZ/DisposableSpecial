<?php

namespace Modules\DisposableSpecial\Models;

use App\Contracts\Model;
use App\Models\Airline;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class DS_Marketitem extends Model
{
    use SoftDeletes;
    use Sortable;

    public $table = 'disposable_marketitems';

    protected $fillable = [
        'name',
        'price',
        'description',
        'notes',
        'image_url',
        'category',
        'dealer_id',
        'limit',
        'active',
        'notifications',
    ];

    public static $rules = [
        'name'          => 'required|max:250',
        'price'         => 'required|numeric',
        'description'   => 'nullable',
        'notes'         => 'nullable',
        'image_url'     => 'nullable',
        'category'      => 'nullable',
        'dealer_id'     => 'required|numeric',
        'limit'         => 'nullable|numeric',
        'active'        => 'required|boolean',
        'notifications' => 'nullable|boolean',
    ];

    public $sortable = [
        'name',
        'group',
        'price',
    ];

    // Relationship with owners (Based on User model)
    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'disposable_marketitem_owner', 'marketitem_id', 'user_id');
    }

    // Relationship with dealer (mostly for financial records, based on Airline model)
    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'dealer_id');
    }
}
