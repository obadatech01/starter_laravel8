<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'price', 'details', 'photo',  'status' ];

    protected $hidden = [ 'created_at', 'updated_at'];

    ###############register global Scopes####################
    protected static function booted()
    {
        static::addGlobalScope(new OfferScope);
    }

    ###############Local Scopes####################
    public function scopeInactive($query) {
        return $query->where('status', '=', 0);
    }

    public function scopeInvalid($query) {
        return $query->where('status', '=', 0)->whereNull('details');
    }

    ###############Accessors####################
    public function getStatusAttribute($val) {
        return $val == 1 ? 'active' : 'inactive';
    }

    ###############Mutator####################
    public function setNameAttribute($val) {
        $this->attributes['name'] = strtoupper($val);
    }

}
