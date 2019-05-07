<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use Validator;

class JobController extends Controller
{
	private $request;
	private $job;

	public function __construct(Request $request, Job $job)
	{
		$this->request = $request;
		$this->job = $job;
	}

    public function saveJob()
    {
    	$validator = Validator::make($this->request->all(),
							[
				    			'title' => 'required|max:255',
				    			'description' => 'required|max:255'
				    		]    		
				    	);


    	if($validator->fails()) {
    		return response()->json(['errors' => $validator->errors()]);
    	}

    	$saveJob = $this->job->create(['title' => $this->request->get('title'), 'description' => $this->request->get('description')]);
    	if($saveJob) {
    		return response()->json(['success' => 'Saved!'], 200);
    	}
    	return response()->json(['error' => 'Server error. Please try again.'], 500);
    }

    public function getJobs()
    {
    	$jobs = $this->job->get();
    	return response()->json($jobs);
    }

    public function getJob()
    {
    	$jobId = $this->request->get('jobId');
    	$jobInfo = $this->job->whereId($jobId)->first();
    	if($jobInfo) {
    		return response()->json($jobInfo, 200);
    	}
    	return response()->json(['error' => 'Server error. Please try again.'], 500);
    }

    public function deleteJob()
    {
    	$jobId = $this->request->get('jobId');
    	$deleteJob = $this->job->whereId($jobId)->delete();
    	if($deleteJob) {
    		return response()->json(['success' => 'Deleted!'], 200);
    	}
    	return response()->json(['error' => 'Server error. Please try again.'], 500);
    }

    public function editJob()
    {
    	$validateJob = $this->request->validate([
    		'title' => 'required|max:255',
    		'description' => 'required|max:255'
    	]);

    	$jobData = $this->request->all();
    	$editJob = $this->job->whereId($jobData['id'])->update(['title' => $jobData['title'], 'description' => $jobData['description']]);
    	if($editJob) {
    		return response()->json(['success' => 'Updated!'], 200);
    	}
    	return response()->json(['error' => 'Server error. Please try again.'], 500);
    }
}
