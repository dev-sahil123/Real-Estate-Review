<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\Image;

class Property extends Model
{
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function firstPhoto() {
		return $this->hasOne(Image::class, 'type_id')->where('type', 'property_image');
	}
    public function photos(){
        return $this->hasMany(Image::class, 'type_id')->where('type', 'property_image');
    }

    public function propertyLiveProofDocs(){
        return $this->hasMany(Document::class, 'type_id')->where('type', 'property_live_proof_doc');
    }
    public function rentIncreaseDocs(){
        return $this->hasMany(Document::class, 'type_id')->where('type', 'rent_increase_doc');
    }
    public function propertyDocs(){
        return $this->hasMany(Document::class, 'type_id')->where('type', 'property_doc');
    }
    public function relationLandlordDocs(){
        return $this->hasMany(Document::class, 'type_id')->where('type', 'relation_landlord_doc');
    }
    public function propertyLivingConditionDocs(){
        return $this->hasMany(Document::class, 'type_id')->where('type', 'property_living_condition_doc');
    }
    public function legalIssuesDocs(){
        return $this->hasMany(Document::class, 'type_id')->where('type', 'legal_issues_doc');
    }
    public function legalIssuesLandlordDocs(){
        return $this->hasMany(Document::class, 'type_id')->where('type', 'legal_issue_landlord_doc');
    }

    public function getPropertyConditionLabelAttribute(){
        if($this->property_condition == '0') {
            return 'Dangerous/ hazardous';
        }else if($this->property_condition == '1') {
            return 'Heavy damages/ issues';
        }else if($this->property_condition == '2'){
            return 'Uncomfortable damages';
        }else if($this->property_condition == '3'){
            return 'Fair condition';
        }else if($this->property_condition == '4'){
            return 'Good condition';
        }else if($this->property_condition == '5'){
            return 'Perfect condition';
        }else{
            return 'Not Provided';
        }
    }

    public function getRelationLandlordLabelAttribute(){
        if($this->relation_landlord == '0') {
            return 'Unmanageable (no repairs creating a hazard, illegal/ unethical actions etc…)';
        }else if($this->relation_landlord == '1'){
            return 'Unsatisfactory (rudeness, no repair creating discomfort, unreachable)';
        }else if($this->relation_landlord == '2'){
            return 'Passable (difficulty reaching them, feeling ignored or dismissed)';
        }else if($this->relation_landlord == '3'){
            return 'Moderate (neither good nor bad)';
        }else if($this->relation_landlord == '4'){
            return 'Good (good, the reasonable tenancy rights being respected)';
        }else if($this->relation_landlord == '5'){
            return 'Excellent (went above and beyond, friendly, flexible etc…)';
        }else{
            return 'Not Provided';
        }
    }

    public function getPropertyLivingConditionLabelAttribute(){
        if($this->property_living_condition == '0') {
            return 'Unmanageable (noises being unbearable, neighbours creating issues far beyond reasonable, problematic street/ neighbourhood that weren’t discussed)';
        }else if($this->property_living_condition == '1'){
            return 'Unsatisfactory (loud noises - from streets or neighbours -, rude neighbours, other issues)';
        }else if($this->property_living_condition == '2'){
            return 'Passable (not a good experience overall)';
        }else if($this->property_living_condition == '3'){
            return 'Moderate (neither good nor bad)';
        }else if($this->property_living_condition == '4'){
            return 'Good (friendly neighbours, good street, good location, quiet, etc…).';
        }else if($this->property_living_condition == '5'){
            return 'Excellent (would highly recommend living there)';
        }else{
            return 'Not Provided';
        }
    }
}