<?php

namespace App\Repositories\Interfaces;

interface AirplaneRepositoryInterface 
{
  public function all($paginate = null);
  public function get($id);
}