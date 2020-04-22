<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class RouteManagementController extends Controller
{
    //

    public function back(Request $request)
    {
        if(Auth::check()) {
            $user = $request->user();
            $user_status = Auth::user()->status;

            switch ($user_status) {
                case 'character_declaration_required':
                 
                    $user_status ="payment_required";
                break;
                
                case 'health_declaration_required':
                    $user_status = "character_declaration_required";
                break;
                
                case 'placement_details_required':
                    $user_status = "health_declaration_required";
                break;

                case 'tutor_details_required':
                    $user_status = "placement_details_required";
                break;

                case 'supporting_documents_required':
                    $user_status = "tutor_details_required";
                break;

                case 'awaiting_acceptance':
                    $user_status = "supporting_documents_required";
                    break;
                    
                break;
                default:
                   
                    break;
            }
            $user->setStatus($user_status);

            return redirect()->route("registration");
        }
    }
    public function forward(Request $request)
    {
        if(Auth::check()) {
            $user = $request->user();
            $user_status = Auth::user()->status;

            switch ($user_status) {
                case 'payment_required':
                   $user_status ="character_declaration_required";
                break;
                
                case 'character_declaration_required':
                    $user_status ="health_declaration_required";
                break;
                
                case 'health_declaration_required':
                    $user_status ="supporting_documents_required";
                break;
                
                case 'supporting_documents_required':
                    $user_status ="placement_details_required";
                break;
                
                case 'placement_details_required':
                    $user_status ="tutor_details_required";
                break;
                case 'tutor_details_required':
                    $user_status = "supporting_documents_required";
                break;

                break;
                default:
                   
                    break;
            }
            $user->setStatus($user_status);
            
            return redirect()->route("registration");
        }
    }
}
