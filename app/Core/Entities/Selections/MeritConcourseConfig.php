<?php
namespace UGCore\Core\Entities\Selections;
use UGCore\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Utils;
use UGCore\Core\Entities\SelectsBasics;


class MeritConcourseConfig extends CoreModel
{
	use SoftDeletes;
    public $timestamps = true;
    protected $table = 'Concourse.merit_concourse_configs';
    protected $connection= "sqlsrv_modulos";


   public function meritinputmasters($flag=false,$user_id='none')
	{
		if(!$flag){
	  		return ($this->hasMany(MeritInputMaster::class,'merit_concourse_config_id','id'));
		}else{
			return ($this->hasMany(MeritInputMaster::class,'merit_concourse_config_id','id')->where('user_id',$user_id)->first());
		}
	}


	public function getPeopleConcourse($id){
		       return (MeritInputMaster::join('coresystem.dbo.users', 'coresystem.dbo.users.name', '=', 'Concourse.merit_input_masters.nuic') ->where('Concourse.merit_input_masters.merit_concourse_config_id','=',$id)
                ->where('Concourse.merit_input_masters.status','=','F')
                ->select('Concourse.merit_input_masters.id as id','Concourse.merit_input_masters.nuic as nuic',DB::raw("CONVERT(VARCHAR(24),Concourse.merit_input_masters.created_at,120) as fecha"),'coresystem.dbo.users.description as description', 'coresystem.dbo.users.email as email')
                ->get());

	}



    public function steps($step){
        return MeritConcourseStep::where('select_basic_id','=',$step)
            ->where('date_start', '<=', Utils::getDateSQL(true, false))
            ->where('date_end', '>=', Utils::getDateSQL(true, false))
            ->where('merit_concourse_config_id', '=', $this->id)
            ->count();
    }

    public function matrices(){
        return $this->hasMany(MeritConcourseConfigMatriz::class,'merit_concourse_config_id','id');
    }

    public function comisiones(){
        return $this->hasMany(MeritConcourseConfigComision::class,'merit_concourse_config_id','id');
    }

}
	

