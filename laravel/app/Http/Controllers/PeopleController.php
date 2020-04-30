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
		$search = $request->search;
		
		shell_exec('git pull origin master');
	    $data = file_get_contents(asset('../Web.json'));

	    $result = [];
	    $data = json_decode($data, true);
	    // foreach ($data as $key => $node) {
     //        foreach ($node['fullName'] as $code => $name) {
     //        	if( in_array( $search, $name ) ) array_push($result, $name);
     //        }
	    // }
	    return view('people.index', ['data' => $data]);
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
        $output2 = shell_exec('git push origin master');
        return redirect()->action('PeopleController@index');
    }
}
