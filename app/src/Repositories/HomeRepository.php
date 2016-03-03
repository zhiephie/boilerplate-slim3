<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

class HomeRepository extends BaseRepository {
	
	/**
	 * The Tag instance.
	 *
	 * @var App\Models\Users
	 */
	protected $user;

	/**
	 * Create a new HomeRepository instance.
	 *
	 * @param  App\Models\Users $users
	 * @return void
	 */
	public function __construct($user)
	{
		$this->model = $user;
	}

	/**
	 * Create a query for Post.
	 *
	 * @return Illuminate\Database\Eloquent\Builder
	 */
  	private function query($skip, $take)
	{	
		return $this->model
		->select('id', 'created_at', 'updated_at', 'email', 'first_name', 'last_name')
		->take($take)->skip($skip)
		->get();
	}

	/**
	 * Get post collection.
	 *
	 * @param  int  $n
	 * @return Illuminate\Support\Collection
	 */
	public function index($skip, $take)
	{
		$query = $this->query($skip, $take);

		return $query;
	}
	
}