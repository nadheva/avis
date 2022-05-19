<?php

namespace App\Controllers;
use App\Models\ProjectModel;

class Productivity extends BaseController
{
	/**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $db, $builder, $adminmodel;
    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->db      = \Config\Database::connect();
    }

    public function addProductivity()
    {
        $event_id = $this->request->getVar('event');
        $station = $this->request->getVar('station');
        $project_id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        $ct_target = $this->request->getVar('ct_target');
        $ct_actual = $this->request->getVar('ct_actual');
        $ftt_target = $this->request->getVar('ftt_target');
        $ftt_actual = $this->request->getVar('ftt_actual');
        $rr_target = $this->request->getVar('rr_target');
        $rr_actual = $this->request->getVar('rr_actual');
        $at_target = $this->request->getVar('at_target');
        $at_actual = $this->request->getVar('at_actual');
        // dd($at_actual, $at_target);
        $jmlh_station = count($station);
        $jmlh_cttarget = count($ct_actual);
        if ($jmlh_station == $jmlh_cttarget) {
            for ($x = 0; $x < $jmlh_cttarget; $x++) {
                $productivity = [
                    'project_id' => $project_id,
                    'event_id' => $event_id,
                    'station' => $station[$x],
                    'ct_target' => $ct_target,
                    'ct_actual' => $ct_actual[$x],
                    'ftt_target' => $ftt_target,
                    'ftt_actual' => $ftt_actual[$x],
                    'rr_target' => $rr_target,
                    'rr_actual' => $rr_actual[$x],
                    'at_target' => $at_target,
                    'at_actual' => $at_actual[$x],
                ];
                $this->builder = $this->db->table('productivity');
                $this->builder->insert($productivity);
            }
            session()->setFlashData('pesan', 'Success! new productivity has been created ✓');
            return redirect()->to(base_url('project/detailproject/' . $project_id . '/' . $idc));
        }
    }

    public function delProductivity($id = null, $idp = null, $idc = null)
    {
        $this->builder = $this->db->table('productivity');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Station in productivity has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/' . $idp . '/' . $idc));
    }

    public function editProductivity($id = null)
    {
        $project_id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        $ct_target = $this->request->getVar('ct_target');
        $ct_actual = $this->request->getVar('ct_actual');
        $ftt_target = $this->request->getVar('ftt_target');
        $ftt_actual = $this->request->getVar('ftt_actual');
        $rr_target = $this->request->getVar('rr_target');
        $rr_actual = $this->request->getVar('rr_actual');
        $at_target = $this->request->getVar('at_target');
        $at_actual = $this->request->getVar('at_actual');
        $data = [
            'ct_target' => $ct_target,
            'ct_actual' => $ct_actual,
            'ftt_target' => $ftt_target,
            'ftt_actual' => $ftt_actual,
            'rr_target' => $rr_target,
            'rr_actual' => $rr_actual,
            'at_target' => $at_target,
            'at_actual' => $at_actual,
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->db->table('productivity')->where('id', $id)->update($data);
        session()->setFlashData('pesan', 'Success update productivity');
        return redirect()->to(base_url('project/detailproject/'.$project_id.'/'.$idc));
    }
}