<?php
namespace UGCore\Core\Entities\Selections;
use UGCore\Core\Entities\CoreModel;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MerittypedocumentController
 *
 * @author  The scaffold-interface created at 2016-07-28 09:03:28pm
 * @link  https://github.com/amranidev/scaffold-interfac
 */
class Merittypedocument extends CoreModel
{

    public $timestamps = true;
protected $connection= "sqlsrv_modulos";
    protected $table = 'Concourse.merittypedocuments';



	public static function getSummaryDocuments($concourseConfigID,$nuic,$category){
		return DB::connection('sqlsrv_modulos')->select(DB::raw("select 	md.name as NOMBRE, md.description as DESCRIPCION,count(im.id) as TOTAL
			from Catalogos.merittypedocuments md
			left join 	Concourse.merit_input_details d
						on md.id=d.merittypedocument_id
			left join Concourse.merit_input_masters im
						on im.id=d.merit_input_master_id
							and  im.merit_concourse_config_id=?
							and im.nuic=?
			where md.meritcategory_id=?
			group by md.name,md.description"),[$concourseConfigID,$nuic,$category]);

		
	}

	public function existConceptInConcourse($concourse){
        $objMeritConcourseConcept= MeritConcourseConcept::where('merittypedocument_id','=',$this->id)
            ->where('merit_concourse_config_id','=',$concourse)
            ->first();

        if($objMeritConcourseConcept==null){
            return false;
        }else{
            if($objMeritConcourseConcept->status=='A'){
                return true;
            }else{
                return false;
            }
        }
    }

    public function meritTypeDocumentFields(){
        return $this->hasMany(MeritTypeDocumentField::class,'merittypedocument_id','id');
    }
}
