<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import the storage facade
use Illuminate\Support\Facades\Storage;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
	{
		shell_exec('git pull origin master');
	    $data = file_get_contents(asset('../Web.json'));
	    return view('people.index', ['data' => json_decode($data, true)]);
	}

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request)
    {
        $input = $request->all();
        $exists = Storage::disk('local')->exists($input['people'].'.txt');
        if ($exists) 
        {
        	return redirect()->action('PeopleController@index')
                        ->withErrors(['errorMessage'=>'File is already exists!!'])
                        ->withInput();
        }
        Storage::put( $input['people'].'.txt',  $input['people']);
        $output = shell_exec('git  add .');

$output1 = shell_exec('git -c user.name="creativedevs" -c user.email="info@thecreativedev.com" commit -m "Created new file named: '. $input['people'] .'"');
dd($output1);	
        $output2 = shell_exec('git push origin master 2>&1');
dd($output2);	
        return redirect()->action('PeopleController@index');
    }
}
