    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Snap extends Model
    {
        use HasFactory;

        protected $table = 'snap';

        protected $fillable = [
            'user_id',
            'snap_token',
            'status',
            'transaction_id',
            'order_id',
        ];
    }