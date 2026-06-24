<?php
namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersImport implements ToCollection
{
    public $duplicates = [];

    public function collection(Collection $rows)
    {
        // remove header row if exists
        $rows = $rows->skip(1);

        foreach ($rows as $index => $row) {

            $data = [
                'name'  => $row[0],
                'email' => $row[1],
                'phone' => $row[2] ?? null,
                'password' => $row[4] ?? '12345678',
                'role' => $row[5] ?? 'user',
                'qalam_id' => $row[6] ?? null,
            ];

            // VALIDATION
            $validator = Validator::make($data, [
                'name'  => 'required|string',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:20',
            ]);

            if ($validator->fails()) {
                continue;
            }

            // CHECK DUPLICATE EMAIL
            if (User::where('email', $data['email'])->exists()) {
                $this->duplicates[] = $data['email'];
                continue; // skip duplicate
            }

            // INSERT
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'qalam_id' => $data['qalam_id'],
            ]);
        }
    }
}
