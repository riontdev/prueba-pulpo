<?php

namespace Src\OutSourcing\CurrencyCalculator\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;

final class RequestTemporalEloquentModel extends Model
{

    protected $table = 'request_temporals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ip',
        'to_currency',
        'from_currency',
        'amount',
    ];
}
