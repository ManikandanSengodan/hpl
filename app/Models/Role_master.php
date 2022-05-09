<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_master extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];
   
   
     
    public static function getMenu()
    {
        $data = Role_master::get();
        
        $result = [];
        
         $result[] =  [ "text"=> 'Add Staff' ,
                            "href"=> url('staffs/create'),
                            
                            "url"=> 'staffs/create',
                           "active"=> false , 
                           "class" => ""];
        
        foreach($data as $d){
            
          $result[] =  [ "text"=> $d->name ,
                            "href"=> url('stafflist',$d->id),
                            
                            "url"=> 'stafflist/'.$d->id,
                           "active"=> false , 
                           "class" => ""];
         }
        return $result;

    }
    
   
}
