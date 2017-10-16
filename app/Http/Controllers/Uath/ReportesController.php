<?php
/**
 * Created by PhpStorm.
 * User: jairoman
 * Date: 6/2/2017
 * Time: 15:04
 */

namespace UGCore\Http\Controllers\Uath;

use UGCore\Http\Controllers\Controller;
use UGCore\Core\Repositories\Uath\ReportesRepository;
use View;
use Font_Metrics;

class ReportesController extends Controller
{
    private $objReportes;

    public function __construct()
    {
        $this->objReportes = new ReportesRepository();
    }

    public function index()
    {
        return view("uath.formacion.reportes.index")
            ->with(['listaComboGruposRp' => $this->objReportes->forComboGrupos()]);
    }

    public function crear_nomina_grupos($datos, $vistaurl, $tipo,$grupo,$materia)
    {
        $nomina_grupos = $datos;
        $date = date('Y-m-d');
        $view = View::make($vistaurl, compact('nomina_grupos', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        /*NÚMERO DE PÁGINAS*/
        $font = Font_Metrics::get_font("Arial", "bold");
        $pdf->stream('pdf_nomina_grupos');
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(40, 800, "Pág. {PAGE_NUM} de {PAGE_COUNT}", $font, 10);
        $pdf->stream('pdf_nomina_grupos');
        /*GRUPO*/
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(36, 196, "Grupo: ".$grupo."      Materia: ".$materia, $font, 8);
        $pdf->stream('pdf_fecha_limite');
        /*FECHA - HORA*/
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(460, 800, \Utils::getDateSQL(), $font, 10);

        if ($tipo == 1) {
            return $pdf->stream('pdf_nomina_grupos');
        }
        if ($tipo == 2) {
            return $pdf->download('pdf_nomina_grupos.pdf');
        }
    }

    public function crear_nomina_estado($datos, $vistaurl, $tipo,$grupo,$estado)
    {
        $nomina_estado = $datos;
        $date = date('Y-m-d');
        $view = View::make($vistaurl, compact('nomina_estado', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        /*NÚMERO DE PÁGINAS*/
        $font = Font_Metrics::get_font("Arial", "bold");
        $pdf->stream('pdf_nomina_estado');
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(40, 800, "Pág. {PAGE_NUM} de {PAGE_COUNT}", $font, 10);
        $pdf->stream('pdf_nomina_estado');
        /*GRUPO*/
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(36, 196, "Grupo: ".$grupo."      Estado: ".$estado, $font, 8);
        $pdf->stream('pdf_nomina_estado');
        /*FECHA - HORA*/
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(460, 800, \Utils::getDateSQL(), $font, 10);

        if ($tipo == 1) {
            return $pdf->stream('pdf_nomina_estado');
        }
        if ($tipo == 2) {
            return $pdf->download('pdf_nomina_estado.pdf');
        }
    }

    public function crear_reporte($tipo, $repo)
    {

        $claves = preg_split("/;/", $repo);
        if ($claves[0] == "NominaGrupo") {
            $decodificado = base64_decode($claves[1]);
            $repo=$claves[0].';'.$decodificado;
            $claves = preg_split("/;/", $repo);
            $vistaurl = "uath.formacion.reportes.rpNominaGrupo";
            $nomina_grupos = $this->objReportes->nomina_grupos_uath($claves[1]);
            $nomMateria=$this->objReportes->forNombreMateria($claves[1]);
            return $this->crear_nomina_grupos($nomina_grupos, $vistaurl, $tipo,$claves[2],$nomMateria[0]);
        }
        else {
            if ($claves[0] == "NominaEstado") {
                $decodificado = base64_decode($claves[1]);
                $repo=$claves[0].';'.$decodificado;
                $claves = preg_split("/;/", $repo);
                $vistaurl = "uath.formacion.reportes.rpNominaEstado";
                $nomina_estado = $this->objReportes->nomina_estado_uath($claves[1],$claves[2]);
                return $this->crear_nomina_estado($nomina_estado, $vistaurl, $tipo,$claves[4],$claves[3]);
            }
        }
    }
}