<?php

namespace App\Repositories;

use PragmaRX\Countries\Package\Services\Countries;

class CountryRepository implements CountryRepositoryInterface
{
  public function getAllCountryCodes()
  {
    $countries = new Countries();

    $countryCodes = $countries
      ->all()
      ->map(function ($country) {
        return $country->cca2;
      })
      ->values()
      ->toArray();

    sort($countryCodes);

    return $countryCodes;
  }
}
