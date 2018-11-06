<?php

namespace XRA\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use XRA\Extend\Traits\Updater;
use Carbon\Carbon;

//------ ext models---
use Xot\Sigma\Models\Anag;

class Backend extends Model{
	/* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The log viewer instance
     *
     * @var \Arcanedev\LogViewer\Contracts\LogViewer
     */
    protected $logViewer;

    /** @var int */
    protected $perPage = 30;

    /** @var string */
    protected $showRoute = 'log-viewer::logs.show';
    

	public function getStatsAttribute($value){
		$stats=$this->logViewer->statsTable();
		return $stats;
	}

	public function getChartDataAttribute($value){
		//$stats     = $this->logViewer->statsTable();
        $chartData = $this->prepareChartData($this->stats);
        //$percents  = $this->calcPercentages($stats->footer(), $stats->header());
        return $chartData;
	}

	public function getPercentsAttribute($value){
		$stats=$this->stats;
		$percents  = $this->calcPercentages($stats->footer(), $stats->header());
		return $percents;
	}
}