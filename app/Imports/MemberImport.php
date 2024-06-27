<?php

namespace App\Imports;

use App\Helpers\AdminHelper;
use App\Models\Member;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MemberImport implements ToCollection, WithHeadingRow, WithChunkReading
{

    public function collection(Collection $rows)
    {
        $messages   = [];
        $row_number = 1;

        if (count($rows->toArray()) > 0) {
            foreach ($rows->toArray() as $key => $data) {
                $row_number++;
                $messages[$key . '.first_name.required']               = "Your row ($row_number). First Name field is required";
                $messages[$key . '.last_name.required']                = "Your row ($row_number). Last Name field is required";
                $messages[$key . '.email.required']                    = "Your row ($row_number). Email field is required";
                $messages[$key . '.email.unique']                      = "Your row ($row_number). Email has already been taken";
                $messages[$key . '.phone.required']                    = "Your row ($row_number). Phone field is required.";
                $messages[$key . '.company.required']                  = "Your row ($row_number). Company field is required.";
                $messages[$key . '.business_registration_no.required'] = "Your row ($row_number). Business Registration Number field is required.";
                $messages[$key . '.company_phone.required']            = "Your row ($row_number). Company Phone field is required.";
            }
        }
        
        Validator::make($rows->toArray(), [
            '*.first_name' => 'required',
            '*.last_name'  => 'required',
            '*.email'      => 'required|email|unique:members',
            '*.phone'      => 'required',
            '*.company'    => 'required',

        ], $messages)->validate();

        foreach ($rows as $row) {
            Member::create([
                'code'         => AdminHelper::getMemberCode(),
                'first_name'   => $row['first_name'],
                'last_name'    => $row['last_name'],
                'email'        => $row['email'],
                'phone'        => $row['phone'],
                'company'      => $row['company'],
                'created_date' => now(),
                'created_by'   => auth()->id(),
            ]);
        }
    }

    public function uniqueBy()
    {
        return 'email';
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
