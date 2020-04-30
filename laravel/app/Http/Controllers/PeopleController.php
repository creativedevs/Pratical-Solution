<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import the storage facade
use Illuminate\Support\Facades\Storage;
use Cz\Git\GitRepository;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
	{
		$d = shell_exec('git clone git@github.com:creativedevs/Pratical-Solution.git');
		$output = shell_exec('git pull origin master');
	    $data = file_get_contents(asset('../Web.json'));
	    return view('people.index', ['data' => json_decode($data, true)]);
	}

    /**
     * Store a new data in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request)
    {
        $input = $request->all();
        $filename = $input['people'].'.txt';
        $exists = Storage::disk('local')->exists($filename);
        if ($exists) 
        {
        	return redirect()->action('PeopleController@index')
                ->withErrors(['errorMessage'=>'File is already exists!!'])
                ->withInput();
        }
        Storage::put( $filename,  $input['people']);
        $output = shell_exec('git  add .');
		$output1 = shell_exec('git -c user.name="creativedevs" -c user.email="info@thecreativedev.com" commit -m "Created new file named: ' . $filename . ' " ' . $filename);
        $output2 = shell_exec('git push origin master');
        return redirect()->action('PeopleController@index')
        ->withSuccess('File created successfully');
    }
}
