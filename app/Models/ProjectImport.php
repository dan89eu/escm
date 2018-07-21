<?php

namespace App\Models;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Model;



class ProjectImport extends Model
{


    public $fillable = [
	    'item_no',
        'city',
        'smart_city_solution',
        'smart_economy',
        'smart_mobility',
        'smart_environment',
        'smart_people',
        'smart_living',
        'smart_governance',
        'category_in_smart_city_vertical_separated_by',
	    'description_of_smart_city_solution',
	    'quantity',
	    'quality_indicators',
	    'communication_infrastructure',
	    'project_value_eur',
	    'date',
	    'status',
	    'supplier_separated_by',
	    'beneficiary_separated_by',
	    'source_of_info_separated_by'

    ];

	protected $appends = ['errors','completeness'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
	    'city' => 'string',
	    'smart_city_solution' => 'string',
	    'smart_economy' => 'string',
	    'smart_mobility' => 'string',
	    'smart_environment' => 'string',
	    'smart_people' => 'string',
	    'smart_living' => 'string',
	    'smart_governance' => 'string',
	    'category_in_smart_city_vertical_separated_by' => 'string',
	    'description_of_smart_city_solution' => 'string',
	    'quantity' => 'string',
	    'quality_indicators' => 'string',
	    'communication_infrastructure' => 'string',
	    'project_value_eur' => 'string',
	    'status' => 'string',
	    'supplier_separated_by' => 'string',
	    'beneficiary_separated_by' => 'string',
	    'source_of_info_separated_by' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'city' => 'required'
    ];

    public function getErrorsAttribute()
    {
	    $errors = [];
	    if (!$this->smart_city_solution){
		    $errors[] = "smart_city_solution";
	    }
	    if ($this->smart_economy||$this->smart_mobility||$this->smart_environment||$this->smart_people||$this->smart_living||$this->smart_governance){

	    }else {
		    $errors[] = "smart_vertical";
	    }

	    $location = Location::where('locality_name',$this->city)->first();
	    if(!$location){
		    $errors[] = "no_city";
	    }

	    return $errors;
    }

    public function getCompletenessAttribute(){
    	$total = 0;
    	foreach ($this->getAttributes() as $key=>$value){
    		if($value)
    			$total++;
	    }
	    return round($total/(count($this->getAttributes())-5),2);
    }

    public function projectArray(){
    	$project = [];
	    $project['name'] = $this->smart_city_solution;
	    $project['details'] = $this->description_of_smart_city_solution;
	    $project['final_delivery_date'] = $this->date;
	    $project['initialCost'] = $this->project_value_eur;
	    $project['status'] = $this->status;
	    $project['quantity'] = $this->quantity;
	    $project['quality_indicators'] = $this->quality_indicators;
	    return $project;
    }

	public function getCategoryArray(){

		$categorys = [];

		$tempCategory = explode(";",$this->category_in_smart_city_vertical_separated_by);
		foreach ($tempCategory as $val)
		{
			$catId = Category::firstOrCreate(['code'=>$val]);
			$categorys[] = $catId;
		}

		return $categorys;
	}

	public function getConnectivityArray(){

		$return = [];

		$temp = explode(";",$this->communication_infrastructure);
		foreach ($temp as $val)
		{
			$catId = Conectivity::firstOrCreate(['name'=>$val]);
			$return[] = $catId;
		}

		return $return;
	}

    public function getVerticalsArray(){
    	$verticals = [];
	    if($this->smart_economy){
		    $verticals[] = 11;
	    }
	    if($this->smart_mobility){
		    $verticals[] = 2;
	    }
	    if($this->smart_environment){
		    $verticals[] = 12;
	    }
	    if($this->smart_people){
		    $verticals[] = 4;
	    }
	    if($this->smart_living){
		    $verticals[] = 13;
	    }
	    if($this->smart_governance){
		    $verticals[] = 6;
	    }
	    return $verticals;
    }

	public function getBeneficiaryArray(){
		$return = [];

		$temp = explode(";",$this->beneficiary_separated_by);
		foreach ($temp as $val)
		{
			$cat = Beneficiary::where("slug", (new Slugify())->slugify($val))->first();
			if(!$cat){
				$cat = new Beneficiary(['name'=>$val]);
				$cat->save();
			}
			$return[] = $cat->id;
		}

		return $return;
	}

	public function getProvidersArray(){
		$return = [];

		$temp = explode(";",$this->supplier_separated_by);
		foreach ($temp as $val)
		{
			$cat = Provider::where("slug", (new Slugify())->slugify($val))->first();
			if(!$cat){
				$cat = new Provider(['name'=>$val]);
				$cat->save();
			}
			$return[] = $cat->id;
		}

		return $return;
	}

}
