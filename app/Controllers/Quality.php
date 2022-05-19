<?php

namespace App\Controllers;

class Quality extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function addquality() {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        if(!$this->validate([
            'issue' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errorfix', 'Failed! Please add issue');
            return redirect()->to('project/detailproject/'.$id.'/'.$idc)->withInput();
        }
        $data = [
            'project_id' => $this->request->getVar('project_id'),
            'event' => $this->request->getVar('event'),
            'date' => date('Y-m-d', time()),
            'issue' => $this->request->getVar('issue'),
            'description' => $this->request->getVar('description'),
            'lead' => $this->request->getVar('lead'),
            'closing_action' => $this->request->getVar('closing_action'),
            'status' => 'Open'
        ];
        $this->db->table('quality')->insert($data);
        session()->setFlashData('pesan', 'Success add quality ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function addqualitysl() {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        if(!$this->validate([
            'issue' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errorfix', 'Failed! Please add issue');
            return redirect()->to('project/detailproject/'.$id.'/'.$idc)->withInput();
        }
        $data = [
            'project_id' => $this->request->getVar('project_id'),
            'event' => $this->request->getVar('event'),
            'date' => date('Y-m-d', time()),
            'issue' => $this->request->getVar('issue'),
            'description' => $this->request->getVar('description'),
            'lead' => $this->request->getVar('lead'),
            'closing_action' => $this->request->getVar('closing_action'),
            'status' => 'Open'
        ];
        $this->db->table('quality_safelaunch')->insert($data);
        session()->setFlashData('pesan', 'Success add issue safe launch ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function addqcustppap() {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        if(!$this->validate([
            'required_items' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errorfix', 'Failed! Please add required_items');
            return redirect()->to('project/detailproject/'.$id.'/'.$idc)->withInput();
        }
        $data = [
            'project_id' => $this->request->getVar('project_id'),
            'event' => $this->request->getVar('event'),
            'submission_date' => date('Y-m-d', strtotime($this->request->getVar('submission_date'))),
            'required_items' => $this->request->getVar('required_items'),
            'pic' => $this->request->getVar('pic'),
            'flag' => 'Red',
            'status' => 'Open'
        ];
        $this->db->table('quality_custppap')->insert($data);
        session()->setFlashData('pesan', 'Success add issue Customer PPAP ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function addqsupppap() {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        if(!$this->validate([
            'supplier' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errorfix', 'Failed! Please add required_items');
            return redirect()->to('project/detailproject/'.$id.'/'.$idc)->withInput();
        }
        $data = [
            'project_id' => $this->request->getVar('project_id'),
            'supplier' => $this->request->getVar('supplier'),
            'target_date' => date('Y-m-d', strtotime($this->request->getVar('target_date'))),
            'component' => $this->request->getVar('component'),
            'pic' => $this->request->getVar('pic'),
            'flag' => 'Red',
            'status' => 'Open'
        ];
        $this->db->table('quality_supppap')->insert($data);
        session()->setFlashData('pesan', 'Success add issue Supplier PPAP ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function addpvstatus() {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        if(!$this->validate([
            'test_item' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errorfix', 'Failed! Please add test item');
            return redirect()->to('project/detailproject/'.$id.'/'.$idc)->withInput();
        }
        $data = [
            'project_id' => $this->request->getVar('project_id'),
            'test_item' => $this->request->getVar('test_item'),
            'plan_start' => date('Y-m-d', strtotime($this->request->getVar('plan_start'))),
            'plan_completed' => date('Y-m-d', strtotime($this->request->getVar('plan_completed'))),
            'actual_start' => date('Y-m-d', strtotime($this->request->getVar('actual_start'))),
            'actual_completed' => date('Y-m-d', strtotime($this->request->getVar('actual_completed'))),
            'result' => $this->request->getVar('result'),
            'flag' => 'Red',
        ];
        $this->db->table('quality_pvtest')->insert($data);
        session()->setFlashData('pesan', 'Success add PV Test ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function addpvsummary() {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        if(!$this->validate([
            'total_test' => [ 'required'
        ],
            'test_done' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errorfix', 'Failed! Please add test item');
            return redirect()->to('project/detailproject/'.$id.'/'.$idc)->withInput();
        }
        $data = [
            'project_id' => $this->request->getVar('project_id'),
            'total_test' => $this->request->getVar('total_test'),
            'test_done' => $this->request->getVar('test_done'),
            'past_first_test' => $this->request->getVar('past_first_test'),
            'flag' => 'Red',
        ];
        $this->db->table('quality_pvtestsum')->insert($data);
        session()->setFlashData('pesan', 'Success add PV Summary ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function addcas() {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        if(!$this->validate([
            'component' => [ 'required'
        ],
            'supplier' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errorfix', 'Failed! Please add test item');
            return redirect()->to('project/detailproject/'.$id.'/'.$idc)->withInput();
        }
        $data = [
            'project_id' => $this->request->getVar('project_id'),
            'component' => $this->request->getVar('component'),
            'supplier' => $this->request->getVar('supplier'),
            'sc_point' => $this->request->getVar('sc_point'),
            'all_point' => $this->request->getVar('all_point'),
            'visual' => $this->request->getVar('visual'),
            'cpcpk_compliance' => $this->request->getVar('compliance'),
            'component_level_testing' => $this->request->getVar('clt'),
            'eser_aar_status' => $this->request->getVar('eser_aar_status'),
            'remark' => $this->request->getVar('remark'),
            'lead' => $this->request->getVar('lead'),
            'flag' => 'Red',
            'status' => 'open',
        ];
        // dd($data);
        $this->db->table('quality_cas')->insert($data);
        session()->setFlashData('pesan', 'Success add Component Approval Status ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function editquality($idq = NULL) {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        $data = [
            'issue' => $this->request->getVar('issue'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
            'closing_action' => $this->request->getVar('closing_action'),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->db->table('quality')->where('id', $idq)->update($data);
        session()->setFlashData('pesan', 'Success update issue development ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function editqualitysl($idq = NULL) {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        // dd($this->request->getVar('status'));
        $data = [
            'issue' => $this->request->getVar('issue'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
            'closing_action' => $this->request->getVar('closing_action'),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->db->table('quality_safelaunch')->where('id', $idq)->update($data);
        session()->setFlashData('pesan', 'Success update issue safe launch  ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function editqualitycustppap($idq = NULL) {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        // dd($this->request->getVar('status'));
        $data = [
            'status' => $this->request->getVar('status'),
            'flag' => $this->request->getVar('flag'),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->db->table('quality_custppap')->where('id', $idq)->update($data);
        session()->setFlashData('pesan', 'Success update issue customer PPAP ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function editqualitysupppap($idq = NULL) {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        // dd($this->request->getVar('status'));
        $data = [
            'status' => $this->request->getVar('status'),
            'flag' => $this->request->getVar('flag'),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->db->table('quality_supppap')->where('id', $idq)->update($data);
        session()->setFlashData('pesan', 'Success update issue supplier PPAP ✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function editpvtest($idq = NULL) {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        $data = [
            'flag' => $this->request->getVar('flag'),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->db->table('quality_pvtest')->where('id', $idq)->update($data);
        session()->setFlashData('pesan', 'Success update Pv test✓');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function editpvtestsum($idq = NULL) {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        $data = [
            'flag' => $this->request->getVar('flag'),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->db->table('quality_pvtestsum')->where('id', $idq)->update($data);
        session()->setFlashData('pesan', 'Success update Pv summary');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function editcas($idq = NULL) {
        $id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        $data = [
            'component' => $this->request->getVar('component'),
            'supplier' => $this->request->getVar('supplier'),
            'sc_point' => $this->request->getVar('sc_point'),
            'all_point' => $this->request->getVar('all_point'),
            'visual' => $this->request->getVar('visual'),
            'cpcpk_compliance' => $this->request->getVar('compliance'),
            'component_level_testing' => $this->request->getVar('clt'),
            'eser_aar_status' => $this->request->getVar('eser_aar_status'),
            'remark' => $this->request->getVar('remark'),
            'lead' => $this->request->getVar('lead'),
            'flag' =>  $this->request->getVar('flag'),
            'status' =>  $this->request->getVar('status'),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->db->table('quality_cas')->where('id', $idq)->update($data);
        session()->setFlashData('pesan', 'Success update Compoent Approval Status');
        return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
    }

    public function delIssueDev($id = null, $idp = null, $idc = null)
    {
        $this->builder = $this->db->table('quality');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Issue Customer Development has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/' . $idp . '/' . $idc));
    }

    public function delIssueSl($id = null, $idp = null, $idc = null)
    {
        $this->builder = $this->db->table('quality_safelaunch');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Issue Customer Safe Launh has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/' . $idp . '/' . $idc));
    }

    public function delIssueCustPPAP($id = null, $idp = null, $idc = null)
    {
        $this->builder = $this->db->table('quality_custppap');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Issue Customer PPAP has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/' . $idp . '/' . $idc));
    }

    public function delIssueSupPPAP($id = null, $idp = null, $idc = null)
    {
        $this->builder = $this->db->table('quality_custppap');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Issue Customer PPAP has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/' . $idp . '/' . $idc));
    }

    public function delPvTest($id = null, $idp = null, $idc = null)
    {
        $this->builder = $this->db->table('quality_pvtest');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Issue Pv Test has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/' . $idp . '/' . $idc));
    }

    public function delPvTestSum($id = null, $idp = null, $idc = null)
    {
        $this->builder = $this->db->table('quality_pvtestsum');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Issue Pv Test Summary has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/' . $idp . '/' . $idc));
    }
}