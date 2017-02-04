<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 02/01/2017
 * Time: 20:00
 */

namespace Untitled\PageBuilder;


use System\PageBuilder\RouteGuard;

abstract class Route
{

    /**
     * @var bool Is the route complex
     */
    public $ComplexRoute = false;

    /**
     * @var array Parameters array for complex route
     */
    public $Params = [];

    /**
     * @var string the request string
     */
    public $Request = "";

    /**
     * @var The DataProcess to associate with the route
     */
    public $DataProcess;

    /**
     * @var bool Whether to return json encoded message or html file
     */
    public $RenderView = true;

    /**
     * @var string The view file path
     */
    public $ViewFilePath = "";

    /**
     * @var array Data to pass to the view file
     */
    public $ViewData = [];

    /**
     * @var RouteGuard Check to see if route is accessible to user
     */
    public $RouteGuard = null;

    /**
     * Route constructor.
     */
    public function __construct(){

    }

    /**
     * @return mixed - Override method that you will use to process any data you must for the route requested
     */
    public abstract function RunDataProcess();

    /**
     * @return array - return true when finished
     */
    public function ProcessRoute() {
        if(!is_null($this->RouteGuard)){

            if($this->RouteGuard->Guard()){
                $this->RunDataProcess();
                return true;
            } else {
                header("Location: ". $this->RouteGuard->DenyRequestString);
            }

        } else {
            $this->RunDataProcess();
            return true;
        }
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->Request;
    }

    /**
     * @param string $Request
     */
    public function setRequest($Request)
    {
        $this->Request = $Request;
    }

    /**
     * @return mixed
     */
    public function getDataProcess()
    {
        return $this->DataProcess;
    }

    /**
     * @param mixed $DataProcess
     */
    public function setDataProcess($DataProcess)
    {
        $this->DataProcess = $DataProcess;
    }

    /**
     * @return boolean
     */
    public function isRenderView()
    {
        return $this->RenderView;
    }

    /**
     * @param boolean $RenderView
     */
    public function setRenderView($RenderView)
    {
        $this->RenderView = $RenderView;
    }

    /**
     * @return string
     */
    public function getViewFilePath()
    {
        return $this->ViewFilePath;
    }

    /**
     * @param string $ViewFilePath
     */
    public function setViewFilePath($ViewFilePath)
    {
        $this->ViewFilePath = $ViewFilePath;
    }

    /**
     * @return array
     */
    public function getViewData()
    {
        return $this->ViewData;
    }

    /**
     * @param array $ViewData
     */
    public function setViewData($ViewData)
    {
        $this->ViewData = $ViewData;
    }



}