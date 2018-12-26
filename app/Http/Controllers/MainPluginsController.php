<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

abstract class MainPluginsController extends Controller{

    /**
     * MainPluginsController constructor.
     */
    public function __construct(){
        if(App::routesAreCached()) {
            $this->middleware('application');
            if(isInAdmin()){
                $this->middleware('backend');
            }else{
                $this->middleware('frontend');
            }
        }
    }


    public function index(){
        return $this->view();
    }

    protected function view(){
        return view('index');
    }

    /**
     * Handle ajax responses (mainly used by view vue js
     *
     * @param  integer $code HTTP response code
     * @param  string  $message The message to be shown along the error
     * @param  int     $itemID The ID of the editing item
     * @param  string  $redirectToView The view to be redirected to if ajax response is successful
     * @param  string  $redirectUrl The URL to be redirected to if ajax response is successful
     * @param  boolean $returnInputErrors If true, it handle input errors
     * @param  array   $errorsList The list of errors in array, ex. ["field_name" => array("Error 1","Error 2")]
     * @param  array   $data Data to be returned
     * @return array|\Illuminate\Http\JsonResponse
     * */
    protected  function response($message, $code = 200, $itemID = null, $redirectToView = '', $redirectUrl = '', $returnInputErrors = false, $errorsList = [], $data = []){
        // if we have input errors in the validator
        if($returnInputErrors){
            return response()->json(array(
                    'code' =>           400,
                    'id'                => $itemID,
                    'errors'            => $errorsList,
                    'message'           => $message,
                    'redirectToView'    => $redirectToView,
                    'data'              => $data
                )
            );
        }
        // if there are no validation errors return normal errors or no errors if there are non
        return [
            'code'          => $code,
            'id'            => $itemID,
            'errors'        => $errorsList,
            'message'       => $message,
            'redirectToView'=> $redirectToView,
            'redirectUrl'   => $redirectUrl,
            'data'          => $data
        ];
    }
}
