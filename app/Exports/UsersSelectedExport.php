<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersSelectedExport implements FromCollection
{
    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return User::whereIn('id', $this->ids)
            ->select('name','email','role','qalam_id')
            ->get();
    }
}