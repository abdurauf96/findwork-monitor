<?php

namespace App\Http\Controllers\Jobs;
use App\Services\RetryService;
use App\Helpers\MessageHelper;
use App\Http\Controllers\Controller;
use App\Services\FailedJobService;
use Illuminate\Http\Request;

class FailedJobController extends Controller
{
    public function __construct(protected FailedJobService $failedJobService,protected RetryService $retryService){}
    public function index(Request $request)
    {
        $jobs = $this->failedJobService->getFailedJobs($request->input('search'));
        return view('pages.failed-jobs.index',compact('jobs'));
    }
    public function retry($uuid)
    {
        return $this->handleRetryResponse($uuid);
    }

    public function retryAll()
    {
        return $this->handleRetryResponse('all');
    }

    protected function handleRetryResponse($uuid)
    {
        $response = $this->retryService->retryFailedJob($uuid);
        $data = $response->json();

        if ($response->successful()) {
            MessageHelper::success("Job retried successfully. UUID: {$data['uuid']}");
        } else {
            MessageHelper::error($data['message'] ?? 'Failed to retry the job.');
        }

        return redirect()->route('failed-jobs.index');
    }

    public function destroy($id)
    {
        $this->failedJobService->delete($id);
        MessageHelper::success('Job deleted');
        return redirect()->route('failed-jobs.index');
    }

    public function destroyAll()
    {

        $this->failedJobService->clearAll();
        MessageHelper::success('All jobs deleted.');
        return redirect()->route('failed-jobs.index');
    }
}
