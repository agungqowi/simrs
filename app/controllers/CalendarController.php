<?php

class CalendarController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('calendars.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('calendars.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'title'    => 'required|min:3', // make sure the email is an actual email
			'date_start' => 'required',
			'date_end' => 'required' ,
			'time_start' => 'required' ,
			'time_end' => 'required' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('calendar/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$calendar = new Calendar;
			$calendar->title = Input::get('title');
			$calendar->start_date = date('Y-m-d', strtotime( Input::get('date_start') ));
			$calendar->end_date = date('Y-m-d', strtotime( Input::get('date_end') ));
			$calendar->description = Input::get('description');
			$calendar->start_time = Input::get('time_start').':00';
			$calendar->end_time = Input::get('time_end').':00';
			$calendar->user_id = Auth::user()->id;
			$calendar->public_visible = 0;

			$calendar->save();

			return Redirect::to('calendar')->with('success', 'Schedule Created Successfully.');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function seelist()
	{
		$calendars = Calendar::where('user_id', '=', Auth::user()->id )->get();
		$return_array = array();
		$color_array = array('black','blue','red','green');
        // Event array
        $event_array;
		foreach ($calendars as $row)
		{
		    $event_array = array();
            // Add data from database to the event array
            $event_array['id'] = $row->id;
            $event_array['title'] = $row->title;
            $event_array['start'] = date(DATE_ISO8601, strtotime($row->start_date.' '.$row->start_time));
            $event_array['end'] = date(DATE_ISO8601, strtotime($row->end_date.' '.$row->end_time));
            $event_array['allDay'] = false;
            $event_array['color'] = $color_array[array_rand($color_array)];
            $event_array['textColor'] = '#FFF';
            // Merge the event array into the return array
            array_push($return_array, $event_array);
		}
		echo json_encode($return_array);
	}


}
