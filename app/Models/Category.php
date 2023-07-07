<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'type'
    ];
    const TYPE_INCOME = 'Income';
    const TYPE_EXPENSE = 'Expense';
    const TYPES = [
        self::TYPE_INCOME,
        self::TYPE_EXPENSE
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function incomes() {
        return $this->hasMany(Incomes::class);
    }

    public function expenses() {
        return $this->hasMany(Expenses::class);
    }
}
