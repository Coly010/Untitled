<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 02/01/2017
 * Time: 19:49
 */

namespace Untitled\PageBuilder;

use Application\Config\Application_Config;
use Application\Config\Twig_Config;
use Untitled\Libraries\ULogger\ULogger;

class Page
{

    /**
     * @var array Array of the possible routes that the file can handle
     */
    public $Routes = [];

    /**
     * @var Twig_Environment The Twig Environment to render the views
     */
    public $Twig;

    /**
     * @var RequestType Either Get or Post
     */
    public $RequestType;

    /**
     * @var RequestString The Route String
     */
    public $RequestString;

    /**
     * @var Route The route that was found when searching
     */
    public $FoundRoute;

    /**
     * Page constructor.
     */
    public function __construct() {
        $this->InitialiseTwig();
    }

    /**
     * @param $Route Route object
     */
    public function AddRoute($Route) {
        $AlreadyAdded = false;

        foreach($this->Routes as $R) {
            if($R == $Route) {
                $AlreadyAdded = true;
            }
        }

        if(!$AlreadyAdded) {
            $this->Routes[] = $Route;
        }
    }

    /**
     * @return array Return an array of strings split between GET or POST
     */
    public function GetRouteRequestStrings() {
        $Requests = ["GET" => [], "POST" => []];

        foreach($this->Routes as $R) {
            switch($R->getRequestType()){
                case 'GET' :
                    $Requests["GET"][] = $R;
                    break;
                case 'POST' :
                    $Requests["POST"][] = $R;
                    break;
            }
        }

        return $Requests;
    }

    /**
     * Search routes to find a match
     * @param $Request - The request string
     * @return array - Return whether found and the route object
     * @throws \Exception
     */
    public function SearchRoutes($Request) {
        foreach($this->Routes as $R){
            if($R->ComplexRoute){

                $Matchable = explode("/", $R->Request);
                $RequestParts = explode("/", $Request);

                if(count($Matchable) != count($RequestParts)){
                    continue;
                }

                $indexes = [];
                $PartsToMatch = 0;
                $MatchedParts = 0;
                $Variables = 0;
                $Params = [];

                for($i = 0; $i < count($Matchable); $i++){
                    if($Matchable[$i] != "%VAR%"){
                        $indexes[] = $i;
                    } else{
                        $Variables++;
                    }
                }

                for($i = 0; $i < count($RequestParts); $i++){
                    $PartsToMatch++;
                }

                $PartsToMatch -= $Variables;

                foreach($indexes as $i){
                    if(isset($RequestParts[$i]) && $RequestParts[$i] == $Matchable[$i]){
                        $MatchedParts++;
                    }
                }

                if($PartsToMatch == $MatchedParts){
                    for($i = 0; $i < count($RequestParts); $i++){
                        if(!in_array($i, $indexes)){
                            $Params[] = $RequestParts[$i];
                        }
                    }
                    $R->Params = $Params;
                    $this->FoundRoute = $R;

                    return true;
                }



            }
            if($R->getRequest() == $Request){
                $this->FoundRoute = $R;
                return true;
            }
        }
        //throw new \Exception("Failed to find route to match " . $RequestType . " : " . $Request);
    }

    /**
     * Process the found route and either render the page or return the data as a json string
     */
    public function ProcessFoundRoute() {
        if(isset($this->FoundRoute) && $this->FoundRoute != null){
            if($this->FoundRoute->ProcessRoute()){
                if($this->FoundRoute->isRenderView()){

                    foreach(Twig_Config::$GLOBAL_DATA as $key=>$value){
                        $this->Twig->addGlobal($key, $value);
                    }


                    $this->Twig->display($this->FoundRoute->getViewFilePath(), $this->FoundRoute->getViewData());
                } else {
                    if(count($this->FoundRoute->getViewData()) > 0){
                        echo json_encode($this->FoundRoute->getViewData());
                    }
                }
            }
        }
    }

    /**
     * Initialise the Twig Environment
     */
    private function InitialiseTwig(){
        $loader = new \Twig_Loader_FileSystem(Twig_Config::$TEMPLATE_PATH);
        if(count(Twig_Config::$TEMPLATE_PATHS) > 0){
            foreach (Twig_Config::$TEMPLATE_PATHS as $path){
                $loader->addPath($path);
            }
        }
        $this->Twig = new \Twig_Environment($loader,
            ['cache' => Application_Config::$ENV == "Development" ? false : Twig_Config::$CACHE_PATH]);
    }

}