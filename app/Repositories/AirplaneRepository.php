<?php

namespace App\Repositories;

use App\Airplane;
use App\Repositories\Interfaces\AirplaneRepositoryInterface;

class AirplaneRepository implements AirplaneRepositoryInterface
{
  protected $model;

  /**
    * Initilize the construct with the model
    *
    * @param App\Airplane $model 
    */
  public function __construct(Airplane $model)
  {
    $this->model = $model;
  }

  /**
   * Fetch all the instances of this instance 
   * 
   * @param integer $paginate 
   */
  public function all($paginate = null) 
  {
    return ($paginate == null) ? $this->model->latest()->all()
                               : $this->model->latest()->paginate($paginate);
  }

  /**
   * Fetch a single instance of this model based on ID
   *
   * @param integer $id
   */
  public function get($id)
  {
    return $this->model->get($id);
  }
}