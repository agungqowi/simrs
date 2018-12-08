<?php

class UserController_old extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('user.list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$group = DB::table('groups')->get();
		return View::make('user.create' , array('grup' => $group));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$username = Input::get('username');
		$password = Input::get('password');
		$email = Input::get('email');
		$name = Input::get('name');
		$group = Input::get('grup');

		$user = new User;
		$user->username = $username;
		$user->password = Hash::make($password);
		$user->password_remember = $password;
		$user->email = $email;
		$user->group_id = $group;
		$user->name = $name;

		$user->save();

		return Redirect::to('user')->with('success', 'User berhasil ditambahkan');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$profile = User::find($id);
		return View::make('user.show' , array('profile' => $profile));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$group = DB::table('groups')->get();
		$user = User::find($id);
		return View::make('user.edit' , array('grup' => $group , 'user' => $user));
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
		$username = Input::get('username');
		$password = Input::get('password');
		$email = Input::get('email');
		$name = Input::get('name');
		$group = Input::get('grup');

		$user = User::find($id);
		$user->username = $username;
		if($password != ''){
			$user->password = Hash::make($password);
			$user->password_remember = $password;
		}
		
		$user->email = $email;
		$user->group_id = $group;
		$user->name = $name;

		$user->save();

		return Redirect::to('user')->with('success', 'User berhasil diubah');
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

	public function profile()
	{
		$projects = User::find( Auth::user()->id )->projects;
		$profile = Auth::user();
		return View::make('user.profile' , array('profile' => $profile , 'projects' => $projects));
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$ruangan = DB::table('users')->join('groups','users.group_id' , '=' , 'groups.id')->select('users.*', 'groups.name as group_name');
		return Datatable::query($ruangan)
			->addColumn('id',function($model)
        	{
            	return '<a href="'.url('user/'.$model->id.'/edit').'">'.$model->id.'</a>';
        	})
			->showColumns('username','name','group_name','password_remember')
			->addColumn('Action',function($model)
        	{
            	return '<a href="'.url('user/'.$model->id.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->id."','User'".')"><i class="splashy-gem_remove"></i></a>';
        	})
			->searchColumns('username','users.name')
			->orderColumns('username','users.name')->make();
	}


}
