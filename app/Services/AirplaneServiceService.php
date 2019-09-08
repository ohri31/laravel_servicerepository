<?php

namespace App\Services;

use App\Services\Interfaces\AirplaneServiceServiceInterface;
use App\Repositories\Interfaces\AirplaneServiceRepositoryInterface;

class AirplaneServiceService implements AirplaneServiceServiceInterface 
{
  protected $airplaneServiceRepository;

  public function __construct(AirplaneServiceRepositoryInterface $airplaneServiceRepository)
  {
    $this->airplaneServiceRepository = $airplaneServiceRepository;
  }
}