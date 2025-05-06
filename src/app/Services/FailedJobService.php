<?php

namespace App\Services;


use App\Helpers\QueryHelper;
use Illuminate\Support\Facades\DB;

class FailedJobService
{
    public function getFailedJobs($search = null)
    {
        $query = DB::table('failed_jobs')->orderBy('failed_at', 'desc');

        $columns = ['connection', 'queue', 'payload', 'exception', 'uuid'];

        $query = QueryHelper::applySearchFilter($query, $columns, $search);

        return $query->paginate(15);
    }

    public function getById($id)
    {
        return DB::table('failed_jobs')->find($id);
    }
    public function delete($id)
    {
        return DB::table('failed_jobs')->where('id', $id)->delete();
    }

    public function clearAll()
    {
        DB::table('failed_jobs')->truncate();
    }
}
