<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'car_id',
        'service_id',
        'tanggal_masuk',
        'jam_masuk',
        'tanggal_selesai',
        'jam_keluar',
        'status',
        'worker_id',
    ];

    /**
     * Mendefinisikan relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi ke model Car.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Mendefinisikan relasi ke model Service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}