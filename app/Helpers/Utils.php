<?php


namespace App\Helpers;

use App\Pharmacist;
use App\Pharmacy;
use App\University;

class Utils
{

  public function titles($json = true)
  {

    $titles =  [
      ['id' => '', 'name' => 'Select Your Title'],
      ['id' => 'mr', 'name' => 'Mr'],
      ['id' => 'ms', 'name' => 'Mr'],
      ['id' => 'miss', 'name' => 'Miss'],
      ['id' => 'mrs', 'name' => 'Mrs'],
      ['id' => 'dr', 'name' => 'Dr'],
    ];

    return ($json) ? json_encode($titles) : $titles;
  }


  public function pharmaciesOptions($json = true)
  {

    $data =  [
      ['id' => '1', 'name' => '1 Pharmacy'],
      ['id' => '2', 'name' => "2 Pharmacysts"]
    ];

    return ($json) ? json_encode($data) : $data;
  }



  public function pharmacies($json = true)
  {

    $data = Pharmacy::orderBy('trading_name', 'asc')->get()->map(function ($pharmacy) {
      return ['id' => $pharmacy->id, 'name' => $pharmacy->trading_name . ' | ' . $pharmacy->address_1 . ', ' . $pharmacy->post_code . ' - ' .  $pharmacy->county];
    })->toArray();

    array_unshift($data, ['id' => null, 'name' => 'Select Pharmacists']);


    return ($json) ? json_encode($data) : $data;
  }


  public function tutorsOptions($json = true)
  {

    $data =  [
      ['id' => '1', 'name' => '1 Tutor'],
      ['id' => '2', 'name' => "2 Tutors"]
    ];

    return ($json) ? json_encode($data) : $data;
  }

  public function tutors($json = true)
  {

    $data = Pharmacist::where('verified', true)->orderBy('surname', 'asc')->get()->map(function ($pharmacist) {
      return ['id' => $pharmacist->id, 'name' => $pharmacist->surname . ', ' . $pharmacist->forenames . ' (' . $pharmacist->registration_number . ')'];
    })->toArray();

    array_unshift($data, ['id' => null, 'name' => 'Select Tutor']);


    return ($json) ? json_encode($data) : $data;
  }


  public function counties()
  {

    $counties = '[{"country":"england","county":"Bedfordshire"},{"country":"england","county":"Buckinghamshire"},{"country":"england","county":"Cambridgeshire"},{"country":"england","county":"Cheshire"},{"country":"england","county":"Cleveland"},{"country":"england","county":"Cornwall"},{"country":"england","county":"Cumbria"},{"country":"england","county":"Derbyshire"},{"country":"england","county":"Devon"},{"country":"england","county":"Dorset"},{"country":"england","county":"Durham"},{"country":"england","county":"East Sussex"},{"country":"england","county":"Essex"},{"country":"england","county":"Gloucestershire"},{"country":"england","county":"Greater London"},{"country":"england","county":"Greater Manchester"},{"country":"england","county":"Hampshire"},{"country":"england","county":"Hertfordshire"},{"country":"england","county":"Kent"},{"country":"england","county":"Lancashire"},{"country":"england","county":"Leicestershire"},{"country":"england","county":"Lincolnshire"},{"country":"england","county":"Merseyside"},{"country":"england","county":"Norfolk"},{"country":"england","county":"North Yorkshire"},{"country":"england","county":"Northamptonshire"},{"country":"england","county":"Northumberland"},{"country":"england","county":"Nottinghamshire"},{"country":"england","county":"Oxfordshire"},{"country":"england","county":"Shropshire"},{"country":"england","county":"Somerset"},{"country":"england","county":"South Yorkshire"},{"country":"england","county":"Staffordshire"},{"country":"england","county":"Suffolk"},{"country":"england","county":"Surrey"},{"country":"england","county":"Tyne and Wear"},{"country":"england","county":"Warwickshire"},{"country":"england","county":"West Berkshire"},{"country":"england","county":"West Midlands"},{"country":"england","county":"West Sussex"},{"country":"england","county":"West Yorkshire"},{"country":"england","county":"Wiltshire"},{"country":"england","county":"Worcestershire"},{"country":"wales","county":"Flintshire"},{"country":"wales","county":"Glamorgan"},{"country":"wales","county":"Merionethshire"},{"country":"wales","county":"Monmouthshire"},{"country":"wales","county":"Montgomeryshire"},{"country":"wales","county":"Pembrokeshire"},{"country":"wales","county":"Radnorshire"},{"country":"wales","county":"Anglesey"},{"country":"wales","county":"Breconshire"},{"country":"wales","county":"Caernarvonshire"},{"country":"wales","county":"Cardiganshire"},{"country":"wales","county":"Carmarthenshire"},{"country":"wales","county":"Denbighshire"},{"country":"scotland","county":"Aberdeen City"},{"country":"scotland","county":"Aberdeenshire"},{"country":"scotland","county":"Angus"},{"country":"scotland","county":"Argyll and Bute"},{"country":"scotland","county":"City of Edinburgh"},{"country":"scotland","county":"Clackmannanshire"},{"country":"scotland","county":"Dumfries and Galloway"},{"country":"scotland","county":"Dundee City"},{"country":"scotland","county":"East Ayrshire"},{"country":"scotland","county":"East Dunbartonshire"},{"country":"scotland","county":"East Lothian"},{"country":"scotland","county":"East Renfrewshire"},{"country":"scotland","county":"Eilean Siar"},{"country":"scotland","county":"Falkirk"},{"country":"scotland","county":"Fife"},{"country":"scotland","county":"Glasgow City"},{"country":"scotland","county":"Highland"},{"country":"scotland","county":"Inverclyde"},{"country":"scotland","county":"Midlothian"},{"country":"scotland","county":"Moray"},{"country":"scotland","county":"North Ayrshire"},{"country":"scotland","county":"North Lanarkshire"},{"country":"scotland","county":"Orkney Islands"},{"country":"scotland","county":"Perth and Kinross"},{"country":"scotland","county":"Renfrewshire"},{"country":"scotland","county":"Scottish Borders"},{"country":"scotland","county":"Shetland Islands"},{"country":"scotland","county":"South Ayrshire"},{"country":"scotland","county":"South Lanarkshire"},{"country":"scotland","county":"Stirling"},{"country":"scotland","county":"West Dunbartonshire"},{"country":"scotland","county":"West Lothian"},{"country":"northern_ireland","county":"Antrim"},{"country":"northern_ireland","county":"Armagh"},{"country":"northern_ireland","county":"Down"},{"country":"northern_ireland","county":"Fermanagh"},{"country":"northern_ireland","county":"Derry / Londonderry"},{"country":"northern_ireland","county":"Tyrone"}]';
    $counties  = collect(json_decode($counties));

    return $counties;
  }


  public function universities()
  {
    $data = University::orderBy('name', 'asc')->get()->map(function ($university) {
      return ['id' => $university->id, 'name' => $university->name];
    })->toArray();

    array_unshift($data, ['id' => '', 'name' => 'Select Your University']);

    return json_encode($data);
  }
}
