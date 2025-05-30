<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationMail;
use App\Models\Bouquet;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BouquetController extends Controller
{
    function allBouquets(){
        Log::info("Retrieving all flowers");

        return ["data" => Bouquet::all()];
    }


    function addPurchase(Request $request){
        $validator = Validator::make($request->all(), $this->buildRules());

        if ($validator->fails()) {
            Log::warning("Input validation failed");
            return response()->json(["errors" => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $purchase = $this->buildPurchase($validator->validated());

            $purchase->save();

            $this->sendConfirmationMail($purchase);

            return response()->json(["data" => $purchase], Response::HTTP_CREATED);
        }
    }

    function buildRules(){
        return [
            "chosen_bouquet" => "required|numeric|exists:App\Models\Bouquet,id",
            "client_name" => "required|string|max:50",
            "email" => "required|email|max:255",
            "delivery_address" => "required|string|max:255",
            "delivery_method" => "required|string|in:standard,express"
        ];
    }

    function buildPurchase($data)
    {
        $purchase = new Purchase();

        $purchase->chosen_bouquet = $data["chosen_bouquet"];
        $purchase->client_name = $data["client_name"];
        $purchase->email = $data["email"];
        $purchase->delivery_address = $data["delivery_address"];
        $purchase->delivery_method = $data["delivery_method"];

        return $purchase;
    }

    function sendConfirmationMail($purchase)
    {
        $mail = new ConfirmationMail($purchase);
        Mail::to($purchase -> email) -> send($mail);
    }
}
