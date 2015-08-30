<?php

class HomeController extends BaseController {

    public function index()
	{
		$this->layout->with('subtitle', '');

		$this->layout->content = View::make('home');
	}

}