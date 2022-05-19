<?php

namespace App\Controllers;
use App\Models\ProjectModel;

class WebView extends BaseController
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
    	$this->projectModel = new ProjectModel();
    	$this->db      = \Config\Database::connect();
    }
    public function index()
    {
    	$this->builder = $this->db->table('customer');
    	$query = $this->builder->get()->getResult();
    	$this->builder = $this->db->table('users');
    	$this->builder->where('id !=', 1);
    	$user = $this->builder->get()->getResult();
    	foreach($this->projectModel->getProjectJoinCust() as $row) {
    		$temp = $this->projectModel->getCurrentEvent($this->projectModel->getEventInternal($row->id));
    		$curr[] = $temp;
    		$templast = $this->projectModel->getNextEvent($this->projectModel->getEventInternal($row->id));
    		$last[] = $templast;
    		$finance[] = $this->projectModel->getFinancialStat($row->id);
    		$qual[] = $this->projectModel->getQualityStat($row->id);
    		$lastupdate[] = $this->projectModel->getLastUpdateProject($this->projectModel->getLastUpdatedTask($row->id),$this->projectModel->getLastUpdatedQuality($row->id),$this->projectModel->getLastUpdateProductivity($row->id),$this->projectModel->getLastUpdatedFinance($row->id),);
    	}
    	foreach($curr as $row) {
    		if($row != NULL){ $currentEvent[] = $row->event; } else { $currentEvent[] = '-'; }
    	}
    	foreach($last as $row) {
    		if($row != NULL){ $lastEvent[] = $row->event; } else { $lastEvent[] = '-'; }
    	}
    	foreach($curr as $row) {
    		if($row != NULL) { $flagdev[] = $this->projectModel->getFlagDelivery($row->event, date('Y-m-d' ,strtotime($row->date))); } else { $flagdev[] = 'red'; }
    	}
        // dd($flagdev);
    	$allproj = $this->projectModel->getProjectWebView();
    	$lop=0;
    	$loplast=0;
    	$lopfin=0;
    	$lopqual=0;
    	$loplastupdate=0;
    	$lopflagdev=0;
    	foreach($allproj as $row) {
    		$out[] = [
    			'project_name' => $row->project_name,
    			'customer_name' => $row->customer_name,
    			'end_product' => $row->end_product,
    			'id' => $row->id,
    			'fullname' => $row->fullname,
    			'cust_id' => $row->cust_id,
    			'status' => $row->status,
    			'current_event' => $currentEvent[$lop++],
    			'last_event' => $lastEvent[$loplast++],
    			'finance' => $finance[$lopfin++],
    			'qual' => $qual[$lopqual++],
    			'delivery' => $flagdev[$lopflagdev++],
    			'lastupdate' => $lastupdate[$loplastupdate++],
    			'type' => $row->type,
    			'cust_id' => $row->cust_id,
    			'project_id' => $row->id
    		];
    	}
    	$col = array_column($out, 'lastupdate');
    	
    	$tempArr2 = array_unique(array_column($out, 'lastupdate'));
    	$result = array_intersect_key($out,$tempArr2);
    	$output = json_decode(json_encode($result));
        // dd($output[0]);
    	$data = [
    		'tittle' => 'Summary Project',
    		'active_menu' => 'project',
    		'customer' => $query,
    		'user' => $user,
    		'pwba' => $this->projectModel->getProductPWBA(),
    		'cluster' => $this->projectModel->getProductCluster(),
    		'ahu' => $this->projectModel->getProductAHU(),
    		'project' => $output,
    		'validation' => \Config\Services::validation(),
    	];
    	return view('webview/index', $data);
    }


}
